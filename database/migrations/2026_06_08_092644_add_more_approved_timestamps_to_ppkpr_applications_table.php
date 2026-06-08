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
        Schema::table('ppkpr_applications', function (Blueprint $table) {
            $table->timestamp('bpn_pembayaran_approved_at')->nullable()->after('bpn_pembayaran_status');
            $table->timestamp('bpn_rapat_approved_at')->nullable()->after('bpn_rapat_dt');
            $table->timestamp('dinas_pu_approved_at')->nullable()->after('dinas_pu_notes');
            $table->timestamp('satu_pintu_approved_at')->nullable()->after('satu_pintu_notes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ppkpr_applications', function (Blueprint $table) {
            $table->dropColumn([
                'bpn_pembayaran_approved_at',
                'bpn_rapat_approved_at',
                'dinas_pu_approved_at',
                'satu_pintu_approved_at'
            ]);
        });
    }
};
