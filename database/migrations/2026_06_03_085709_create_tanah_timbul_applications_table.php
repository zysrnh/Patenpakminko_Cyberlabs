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
        Schema::create('tanah_timbul_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('application_number')->unique();
            
            // Data Input Form Pengajuan
            $table->string('nama_pemilik_usaha');
            $table->string('nama_pengaju');
            $table->string('hubungan_pengaju'); 
            
            // Alur Kerja & Status
            $table->string('status')->default('menunggu_bpn');
            
            // Sub-langkah BPN
            $table->string('bpn_berkas_status')->default('menunggu'); 
            $table->string('bpn_cek_lokasi_date')->nullable();    
            $table->datetime('bpn_cek_lokasi_dt')->nullable();    
            $table->string('bpn_cek_lokasi_cp')->nullable();
            $table->string('bpn_rapat_date')->nullable();         
            $table->datetime('bpn_rapat_dt')->nullable();         
            $table->string('bpn_pertek_document')->nullable();
            
            // Catatan Pemeriksaan
            $table->text('bpn_notes')->nullable();
            $table->text('dinas_pu_notes')->nullable();
            $table->text('satu_pintu_notes')->nullable();
            
            $table->string('approval_document')->nullable();
            
            // Dokumen
            $table->string('doc_persyaratan')->nullable();
            $table->string('peta_lokasi')->nullable();
            $table->string('surat_kuasa')->nullable();
            $table->string('fc_ktp')->nullable();
            $table->string('fc_npwp')->nullable();
            $table->string('fc_akta_pendirian')->nullable();
            $table->string('rencana_penggunaan_tanah')->nullable();
            $table->string('nib')->nullable();
            $table->string('kbli')->nullable();
            $table->string('proposal_kegiatan')->nullable();
            $table->string('persyaratan_lainnya')->nullable();
            
            $table->json('ptp_data')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tanah_timbul_applications');
    }
};
