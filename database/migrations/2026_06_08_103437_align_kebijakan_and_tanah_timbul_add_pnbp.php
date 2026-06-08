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
        Schema::table('kebijakan_applications', function (Blueprint $table) {
            $table->string('bpn_pembayaran_status')->default('menunggu')->nullable()->after('bpn_berkas_status');
            $table->string('no_berkas')->nullable()->after('application_number');
            $table->timestamp('credential_sent_at')->nullable()->after('no_berkas');
            $table->timestamp('bpn_berkas_approved_at')->nullable()->after('bpn_berkas_status');
            $table->timestamp('bpn_pembayaran_approved_at')->nullable()->after('bpn_pembayaran_status');
            $table->timestamp('bpn_rapat_approved_at')->nullable()->after('bpn_rapat_dt');
        });

        Schema::table('tanah_timbul_applications', function (Blueprint $table) {
            $table->string('bpn_pembayaran_status')->default('menunggu')->nullable()->after('bpn_berkas_status');
            $table->string('no_berkas')->nullable()->after('application_number');
            $table->timestamp('credential_sent_at')->nullable()->after('no_berkas');
            $table->timestamp('bpn_berkas_approved_at')->nullable()->after('bpn_berkas_status');
            $table->timestamp('bpn_pembayaran_approved_at')->nullable()->after('bpn_pembayaran_status');
            $table->timestamp('bpn_rapat_approved_at')->nullable()->after('bpn_rapat_dt');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kebijakan_applications', function (Blueprint $table) {
            $table->dropColumn([
                'bpn_pembayaran_status',
                'no_berkas',
                'credential_sent_at',
                'bpn_berkas_approved_at',
                'bpn_pembayaran_approved_at',
                'bpn_rapat_approved_at',
            ]);
        });

        Schema::table('tanah_timbul_applications', function (Blueprint $table) {
            $table->dropColumn([
                'bpn_pembayaran_status',
                'no_berkas',
                'credential_sent_at',
                'bpn_berkas_approved_at',
                'bpn_pembayaran_approved_at',
                'bpn_rapat_approved_at',
            ]);
        });
    }
};
