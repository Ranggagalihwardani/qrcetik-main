<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\PdfUpload;

// Endroid (GD only, v4)
use Endroid\QrCode\QrCode as EndroidQrCode;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Logo\Logo;

// Baca teks PDF & tempel gambar ke PDF (tanpa Imagick)
use Smalot\PdfParser\Parser as PdfTextParser;
use setasign\Fpdi\Fpdi;

class QrController extends Controller
{
    /* ===================== List & Form ===================== */

    public function index()
    {
        $uploads = PdfUpload::latest()->paginate(12);

        return view('qr.pdf-index', [
            'title'   => 'Daftar Dokumen PDF',
            'uploads' => $uploads,
        ]);
    }

    public function create()
    {
        return view('qr.pdf-upload', ['title' => 'QR dari PDF']);
    }

    /* ===================== Upload + Simpan QR (tanpa embed) ===================== */

    /**
     * Upload PDF biasa + generate QR (logo tengah), TANPA embed ke PDF.
     * Rekaman tersimpan ke tabel pdf_uploads.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pdf'     => 'required|mimes:pdf|max:5120', // max 5MB
            'title'   => 'nullable|string|max:255',
            'payload' => 'nullable|string',             // ✅ payload ikut divalidasi
        ]);

        // 1) Simpan PDF sumber
        $file       = $request->file('pdf');
        $storedPath = $file->store('pdf', 'public'); // ex: pdf/xxx.pdf
        $absPdf     = Storage::disk('public')->path($storedPath);
        $publicUrl  = asset('storage/'.$storedPath);

        // 2) Hash sumber
        $pdfBytes  = file_get_contents($absPdf);
        $pdfSha256 = hash('sha256', $pdfBytes);

        // 3) QR + Logo (PNG, GD)
        [$pngBytes, $qrRelPath] = $this->makeQrPngWithLogo($publicUrl);

        // 4) Simpan DB
        $upload = PdfUpload::create([
            'title'         => $request->input('title'),
            'original_name' => $file->getClientOriginalName(),
            'mime'          => $file->getClientMimeType(),
            'size'          => $file->getSize(),
            'pdf_path'      => $storedPath,
            'pdf_url'       => $publicUrl,
            'pdf_sha256'    => $pdfSha256,
            'qr_png_path'   => $qrRelPath,
            'status'        => 'uploaded',
            'payload'       => $request->input('payload'), // ✅ simpan payload ke DB
        ]);

        return redirect()->route('qr.show', $upload->uuid)
            ->with('ok', 'Upload berhasil, QR dibuat (belum disematkan ke PDF).');
    }

   public function delete(string $uuid)
{
    $upload = \App\Models\PdfUpload::where('uuid', $uuid)->firstOrFail();

    if ($upload->pdf_path && \Storage::disk('public')->exists($upload->pdf_path)) {
        \Storage::disk('public')->delete($upload->pdf_path);
    }
    if ($upload->qr_png_path && \Storage::disk('public')->exists($upload->qr_png_path)) {
        \Storage::disk('public')->delete($upload->qr_png_path);
    }

    $upload->delete();

    return back()->with('ok', 'Dokumen berhasil dihapus.');
}




    /* ===================== Upload + Embed QR ke PDF ===================== */

