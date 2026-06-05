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
            'ppkpr_berusaha_applications',
            'kebijakan_applications',
            'psn_applications',
            'tanah_timbul_applications'
        ];

        foreach ($tables as $table) {
            if (Schema::hasTable($table) && !Schema::hasColumn($table, 'kbli_kode')) {
                Schema::table($table, function (Blueprint $table_blueprint) use ($table) {
                    if (Schema::hasColumn($table, 'nib')) {
                        $table_blueprint->string('kbli_kode', 20)->nullable()->after('nib');
                    } else {
                        $table_blueprint->string('kbli_kode', 20)->nullable();
                    }
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tables = [
            'ppkpr_applications',
            'ppkpr_berusaha_applications',
            'kebijakan_applications',
            'psn_applications',
            'tanah_timbul_applications'
        ];

        foreach ($tables as $table) {
            if (Schema::hasTable($table)) {
                Schema::table($table, function (Blueprint $table) {
                    $table->dropColumn('kbli_kode');
                });
            }
        }
    }
};
