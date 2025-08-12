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
        Schema::create('detail_kamars', function (Blueprint $table) {
            $table->id('detail_id');
            $table->enum('tipe_kamar', ['reguler', 'suite', 'deluxe']);
            $table->integer('jumlah_kasur');
            $table->integer('kapasitas');
            $table->text('fasilitas');
            $table->text('deskripsi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_kamars');
    }
};
