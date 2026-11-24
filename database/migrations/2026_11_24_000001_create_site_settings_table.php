<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('site_settings')) {
            Schema::create('site_settings', function (Blueprint $table) {
                $table->id();
                $table->string('key')->unique();
                $table->longText('value')->nullable();
                $table->timestamps();
            });

            // Ambil data awal dari visitor_stats.json jika ada, atau default 2800
            $initialCount = 2800;
            $initialPenyelesaian = '10 hari';
            $initialPermohonan = '';
            $initialRating = '';

            $jsonPath = storage_path('app/visitor_stats.json');
            if (file_exists($jsonPath)) {
                $saved = json_decode(file_get_contents($jsonPath), true);
                if (is_array($saved)) {
                    $initialCount = max((int)($saved['count'] ?? 0), 2800);
                    $initialPenyelesaian = $saved['rata_rata_penyelesaian'] ?? '10 hari';
                    $initialPermohonan = $saved['permohonan_diproses'] ?? '';
                    $initialRating = $saved['rating_override'] ?? '';
                }
            }

            DB::table('site_settings')->insert([
                ['key' => 'visitor_count', 'value' => (string)$initialCount, 'created_at' => now(), 'updated_at' => now()],
                ['key' => 'rata_rata_penyelesaian', 'value' => $initialPenyelesaian, 'created_at' => now(), 'updated_at' => now()],
                ['key' => 'permohonan_diproses', 'value' => $initialPermohonan, 'created_at' => now(), 'updated_at' => now()],
                ['key' => 'rating_override', 'value' => $initialRating, 'created_at' => now(), 'updated_at' => now()],
                ['key' => 'gdrive_folder_id', 'value' => '', 'created_at' => now(), 'updated_at' => now()],
                ['key' => 'gdrive_credentials', 'value' => '', 'created_at' => now(), 'updated_at' => now()],
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
