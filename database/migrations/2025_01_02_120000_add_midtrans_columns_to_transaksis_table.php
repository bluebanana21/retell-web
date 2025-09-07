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
            $table->string('order_id')->nullable()->after('id_reservasi');
            $table->string('transaction_id')->nullable()->after('order_id');
            $table->string('midtrans_payment_type')->nullable()->after('status_pembayaran');
            $table->string('midtrans_transaction_status')->nullable()->after('midtrans_payment_type');
            $table->string('midtrans_fraud_status')->nullable()->after('midtrans_transaction_status');
            $table->text('snap_token')->nullable()->after('midtrans_fraud_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaksis', function (Blueprint $table) {
            $table->dropColumn([
                'order_id', 
                'transaction_id', 
                'midtrans_payment_type', 
                'midtrans_transaction_status', 
                'midtrans_fraud_status', 
                'snap_token'
            ]);
        });
    }
};
