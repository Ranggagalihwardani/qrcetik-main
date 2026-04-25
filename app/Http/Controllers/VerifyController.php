<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use Illuminate\Support\Facades\Storage;

class VerifyController extends Controller
{
    // GET /verify  (bisa ?uuid=... juga)
    public function index(Request $request)
{
    $uuid = trim((string) $request->query('uuid', ''));
    if ($uuid !== '') {
        return $this->show($uuid);
    }
    return view('verify.search', ['title' => 'Verifikasi Dokumen']);
}

    // GET /verify/{uuid}
    public function show(string $uuid)
    {
        $doc = Document::where('uuid', $uuid)->firstOrFail();

        $public = [
            'title'       => $doc->title,
            'uuid'        => $doc->uuid,
            'status'      => $doc->status,
            'created'     => optional($doc->created_at)->format('d M Y H:i'),
            'updated'     => optional($doc->updated_at)->format('d M Y H:i'),
            'sha256'      => $doc->sha256 ?? '-',
            'download_url'=> $doc->pdf_path ? route('documents.download', $doc->uuid) : null,
        ];

        if (!$doc->sha256 && $doc->pdf_path && Storage::exists($doc->pdf_path)) {
            $public['sha256'] = hash('sha256', Storage::get($doc->pdf_path));
        }
return view('verify.show', ['title' => 'Verifikasi Dokumen', 'public' => $public]);return view('verify', ['title' => 'Verifikasi Dokumen', 'public' => $public]);
    }

    // GET /documents/{uuid}/download  (opsional)
    public function download(string $uuid)
    {
        $doc = Document::where('uuid', $uuid)->firstOrFail();
        abort_unless($doc->pdf_path && Storage::exists($doc->pdf_path), 404);
        return Storage::download($doc->pdf_path, ($doc->title ?: 'dokumen').'.pdf');
    }
}
