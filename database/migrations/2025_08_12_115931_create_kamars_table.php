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
        Schema::create('kamars', function (Blueprint $table) {
            $table->id('id_kamar');
            $table->foreignId('id_hotel')->constrained('hotel')->onDelete('cascade');
            $table->foreignId('detail_id')->constrained('detail_kamars', 'detail_id')->onDelete('cascade');
            $table->integer('harga_per_malam');
            $table->integer('lantai');
            $table->enum('status', ['tersedia', 'dibooked', 'maintenance'])->default('tersedia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kamars');
    }
};