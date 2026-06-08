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
        Schema::table('kebijakan_applications', function (Blueprint $table) {
            $table->string('satu_pintu_no_pkkpr')->nullable()->after('satu_pintu_notes');
            $table->date('satu_pintu_tanggal_terbit')->nullable()->after('satu_pintu_no_pkkpr');
        });

        Schema::table('tanah_timbul_applications', function (Blueprint $table) {
            $table->string('satu_pintu_no_pkkpr')->nullable()->after('satu_pintu_notes');
            $table->date('satu_pintu_tanggal_terbit')->nullable()->after('satu_pintu_no_pkkpr');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kebijakan_applications', function (Blueprint $table) {
            $table->dropColumn(['satu_pintu_no_pkkpr', 'satu_pintu_tanggal_terbit']);
        });

        Schema::table('tanah_timbul_applications', function (Blueprint $table) {
            $table->dropColumn(['satu_pintu_no_pkkpr', 'satu_pintu_tanggal_terbit']);
        });
    }
};
