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
        Schema::create('reservasis', function (Blueprint $table) {
            $table->id('id_reservasi');
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->foreignId('kamar_id')->constrained('kamars', 'id_kamar')->onDelete('cascade');
            $table->datetime('tanggal_reservasi');
            $table->foreignId('id_voucher')->nullable()->constrained('vouchers', 'id_voucher')->onDelete('set null');
            $table->datetime('check_in');
            $table->datetime('check_out');
            $table->enum('status', ['pending', 'dikonfirmasi', 'selesai'])->default('pending');
            $table->float('total_harga');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservasis');
    }
};
