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
        // 1. ppkpr_berusaha_applications: add persyaratan_lainnya
        Schema::table('ppkpr_berusaha_applications', function (Blueprint $table) {
            if (!Schema::hasColumn('ppkpr_berusaha_applications', 'persyaratan_lainnya')) {
                $table->string('persyaratan_lainnya')->nullable();
            }
        });

        // 2. ppkpr_applications: add nib, kbli, proposal_kegiatan
        Schema::table('ppkpr_applications', function (Blueprint $table) {
            if (!Schema::hasColumn('ppkpr_applications', 'nib')) {
                $table->string('nib')->nullable();
            }
            if (!Schema::hasColumn('ppkpr_applications', 'kbli')) {
                $table->string('kbli')->nullable();
            }
            if (!Schema::hasColumn('ppkpr_applications', 'proposal_kegiatan')) {
                $table->string('proposal_kegiatan')->nullable();
            }
        });

        // 3. kebijakan_applications: add nib, kbli, proposal_kegiatan
        Schema::table('kebijakan_applications', function (Blueprint $table) {
            if (!Schema::hasColumn('kebijakan_applications', 'nib')) {
                $table->string('nib')->nullable();
            }
            if (!Schema::hasColumn('kebijakan_applications', 'kbli')) {
                $table->string('kbli')->nullable();
            }
            if (!Schema::hasColumn('kebijakan_applications', 'proposal_kegiatan')) {
                $table->string('proposal_kegiatan')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ppkpr_berusaha_applications', function (Blueprint $table) {
            if (Schema::hasColumn('ppkpr_berusaha_applications', 'persyaratan_lainnya')) {
                $table->dropColumn('persyaratan_lainnya');
            }
        });

        Schema::table('ppkpr_applications', function (Blueprint $table) {
            $table->dropColumn(['nib', 'kbli', 'proposal_kegiatan']);
        });

        Schema::table('kebijakan_applications', function (Blueprint $table) {
            $table->dropColumn(['nib', 'kbli', 'proposal_kegiatan']);
        });
    }
};
