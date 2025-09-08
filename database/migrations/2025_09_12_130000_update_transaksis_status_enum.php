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
        Schema::table('transaksis', function (Blueprint $table) {
            // Modify the status enum to include all possible Midtrans statuses
            $table->enum('status_pembayaran', [
                'pending', 'success', 'gagal', 'challenge', 'cancelled', 
                'expired', 'denied', 'settlement', 'capture'
            ])->default('pending')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaksis', function (Blueprint $table) {
            $table->enum('status_pembayaran', ['sukses', 'gagal', 'pending'])->default('pending')->change();
        });
    }
};
