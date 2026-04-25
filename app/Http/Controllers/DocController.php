<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

// Endroid QR (GD only, tanpa Imagick)
use Endroid\QrCode\QrCode as EndroidQrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Logo\Logo;

class DocController extends Controller
{
    /* ===================== LIST & BASIC CRUD ===================== */

    public function index(Request $request)
    {
        $documents = Document::orderByDesc('created_at')->paginate(10);

        return view('documents.index', [
            'title' => 'Dokumen QR',
            'documents' => $documents,
        ]);
    }

    public function create()
    {
        $default = ''; // user bebas isi
        return view('documents.create', compact('default'));
    }

    public function store(Request $r)
    {
        $r->validate([
            'title'         => 'required|string',
            'html_template' => 'required|string',
            'payload'       => 'nullable|string',
        ]);

        $document = Document::create([
            'title'         => $r->title,
            'html_template' => $r->html_template,
            'payload'       => $r->payload,   // ambil dari form, simpan ke DB
            'status'        => 'draft',
        ]);

        return redirect()->route('documents.show', $document)->with('ok', 'Draft tersimpan');
    }

    public function show(Document $document)
    {
        $doc = $document;
        return view('documents.show', compact('doc'));
    }

    public function edit(Document $document)
    {
        $doc = $document;
        $default = $doc->html_template;
        return view('documents.edit', compact('doc', 'default'));
    }

    public function update(Request $r, Document $document)
    {
        $r->validate([
            'title'         => 'required|string',
            'html_template' => 'required|string',
            'payload'       => 'nullable|string',
        ]);

        $document->update([
            'title'         => $r->title,
            'html_template' => $r->html_template,
            'payload'       => $r->payload,   // update payload di DB
            'status'        => 'draft',
        ]);

        return redirect()->route('documents.show', $document)->with('ok', 'Draft diperbarui');
    }

    public function destroy($id)
    {
        $doc = Document::findOrFail($id);
        $doc->delete();

        return redirect()->route('documents.index')
            ->with('success', 'Dokumen berhasil dihapus');
    }

    public function downloadPdf(Document $document)
    {
        if (!$document->pdf_path) {
            return back()->with('error', 'PDF belum dihasilkan.');
        }
        $absolute = Storage::disk('public')->path($document->pdf_path);
        return response()->download($absolute, 'dokumen-' . $document->uuid . '.pdf');
    }

    /* ===================== RENDER / QR ===================== */

    public function render(Document $document)
    {
        [$pdfPath, $qrJpgPath] = $this->generatePdfAndQr($document);
        return redirect("/documents/{$document->id}")
            ->with('ok', 'PDF dibuat & QR disematkan. QR: ' . url('/storage/' . $qrJpgPath));
    }

    public function renderAndDownloadQr(Document $document)
    {
        [, $qrJpgPath] = $this->generatePdfAndQr($document);
        $absolute = Storage::disk('public')->path($qrJpgPath);
        return response()->download($absolute, 'qr-' . $document->uuid . '.jpg');
    }

