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
        // 1. Jadikan user_id di tabel reviews menjadi nullable untuk mendukung ulasan publik/guest
        Schema::table('reviews', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->change();
        });

        // 2. Migrasikan data lama LAPOLPAK dari informal_ratings ke reviews
        $oldLapolpaRatings = DB::table('informal_ratings')
            ->where('informal_type', 'LAPOLPA')
            ->get();

        foreach ($oldLapolpaRatings as $item) {
            $bookingId = (int) ($item->latitude ?: 0);
            
            // Cek apakah booking LAPOLPAK ada
            $booking = $bookingId > 0 ? DB::table('lapolpa_bookings')->where('id', $bookingId)->first() : null;
            $userId = $item->user_id ?: ($booking ? $booking->user_id : null);

            // Cek apakah review sudah pernah ada di tabel reviews
            $exists = DB::table('reviews')
                ->where('module_type', 'lapolpa')
                ->where('module_id', $bookingId)
                ->exists();

            if (!$exists) {
                $rating = (int) ($item->rating ?: 5);
                $ratingLabels = [
                    5 => 'Sangat Baik',
                    4 => 'Baik',
                    3 => 'Cukup Baik',
                    2 => 'Kurang',
                    1 => 'Sangat Kurang'
                ];

                DB::table('reviews')->insert([
                    'user_id' => $userId,
                    'module_type' => 'lapolpa',
                    'module_id' => $bookingId,
                    'rating' => $rating,
                    'rating_label' => $ratingLabels[$rating] ?? 'Baik',
                    'comment' => $item->comment ?: 'Pelayanan LAPOL PAK sangat baik.',
                    'is_approved' => isset($item->is_approved) ? (bool)$item->is_approved : true,
                    'created_at' => $item->created_at ?: now(),
                    'updated_at' => $item->updated_at ?: now(),
                ]);
            }
        }

        // 3. Bersihkan data LAPOLPAK dari tabel informal_ratings
        DB::table('informal_ratings')->where('informal_type', 'LAPOLPA')->delete();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Rollback tidak mengembalikan data yang sudah dipindahkan
    }
};
