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
        Schema::create('hotel_fasilitas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id')->constrained('hotel')->onDelete('cascade');
            $table->foreignId('fasilitas_id')->constrained('fasilitas')->onDelete('cascade');
            $table->timestamps();
            
            // Unique constraint untuk mencegah duplikasi
            $table->unique(['hotel_id', 'fasilitas_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotel_fasilitas');
    }
};