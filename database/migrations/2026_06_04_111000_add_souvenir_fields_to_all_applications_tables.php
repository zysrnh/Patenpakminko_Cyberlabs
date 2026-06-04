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
            if (Schema::hasTable($table)) {
                Schema::table($table, function (Blueprint $table) {
                    $table->timestamp('souvenir_sent_at')->nullable()->after('bpn_pertek_uploaded_at');
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
                    $table->dropColumn('souvenir_sent_at');
                });
            }
        }
    }
};
