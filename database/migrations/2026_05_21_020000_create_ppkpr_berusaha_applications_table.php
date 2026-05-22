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
        Schema::create('ppkpr_berusaha_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('application_number')->unique();
            
            // Data Input Form Pengajuan
            $table->string('nama_pemilik_usaha');
            $table->string('nama_pengaju');
            $table->string('hubungan_pengaju');
            
            // Alur Kerja & Status Utama
            // Status values: menunggu_bpn, menunggu_dinas_pu, menunggu_satu_pintu, disetujui, ditolak
            $table->string('status')->default('menunggu_bpn');
            
            // Sub-langkah BPN
            $table->string('bpn_berkas_status')->default('menunggu'); // menunggu, diterima, tidak_sesuai
            $table->string('bpn_pembayaran_status')->default('belum_bayar'); // belum_bayar, sudah_bayar
            
            $table->string('bpn_cek_lokasi_date')->nullable();
            $table->datetime('bpn_cek_lokasi_dt')->nullable();
            $table->string('bpn_cek_lokasi_cp')->nullable();
            
            $table->string('bpn_rapat_date')->nullable();
            $table->datetime('bpn_rapat_dt')->nullable();
            
            $table->string('bpn_pertek_document')->nullable();
            $table->text('bpn_notes')->nullable();
            
            // Dinas PU
            $table->string('dinas_pu_status')->default('menunggu'); // menunggu, sesuai, belum_sesuai
            $table->text('dinas_pu_notes')->nullable();
            
            // Satu Pintu (PTSP)
            $table->string('satu_pintu_no_pkkpr')->nullable();
            $table->date('satu_pintu_tanggal_terbit')->nullable();
            $table->string('satu_pintu_document')->nullable(); // Produk Akhir PDF
            $table->text('satu_pintu_notes')->nullable();
            
            // Dokumen Berkas Persyaratan Utama
            $table->string('doc_persyaratan');
            
            $table->timestamps();
        });
    }
 
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppkpr_berusaha_applications');
    }
};