    /**
     * Upload PDF & EMBED QR ke dalam PDF.
     * QR ditempatkan pada halaman yang mengandung pola tanda tangan (garis ________, "nama terang", "tanda tangan", "menteri investasi", dll).
     * Kalau tidak ketemu → fallback ke halaman terakhir.
     * Payload (jika ada) akan ditulis di bagian bawah halaman target.
     */
    public function storeAndEmbed(Request $request)
    {
        $request->validate([
            'pdf'     => 'required|mimes:pdf|max:5120',
            'title'   => 'nullable|string|max:255',
            'payload' => 'nullable|string', // ✅ payload ikut divalidasi
        ]);

        // a) Simpan PDF sumber
        $file       = $request->file('pdf');
        $srcRelPath = $file->store('pdf', 'public');
        $absSrcPdf  = Storage::disk('public')->path($srcRelPath);
        $srcUrl     = asset('storage/'.$srcRelPath);
        $srcSha     = hash('sha256', file_get_contents($absSrcPdf));

        // b) Buat QR PNG (logo tengah, GD)
        [$pngBytes, $qrRelPath] = $this->makeQrPngWithLogo($srcUrl);
        $absQrPng = Storage::disk('public')->path($qrRelPath);

        // c) Deteksi halaman target
        $targetPage = $this->findSignaturePage($absSrcPdf);
        if (empty($targetPage)) {
            $targetPage = -1; // nanti dianggap halaman terakhir
        }

        // d) Embed QR + Payload ke PDF hasil
        Storage::disk('public')->makeDirectory('pdf_with_qr');
        $dstRelPath = 'pdf_with_qr/' . Str::uuid() . '.pdf';
        $absDstPdf  = Storage::disk('public')->path($dstRelPath);

        $this->embedQrIntoPdf(
            $absSrcPdf,
            $absDstPdf,
            $absQrPng,
            $targetPage,
            $request->input('payload') // ✅ kirim payload ke proses embed
        );

        // e) Simpan DB untuk PDF hasil embed
        $upload = PdfUpload::create([
            'title'         => $request->input('title'),
            'original_name' => $file->getClientOriginalName(),
            'mime'          => $file->getClientMimeType(),
            'size'          => $file->getSize(),
            'pdf_path'      => $dstRelPath,                     // simpan hasil embed
            'pdf_url'       => asset('storage/'.$dstRelPath),
            'pdf_sha256'    => hash('sha256', file_get_contents($absDstPdf)),
            'qr_png_path'   => $qrRelPath,
            'status'        => 'generated',
            'payload'       => $request->input('payload'),      // ✅ simpan payload ke DB
        ]);

        return redirect()->route('qr.show', $upload->uuid)
            ->with('ok', 'PDF berhasil di-embed dengan QR + payload di blok tanda tangan.');
    }

    /* ===================== Detail & Download ===================== */

    public function show(string $uuid)
    {
        $upload = PdfUpload::where('uuid', $uuid)->firstOrFail();

        $qrBase64 = null;
        if ($upload->qr_png_path && Storage::disk('public')->exists($upload->qr_png_path)) {
            $png = Storage::disk('public')->get($upload->qr_png_path);
            $qrBase64 = 'data:image/png;base64,' . base64_encode($png);
        }

        return view('qr.pdf-result', [
            'title'  => 'Detail Dokumen',
            'upload' => $upload,
            'qr'     => $qrBase64,
            'url'    => $upload->pdf_url,
        ]);
    }

    public function downloadQr(string $uuid)
    {
        $upload = PdfUpload::where('uuid', $uuid)->firstOrFail();
        $abs = Storage::disk('public')->path($upload->qr_png_path);
        return response()->download($abs, 'qr-'.$uuid.'.png');
    }

    public function downloadPdf(string $uuid)
    {
        $upload = PdfUpload::where('uuid', $uuid)->firstOrFail();
        $abs  = Storage::disk('public')->path($upload->pdf_path);
        $name = pathinfo($upload->original_name, PATHINFO_FILENAME) ?: 'dokumen';
        return response()->download($abs, $name.'.pdf');
    }

    /* ===================== Helpers ===================== */

    /**
     * Buat QR PNG + logo di tengah (GD only). Return [binary_png, relative_path].
     */
    private function makeQrPngWithLogo(string $data): array
    {
        Storage::disk('public')->makeDirectory('qr_uploads');

        $qr = EndroidQrCode::create($data)
            ->setEncoding(new Encoding('UTF-8'))
            ->setSize(800)
            ->setMargin(20)
            ->setErrorCorrectionLevel(ErrorCorrectionLevel::High)   // ← enum, tanpa new
            ->setRoundBlockSizeMode(RoundBlockSizeMode::Margin);    // ← enum, tanpa new

        $logo = null;
        $logoPath = public_path('logo.png');
        if (is_file($logoPath)) {
            $logo = Logo::create($logoPath)
                ->setResizeToWidth(180)
                ->setPunchoutBackground(true);
        }

        $writer = new PngWriter();
        $png    = $writer->write($qr, $logo)->getString();

        $qrRel  = 'qr_uploads/' . \Illuminate\Support\Str::uuid() . '.png';
        \Illuminate\Support\Facades\Storage::disk('public')->put($qrRel, $png);

        return [$png, $qrRel];
    }

