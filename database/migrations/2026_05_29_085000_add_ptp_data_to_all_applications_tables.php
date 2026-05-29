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
        Schema::table('ppkpr_berusaha_applications', function (Blueprint $table) {
            $table->text('ptp_data')->nullable()->after('hubungan_pengaju');
        });
        Schema::table('ppkpr_applications', function (Blueprint $table) {
            $table->text('ptp_data')->nullable()->after('hubungan_pengaju');
        });
        Schema::table('kebijakan_applications', function (Blueprint $table) {
            $table->text('ptp_data')->nullable()->after('hubungan_pengaju');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ppkpr_berusaha_applications', function (Blueprint $table) {
            $table->dropColumn('ptp_data');
        });
        Schema::table('ppkpr_applications', function (Blueprint $table) {
            $table->dropColumn('ptp_data');
        });
        Schema::table('kebijakan_applications', function (Blueprint $table) {
            $table->dropColumn('ptp_data');
        });
    }
};
