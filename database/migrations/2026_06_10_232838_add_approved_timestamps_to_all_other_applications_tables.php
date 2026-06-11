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
        $tables = [
            'ppkpr_berusaha_applications',
            'psn_applications',
            'kebijakan_applications',
            'tanah_timbul_applications'
        ];

        foreach ($tables as $tableName) {
            Schema::table($tableName, function (Blueprint $table) use ($tableName) {
                if (!Schema::hasColumn($tableName, 'bpn_berkas_approved_at')) {
                    $table->timestamp('bpn_berkas_approved_at')->nullable()->after('bpn_berkas_status');
                }
                if (!Schema::hasColumn($tableName, 'bpn_pembayaran_approved_at')) {
                    $table->timestamp('bpn_pembayaran_approved_at')->nullable()->after('bpn_pembayaran_status');
                }
                if (!Schema::hasColumn($tableName, 'bpn_rapat_approved_at')) {
                    $table->timestamp('bpn_rapat_approved_at')->nullable()->after('bpn_rapat_dt');
                }
                if (!Schema::hasColumn($tableName, 'dinas_pu_approved_at')) {
                    $table->timestamp('dinas_pu_approved_at')->nullable()->after('dinas_pu_notes');
                }
                if (!Schema::hasColumn($tableName, 'satu_pintu_approved_at')) {
                    $table->timestamp('satu_pintu_approved_at')->nullable()->after('satu_pintu_notes');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tables = [
            'ppkpr_berusaha_applications',
            'psn_applications',
            'kebijakan_applications',
            'tanah_timbul_applications'
        ];

        foreach ($tables as $tableName) {
            Schema::table($tableName, function (Blueprint $table) use ($tableName) {
                if (Schema::hasColumn($tableName, 'bpn_berkas_approved_at')) {
                    $table->dropColumn('bpn_berkas_approved_at');
                }
                if (Schema::hasColumn($tableName, 'bpn_pembayaran_approved_at')) {
                    $table->dropColumn('bpn_pembayaran_approved_at');
                }
                if (Schema::hasColumn($tableName, 'bpn_rapat_approved_at')) {
                    $table->dropColumn('bpn_rapat_approved_at');
                }
                if (Schema::hasColumn($tableName, 'dinas_pu_approved_at')) {
                    $table->dropColumn('dinas_pu_approved_at');
                }
                if (Schema::hasColumn($tableName, 'satu_pintu_approved_at')) {
                    $table->dropColumn('satu_pintu_approved_at');
                }
            });
        }
    }
};
