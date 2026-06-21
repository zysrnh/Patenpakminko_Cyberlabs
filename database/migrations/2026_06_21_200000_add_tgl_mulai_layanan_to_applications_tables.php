<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $tables = [
            'ppkpr_applications',
            'ppkpr_berusaha_applications',
            'kebijakan_applications',
            'psn_applications',
            'tanah_timbul_applications',
        ];

        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->datetime('tgl_mulai_layanan')->nullable()->after('status');
                $table->datetime('tgl_selesai_layanan')->nullable()->after('tgl_mulai_layanan');
            });
        }
    }

    public function down(): void
    {
        $tables = [
            'ppkpr_applications',
            'ppkpr_berusaha_applications',
            'kebijakan_applications',
            'psn_applications',
            'tanah_timbul_applications',
        ];

        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->dropColumn(['tgl_mulai_layanan', 'tgl_selesai_layanan']);
            });
        }
    }
};
