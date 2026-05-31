<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ppkpr_applications', function (Blueprint $table) {
            // Nomor berkas manual dari BPN (diinput saat konfirmasi pembayaran)
            $table->string('no_berkas')->nullable()->after('application_number');

            // Waktu PUTR memvalidasi (untuk trigger notif payment)
            $table->timestamp('putr_validated_at')->nullable()->after('no_berkas');

            // Waktu credential di-blast (setelah BPN konfirmasi bayar)
            $table->timestamp('credential_sent_at')->nullable()->after('putr_validated_at');

            // Catatan PUTR saat validasi
            $table->text('putr_notes')->nullable()->after('credential_sent_at');

            // Tambah dinas_pu_tanggal_penilaian jika belum ada
            $table->date('dinas_pu_tanggal_penilaian')->nullable()->after('dinas_pu_notes');
            $table->string('dinas_pu_document')->nullable()->after('dinas_pu_tanggal_penilaian');
        });
    }

    public function down(): void
    {
        Schema::table('ppkpr_applications', function (Blueprint $table) {
            $table->dropColumn([
                'no_berkas',
                'putr_validated_at',
                'credential_sent_at',
                'putr_notes',
                'dinas_pu_tanggal_penilaian',
                'dinas_pu_document',
            ]);
        });
    }
};
