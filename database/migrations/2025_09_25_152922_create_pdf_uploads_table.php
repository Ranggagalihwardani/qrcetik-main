<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pdf_uploads', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('title')->nullable();
            $table->string('original_name');
            $table->string('mime', 100)->nullable();
            $table->unsignedBigInteger('size')->default(0);
            $table->string('pdf_path');       // path di storage (public)
            $table->string('pdf_url');        // URL publik
            $table->string('pdf_sha256');     // hash file PDF
            $table->string('qr_png_path')->nullable(); // path QR png yg disimpan
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pdf_uploads');
    }
};