    /**
     * Generate PDF (QR + payload di footer bawah).
     * @return array [$pdfPath, $qrJpgPath]
     */
    private function generatePdfAndQr(Document $doc): array
    {
        // tandai processing
        $doc->forceFill(['status' => 'processing'])->save();

        try {
            /* ---- 1) HTML sumber ---- */
            $html = $doc->html_template ?? '';
            $html = str_replace('@{{', '{{', $html); // normalisasi

            $verifyUrl  = url('/verify/' . $doc->uuid);
            $payloadRaw = (string) ($doc->payload ?? ''); // ← AMBIL DARI DB

            /* ---- 2) QR PNG + (opsional) logo ---- */
            $qr = EndroidQrCode::create($verifyUrl)
                ->setEncoding(new Encoding('UTF-8'))
                ->setErrorCorrectionLevel(ErrorCorrectionLevel::High)
                ->setSize(420)
                ->setMargin(20)
                ->setRoundBlockSizeMode(RoundBlockSizeMode::Margin);

            $logoPath = public_path('logo.png');
            $logo = is_file($logoPath)
                ? Logo::create($logoPath)->setResizeToWidth(120)->setPunchoutBackground(true)
                : null;

            $writer   = new PngWriter();
            $pngBytes = $writer->write($qr, $logo)->getString();

            // simpan PNG publik (opsional)
            $qrPngRel = 'qr/' . $doc->uuid . '.png';
            Storage::disk('public')->put($qrPngRel, $pngBytes);

            // gunakan Data URI agar stabil di DomPDF
            $qrDataUri = 'data:image/png;base64,' . base64_encode($pngBytes);
            $qrImgTag  = '<img alt="QR" src="' . $qrDataUri . '" style="width:140px;height:140px" />';

            /* ---- 3) Sisipkan QR ke konten ---- */
            $htmlWithQr = $this->injectQrAtSmartPosition($html, $qrImgTag);

            /* ---- 4) Siapkan HTML untuk DomPDF ----
             *    - contentHtml = konten + QR (sudah disisipkan)
             *    - payloadRaw  = isi payload murni dari DB (akan diposisikan fixed bottom di view)
             */
            $pdfHtml = view('pdf.layout', [
                'title'       => $doc->title ?: 'Dokumen',
                'contentHtml' => $htmlWithQr,
                'verifyUrl'   => $verifyUrl,
                'payloadRaw'  => $payloadRaw, // ← kirim ke view
            ])->render();

            /* ---- 5) Render PDF (DomPDF) ---- */
            @ini_set('memory_limit', '512M');

            $pdf    = app('dompdf.wrapper');
            $dompdf = $pdf->getDomPDF();
            $dompdf->set_option('isHtml5ParserEnabled', true);
            $dompdf->set_option('isRemoteEnabled', true);
            $dompdf->set_option('dpi', 96);

            $pdf->loadHTML($pdfHtml)->setPaper('A4', 'portrait');
            $output = $pdf->output();

            /* ---- 6) Simpan PDF ---- */
            $pdfPath = 'documents/' . Str::uuid() . '.pdf';
            Storage::disk('public')->put($pdfPath, $output);

            /* ---- 7) Simpan QR versi JPG (opsional) ---- */
            $qrJpgPath = 'qr/' . $doc->uuid . '.jpg';
            if ($im = @imagecreatefromstring($pngBytes)) {
                ob_start();
                imagejpeg($im, null, 90);
                $jpeg = ob_get_clean();
                imagedestroy($im);
                Storage::disk('public')->put($qrJpgPath, $jpeg);
            }

            /* ---- 8) Update DB ---- */
            $doc->forceFill([
                'pdf_path' => $pdfPath,
                'sha256'   => hash('sha256', $output),
                'status'   => 'generated',
            ])->save();

            return [$pdfPath, $qrJpgPath];

        } catch (\Throwable $e) {
            $doc->forceFill(['status' => 'failed'])->save();
            // opsional simpan HTML debug
            try {
                if (!empty($pdfHtml ?? null)) {
                    Storage::disk('local')->put('debug/last-pdf.html', $pdfHtml);
                }
            } catch (\Throwable $ignored) {}
            throw $e;
        }
    }

    /* ===================== UTIL ===================== */

    /**
     * Sisipkan QR:
     * - Jika ada placeholder <div id="blok-qr"></div> → ganti di situ.
     * - Kalau tidak ada → append di akhir dokumen (center).
     */
    private function injectQrAtSmartPosition(string $html, string $qrImgTag): string
    {
        if (stripos($html, '<div id="blok-qr"></div>') !== false) {
            return str_ireplace('<div id="blok-qr"></div>', $qrImgTag, $html);
        }

        // fallback: taruh di akhir
        return $html . '<div style="text-align:center;margin-top:24px">'.$qrImgTag.'</div>';
    }
}
