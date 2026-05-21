<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function open()
    {
        // placeholder (will use up method)
    }

    public function up(): void
    {
        Schema::create('ppkpr_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('application_number')->unique();
            
            // Informasi Pemohon & Tanah
            $table->string('applicant_name');
            $table->string('applicant_nik');
            $table->text('location_address');
            $table->integer('land_size'); // Luas tanah dalam m2
            $table->string('coordinates'); // Koordinat GPS Lat, Long
            $table->string('land_purpose'); // Rumah Tinggal, Keagamaan, Sosial, Fasilitas Umum, dll.
            
            // Alur Kerja & Status
            // Status: 'menunggu_bpn', 'menunggu_dinas_pu', 'menunggu_satu_pintu', 'disetujui', 'ditolak'
            $table->string('status')->default('menunggu_bpn');
            
            // Catatan Pemeriksaan tiap instansi
            $table->text('bpn_notes')->nullable();
            $table->text('dinas_pu_notes')->nullable();
            $table->text('satu_pintu_notes')->nullable();
            
            // Path Dokumen PPKPR yang diterbitkan (jika disetujui)
            $table->string('approval_document')->nullable();
            
            // File Dokumen Lampiran (diunggah oleh Pelaku Usaha)
            $table->string('doc_ktp');
            $table->string('doc_sertifikat');
            $table->string('doc_pernyataan');
            $table->string('doc_desain');
            $table->string('doc_foto_lapangan');
            
            $table->string('doc_pbb')->nullable();
            $table->string('doc_surat_kuasa')->nullable();
            $table->string('doc_akta_yayasan')->nullable();
            $table->string('doc_rekomendasi_tetangga')->nullable();
            $table->string('doc_pendukung')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppkpr_applications');
    }
};
