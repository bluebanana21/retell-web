<?php

namespace App\Services;

use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Transaction;
use Midtrans\Notification;
use App\Models\Transaksi;
use App\Models\Reservasi;
use Illuminate\Support\Str;

class MidtransService
{
    public function __construct()
    {
        // Set your Merchant Server Key
        Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment.
        Config::$isProduction = config('midtrans.is_production');
        // Set sanitization on (default)
        Config::$isSanitized = config('midtrans.is_sanitized');
        // Set 3DS transaction for credit card to true
        Config::$is3ds = config('midtrans.is_3ds');
    }

    public function createTransaction(Reservasi $reservasi, array $customerDetails = [])
    {
        $orderId = 'ORDER-' . $reservasi->id_reservasi . '-' . time();

        // Get hotel and room details
        $reservasi->load(['kamar.hotel', 'kamar.detailKamar', 'user']);

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => (int) $reservasi->total_harga,
            ],
            'item_details' => [
                [
                    'id' => 'ROOM-' . $reservasi->kamar_id,
                    'price' => (int) $reservasi->total_harga,
                    'quantity' => 1,
                    'name' => $reservasi->kamar->detailKamar->tipe_kamar . ' - ' . $reservasi->kamar->hotel->nama_hotel,
                    'brand' => $reservasi->kamar->hotel->nama_hotel,
                    'category' => 'Hotel Room',
                ]
            ],
            'customer_details' => [
                'first_name' => $reservasi->user->name,
                'email' => $reservasi->user->email,
                'phone' => $customerDetails['phone'] ?? '',
                'billing_address' => [
                    'first_name' => $reservasi->user->name,
                    'email' => $reservasi->user->email,
                    'phone' => $customerDetails['phone'] ?? '',
                    'address' => $customerDetails['address'] ?? '',
                    'city' => $customerDetails['city'] ?? '',
                    'postal_code' => $customerDetails['postal_code'] ?? '',
                    'country_code' => 'IDN'
                ]
            ],
            'enabled_payments' => [
                'credit_card',
                'bca_va',
                'bni_va',
                'bri_va',
                'permata_va',
                'other_va',
                'gopay',
                'shopeepay',
                'dana',
                'linkaja',
                'ovo'
            ],
            'credit_card' => [
                'secure' => true
            ]
        ];

        try {
            $snapToken = Snap::getSnapToken($params);

            // Create or update transaction record
            $transaction = Transaksi::updateOrCreate(
                ['id_reservasi' => $reservasi->id_reservasi],
                [
                    'order_id' => $orderId,
                    'jumlah_pembayaran' => $reservasi->total_harga,
                    'status_pembayaran' => 'pending',
                    'snap_token' => $snapToken,
                    'tanggal_pembayaran' => now()
                ]
            );

            return [
                'snap_token' => $snapToken,
                'order_id' => $orderId,
                'transaction' => $transaction
            ];
        } catch (\Exception $e) {
            throw new \Exception('Failed to create payment: ' . $e->getMessage());
        }
    }

    public function handleNotification(array $notificationData)
    {
        $notification = new Notification();

        $orderId = $notification->order_id;
        $transactionStatus = $notification->transaction_status;
        $transactionId = $notification->transaction_id;
        $fraudStatus = $notification->fraud_status ?? null;
        $paymentType = $notification->payment_type;

        // Find transaction
        $transaction = Transaksi::where('order_id', $orderId)->first();

        if (!$transaction) {
            throw new \Exception('Transaction not found');
        }

        // Update transaction details
        $transaction->update([
            'transaction_id' => $transactionId,
            'midtrans_payment_type' => $paymentType,
            'midtrans_transaction_status' => $transactionStatus,
            'midtrans_fraud_status' => $fraudStatus,
        ]);

        // Handle different transaction statuses
        if ($transactionStatus == 'capture') {
            if ($fraudStatus == 'challenge') {
                $transaction->update(['status_pembayaran' => 'challenge']);
            } else if ($fraudStatus == 'accept') {
                $transaction->update(['status_pembayaran' => 'success']);
                $this->updateReservationStatus($transaction, 'confirmed');
            }
        } else if ($transactionStatus == 'settlement') {
            $transaction->update(['status_pembayaran' => 'success']);
            $this->updateReservationStatus($transaction, 'confirmed');
        } else if ($transactionStatus == 'pending') {
            $transaction->update(['status_pembayaran' => 'pending']);
        } else if ($transactionStatus == 'deny') {
            $transaction->update(['status_pembayaran' => 'gagal']);
            $this->updateReservationStatus($transaction, 'cancelled');
        } else if ($transactionStatus == 'expire') {
            $transaction->update(['status_pembayaran' => 'gagal']);
            $this->updateReservationStatus($transaction, 'cancelled');
        } else if ($transactionStatus == 'cancel') {
            $transaction->update(['status_pembayaran' => 'gagal']);
            $this->updateReservationStatus($transaction, 'cancelled');
        }

        return $transaction;
    }

    private function updateReservationStatus(Transaksi $transaction, string $status)
    {
        $reservasi = $transaction->reservasi;
        $reservasi->update(['status' => $status]);

        // If cancelled/denied, make room available again
        if (in_array($status, ['cancelled', 'denied'])) {
            $reservasi->kamar->update(['status' => 'tersedia']);
        }
    }

    public function getTransactionStatus(string $orderId)
    {
        try {
            return Transaction::status($orderId);
        } catch (\Exception $e) {
            throw new \Exception('Failed to get transaction status: ' . $e->getMessage());
        }
    }

    public function cancelTransaction(string $orderId)
    {
        try {
            return Transaction::cancel($orderId);
        } catch (\Exception $e) {
            throw new \Exception('Failed to cancel transaction: ' . $e->getMessage());
        }
    }
}
