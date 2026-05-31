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
            $table->date('dinas_pu_tanggal_penilaian')->nullable();
            $table->string('dinas_pu_document')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ppkpr_berusaha_applications', function (Blueprint $table) {
            $table->dropColumn(['dinas_pu_tanggal_penilaian', 'dinas_pu_document']);
        });
    }
};
