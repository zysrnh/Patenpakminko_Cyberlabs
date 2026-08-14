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
        Schema::table('berkas', function (Blueprint $table) {
            if (!Schema::hasColumn('berkas', 'is_ptsp')) {
                $table->boolean('is_ptsp')->default(false)->after('kategori');
            }
            if (!Schema::hasColumn('berkas', 'uploaded_by_role')) {
                $table->string('uploaded_by_role')->nullable()->after('is_ptsp');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('berkas', function (Blueprint $table) {
            if (Schema::hasColumn('berkas', 'is_ptsp')) {
                $table->dropColumn('is_ptsp');
            }
            if (Schema::hasColumn('berkas', 'uploaded_by_role')) {
                $table->dropColumn('uploaded_by_role');
            }
        });
    }
};
