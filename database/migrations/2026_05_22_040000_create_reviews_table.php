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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('module_type'); // 'non_berusaha', 'berusaha', 'kebijakan', 'lapolpa'
            $table->unsignedBigInteger('module_id');
            $table->integer('rating'); // 1 s.d. 5
            $table->string('rating_label'); // 'Sangat Baik', 'Baik', 'Cukup Baik', 'Kurang', 'Sangat Kurang'
            $table->text('comment')->nullable(); // sedikit catatan
            $table->boolean('is_approved')->default(false); // moderasi admin (default: false)
            $table->timestamps();
 
            // Kombinasi module_type & module_id & user_id harus unik agar 1 permohonan/booking hanya bisa diberi 1 ulasan (anti-spam)
            $table->unique(['user_id', 'module_type', 'module_id']);
        });
    }
 
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
