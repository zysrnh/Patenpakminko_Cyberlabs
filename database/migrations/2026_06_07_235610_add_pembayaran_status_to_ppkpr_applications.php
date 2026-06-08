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
        Schema::table('ppkpr_applications', function (Blueprint $table) {
            $table->string('bpn_pembayaran_status')->default('menunggu')->after('bpn_berkas_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ppkpr_applications', function (Blueprint $table) {
            $table->dropColumn('bpn_pembayaran_status');
        });
    }
};