    private function findSignaturePage(string $absPdfPath): ?int
    {
        $parser = new PdfTextParser();
        $pdf    = $parser->parseFile($absPdfPath);

        $patterns = [
            '/_{6,}/i',                 // garis panjang ________
            '/\bnama\s*terang\b/i',
            '/\btanda\s*tangan\b/i',
            '/\bsignature\b/i',
            '/Sarno\s+Andriyanto/i',
        ];

        $pages = $pdf->getPages();
        foreach ($pages as $i => $page) {
            $text = $page->getText();
            foreach ($patterns as $re) {
                if (preg_match($re, $text)) {
                    return $i + 1; // FPDI pakai 1-based
                }
            }
        }
        return null;
    }

    /**
     * Tempelkan PNG QR ke PDF pada halaman target.
     * - $targetPage null/-1/di luar range → halaman terakhir.
     * - Posisi default: tengah-bawah (di atas area tanda tangan).
     * - Jika $payloadText ada → tulis payload di bagian bawah (center).
     */
    private function embedQrIntoPdf(
        string $srcPath,
        string $dstPath,
        string $qrPngAbsPath,
        ?int $targetPage,
        ?string $payloadText = null // ✅ terima payload
    ): void {
        $pdf = new Fpdi('P', 'mm');
        $pageCount = $pdf->setSourceFile($srcPath);

        if (empty($targetPage) || $targetPage < 1 || $targetPage > $pageCount) {
            $targetPage = $pageCount; // fallback
        }

        for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
            $tplId = $pdf->importPage($pageNo);
            $size  = $pdf->getTemplateSize($tplId);

            // Orientasi sesuai halaman sumber
            $orientation = ($size['width'] > $size['height']) ? 'L' : 'P';
            $pdf->AddPage($orientation, [$size['width'], $size['height']]);
            $pdf->useTemplate($tplId);

            // Hanya tempel di halaman target
            if ($pageNo === $targetPage) {
                // Heuristik posisi: pusat bawah untuk QR
                $qrSizeMm  = 40;  // lebar & tinggi QR (mm)
                $bottomGap = 30;  // jarak dari bawah (mm)

                $x = ($size['width'] - $qrSizeMm) / 2;
                $y = $size['height'] - $bottomGap - $qrSizeMm;

                $pdf->Image($qrPngAbsPath, $x, $y, $qrSizeMm, $qrSizeMm, 'PNG');

                // ====== Tulis payload di bawah (center), jika ada ======
                if (!empty($payloadText)) {
                    // Sedikit margin bawah agar tidak kepotong
                    $textBoxMarginX = 10;          // margin horizontal
                    $textBoxWidth   = $size['width'] - ($textBoxMarginX * 2);
                    $baselineY      = $size['height'] - 8; // 8 mm dari bawah

                    // Batas panjang agar aman
                    $text = mb_substr($payloadText, 0, 3000);

                    // Label
                    $pdf->SetFont('Helvetica', 'B', 9);
                    $pdf->SetTextColor(0, 0, 0);
                    $pdf->SetXY($textBoxMarginX, $baselineY - 10);
                    $pdf->Cell($textBoxWidth, 5, 'Payload:', 0, 1, 'C');

                    // Isi (multiline, center)
                    $pdf->SetFont('Helvetica', '', 9);
                    $pdf->SetXY($textBoxMarginX, $pdf->GetY());
                    $pdf->MultiCell($textBoxWidth, 4.5, $text, 0, 'C');
                }
            }
        }

        // Tulis file hasil
        $pdf->Output($dstPath, 'F');
    }
}
