<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('template_dokumens', function (Blueprint $table) {
            $table->id();
            $table->string('nama_template');
            $table->string('kode_template')->unique();
            $table->string('kategori')->default('Formulir Pertek');
            $table->string('file_path');
            $table->string('tipe_file', 10)->default('docx');
            $table->string('ukuran_file', 20)->nullable();
            $table->text('keterangan')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('template_dokumens');
    }
};
