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
        Schema::create('kebijakan_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('application_number')->unique();
            
            // Data Input Form Pengajuan
            $table->string('nama_pemilik_usaha');
            $table->string('nama_pengaju');
            $table->string('hubungan_pengaju'); // Sebagai apa di usaha nya (cth: Pemilik, Penerima Kuasa, Direktur, dll)
            
            // Alur Kerja & Status
            $table->string('status')->default('menunggu_bpn');
            
            // Sub-langkah BPN
            $table->string('bpn_berkas_status')->default('menunggu'); // menunggu, diterima, ditolak
            $table->string('bpn_cek_lokasi_date')->nullable();    // Teks tampilan untuk WA
            $table->datetime('bpn_cek_lokasi_dt')->nullable();    // Datetime aktual untuk logika sistem
            $table->string('bpn_cek_lokasi_cp')->nullable();
            $table->string('bpn_rapat_date')->nullable();         // Teks tampilan untuk WA
            $table->datetime('bpn_rapat_dt')->nullable();         // Datetime aktual untuk logika sistem
            $table->string('bpn_pertek_document')->nullable();
            
            // Catatan Pemeriksaan tiap instansi
            $table->text('bpn_notes')->nullable();
            $table->text('dinas_pu_notes')->nullable();
            $table->text('satu_pintu_notes')->nullable();
            
            // Path Dokumen PPKPR yang diterbitkan (jika disetujui)
            $table->string('approval_document')->nullable();
            
            // Satu Dokumen Berkas Persyaratan Utama
            $table->string('doc_persyaratan');
            
            $table->timestamps();
        });
    }
 
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kebijakan_applications');
    }
};
