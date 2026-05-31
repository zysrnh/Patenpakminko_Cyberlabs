<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('psn_applications', function (Blueprint $table) {
            // Nomor berkas manual dari BPN (diinput saat konfirmasi pembayaran)
            $table->string('no_berkas')->nullable()->after('application_number');

            // Waktu PUTR memvalidasi (untuk trigger notif payment)
            $table->timestamp('putr_validated_at')->nullable()->after('no_berkas');

            // Waktu credential di-blast (setelah BPN konfirmasi bayar)
            $table->timestamp('credential_sent_at')->nullable()->after('putr_validated_at');

            // Catatan PUTR saat validasi
            $table->text('putr_notes')->nullable()->after('credential_sent_at');

            // Status menunggu validasi PUTR
            // (status enum sudah ada di tabel, cukup gunakan string field)
        });
    }

    public function down(): void
    {
        Schema::table('psn_applications', function (Blueprint $table) {
            $table->dropColumn([
                'no_berkas',
                'putr_validated_at',
                'credential_sent_at',
                'putr_notes',
            ]);
        });
    }
};
