<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('psn_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('application_number')->unique();

            // Data Pemohon
            $table->string('nama_pemilik_usaha');
            $table->string('nama_pengaju');
            $table->string('hubungan_pengaju');

            // Status Permohonan
            $table->string('status')->default('menunggu_bpn');

            // PTP Form Data (JSON)
            $table->text('ptp_data')->nullable();

            // Catatan Instansi
            $table->text('bpn_notes')->nullable();
            $table->text('dinas_pu_notes')->nullable();
            $table->text('satu_pintu_notes')->nullable();

            // Dokumen Persyaratan (tanpa NIB & KBLI - PSN tidak pakai OSS)
            $table->string('peta_lokasi')->nullable();
            $table->string('surat_kuasa')->nullable();
            $table->string('fc_ktp')->nullable();
            $table->string('fc_npwp')->nullable();
            $table->string('fc_akta_pendirian')->nullable();
            $table->string('rencana_penggunaan_tanah')->nullable();
            $table->string('proposal_kegiatan')->nullable();
            $table->string('persyaratan_lainnya')->nullable();

            // BPN — Sub-tahap Verifikasi Berkas
            $table->string('bpn_berkas_status')->default('menunggu'); // menunggu | diterima | ditolak

            // BPN — Sub-tahap Cek Lokasi
            $table->string('bpn_cek_lokasi_date')->nullable();
            $table->datetime('bpn_cek_lokasi_dt')->nullable();
            $table->string('bpn_cek_lokasi_cp')->nullable();

            // BPN — Sub-tahap Rapat Koordinasi
            $table->string('bpn_rapat_date')->nullable();
            $table->datetime('bpn_rapat_dt')->nullable();

            // BPN — Penerbitan Pertek
            $table->string('bpn_pertek_document')->nullable();

            // Dinas PU — Penilaian PKKPR
            $table->string('dinas_pu_tanggal_penilaian')->nullable();
            $table->string('dinas_pu_document')->nullable(); // hanya masuk ke BPN, tidak ke pemohon

            // Satu Pintu / PTSP — Penerbitan PKKPR
            $table->string('satu_pintu_no_pkkpr')->nullable();
            $table->date('satu_pintu_tanggal_terbit')->nullable();
            $table->string('approval_document')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('psn_applications');
    }
};
