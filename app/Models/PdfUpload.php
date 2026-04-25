<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PdfUpload extends Model
{
    protected $fillable = [
        'uuid',
        'title',
        'original_name',
        'mime',
        'size',
        'pdf_path',
        'pdf_url',
        'pdf_sha256',
        'qr_png_path',
        'status',
        'payload', // ✅ ditambahkan
    ];

    // Opsional: supaya kalau isinya JSON bisa langsung di-cast jadi array
    // kalau kamu mau isi bebas (plain text), ubah jadi 'string'
    protected function casts(): array
    {
        return [
            'payload' => 'string', // atau 'array' kalau selalu JSON
        ];
    }

    protected static function booted()
    {
        static::creating(function ($m) {
            if (empty($m->uuid)) {
                $m->uuid = (string) Str::uuid();
            }
        });
    }
}
