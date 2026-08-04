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
        if (Schema::hasTable('ppkpr_berusaha_applications') && !Schema::hasColumn('ppkpr_berusaha_applications', 'bpn_sps_document')) {
            Schema::table('ppkpr_berusaha_applications', function (Blueprint $table) {
                $table->string('bpn_sps_document')->nullable()->after('bpn_pembayaran_status');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('ppkpr_berusaha_applications') && Schema::hasColumn('ppkpr_berusaha_applications', 'bpn_sps_document')) {
            Schema::table('ppkpr_berusaha_applications', function (Blueprint $table) {
                $table->dropColumn('bpn_sps_document');
            });
        }
    }
};
