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
        $commonFields = function (Blueprint $table) {
            $table->dropColumn('doc_persyaratan');
            $table->string('peta_lokasi')->nullable();
            $table->string('surat_kuasa')->nullable();
            $table->string('fc_ktp')->nullable();
            $table->string('fc_npwp')->nullable();
            $table->string('fc_akta_pendirian')->nullable();
            $table->string('rencana_penggunaan_tanah')->nullable();
        };

        Schema::table('ppkpr_berusaha_applications', function (Blueprint $table) use ($commonFields) {
            $commonFields($table);
            $table->string('nib')->nullable();
            $table->string('kbli')->nullable();
            $table->string('proposal_kegiatan')->nullable();
        });

        Schema::table('ppkpr_applications', function (Blueprint $table) use ($commonFields) {
            $commonFields($table);
            $table->string('persyaratan_lainnya')->nullable();
        });

        Schema::table('kebijakan_applications', function (Blueprint $table) use ($commonFields) {
            $commonFields($table);
            $table->string('persyaratan_lainnya')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $commonDown = function (Blueprint $table) {
            $table->string('doc_persyaratan')->nullable();
            $table->dropColumn([
                'peta_lokasi', 'surat_kuasa', 'fc_ktp', 'fc_npwp',
                'fc_akta_pendirian', 'rencana_penggunaan_tanah'
            ]);
        };

        Schema::table('ppkpr_berusaha_applications', function (Blueprint $table) use ($commonDown) {
            $commonDown($table);
            $table->dropColumn(['nib', 'kbli', 'proposal_kegiatan']);
        });

        Schema::table('ppkpr_applications', function (Blueprint $table) use ($commonDown) {
            $commonDown($table);
            $table->dropColumn('persyaratan_lainnya');
        });

        Schema::table('kebijakan_applications', function (Blueprint $table) use ($commonDown) {
            $commonDown($table);
            $table->dropColumn('persyaratan_lainnya');
        });
    }
};
