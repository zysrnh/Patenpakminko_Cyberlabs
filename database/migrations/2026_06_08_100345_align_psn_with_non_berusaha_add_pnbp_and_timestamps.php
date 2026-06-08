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
        Schema::table('psn_applications', function (Blueprint $table) {
            $table->string('bpn_pembayaran_status')->default('menunggu')->nullable()->after('bpn_berkas_status');
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
        Schema::table('psn_applications', function (Blueprint $table) {
            $table->dropColumn([
                'bpn_pembayaran_status',
                'bpn_berkas_approved_at',
                'bpn_pembayaran_approved_at',
                'bpn_rapat_approved_at',
            ]);
        });
    }
};
