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
            $table->timestamp('bpn_berkas_approved_at')->nullable()->after('bpn_berkas_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ppkpr_applications', function (Blueprint $table) {
            $table->dropColumn('bpn_berkas_approved_at');
        });
    }
};
