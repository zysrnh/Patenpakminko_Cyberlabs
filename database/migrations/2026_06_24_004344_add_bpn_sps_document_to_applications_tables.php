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
            'ppkpr_applications',
            'psn_applications',
            'kebijakan_applications',
            'tanah_timbul_applications',
        ];

        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->string('bpn_sps_document')->nullable()->after('bpn_pertek_document');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tables = [
            'ppkpr_applications',
            'psn_applications',
            'kebijakan_applications',
            'tanah_timbul_applications',
        ];

        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->dropColumn('bpn_sps_document');
            });
        }
    }
};
