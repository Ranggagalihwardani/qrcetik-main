<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('pdf_uploads', function (Blueprint $table) {
            // string pendek cukup, atau enum kalau mau kaku
            $table->string('status', 32)->default('uploaded')->after('qr_png_path');
        });
    }

    public function down(): void
    {
        Schema::table('pdf_uploads', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
