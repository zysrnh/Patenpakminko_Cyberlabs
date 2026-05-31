<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ppkpr_berusaha_applications', function (Blueprint $table) {
            // Nomor Berkas yang diinput manual oleh Admin BPN saat konfirmasi pembayaran
            $table->string('no_berkas')->nullable()->after('bpn_pembayaran_status');
        });
    }

    public function down(): void
    {
        Schema::table('ppkpr_berusaha_applications', function (Blueprint $table) {
            $table->dropColumn('no_berkas');
        });
    }
};
