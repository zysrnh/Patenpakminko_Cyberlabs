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
        Schema::create('lapolpa_bookings', function (Blueprint $table) {
            $table->id();
            // Setiap pelaku usaha hanya boleh booking 1 kali saja (unique)
            $table->foreignId('user_id')->unique()->constrained('users')->onDelete('cascade');
            $table->string('whatsapp_number');
            $table->date('booking_date');
            $table->time('time_start');
            $table->time('time_end');
            $table->string('status')->default('booked'); // 'booked', 'selesai', 'dibatalkan'
            $table->timestamps();
        });
    }
 
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lapolpa_bookings');
    }
};
