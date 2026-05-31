<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ppkpr_applications', function (Blueprint $table) {
            $table->string('satu_pintu_no_pkkpr')->nullable()->after('bpn_pertek_document');
            $table->date('satu_pintu_tanggal_terbit')->nullable()->after('satu_pintu_no_pkkpr');
        });
    }

    public function down(): void
    {
        Schema::table('ppkpr_applications', function (Blueprint $table) {
            $table->dropColumn(['satu_pintu_no_pkkpr', 'satu_pintu_tanggal_terbit']);
        });
    }
};
