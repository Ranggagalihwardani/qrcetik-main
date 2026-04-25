<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
    'uuid',
    'title',
    'html_template',
    'payload',   // ⬅️ tambahkan ini
    'pdf_path',
    'sha256',
    'status',
];


    protected static function booted()
    {
        static::creating(function ($doc) {
            if (!$doc->uuid) {
                $doc->uuid = (string) Str::uuid();
            }
        });
    }
}
