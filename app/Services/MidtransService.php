<?php

namespace App\Services;

use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Transaction;
use Midtrans\Notification;
use App\Models\Transaksi;
use App\Models\Reservasi;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class MidtransService
{
    public function __construct()
    {
        $serverKey = config('midtrans.server_key');
        $merchantId = config('midtrans.merchant_id');
        $clientKey = config('midtrans.client_key');
        $isProduction = config('midtrans.is_production', false);
        $isSanitized = config('midtrans.is_sanitized', true);
        $is3ds = config('midtrans.is_3ds', true);
        
        // Log raw configuration values for debugging
        Log::info('Midtrans Configuration Values', [
            'server_key' => $serverKey,
            'merchant_id' => $merchantId,
            'client_key' => $clientKey,
            'is_production' => $isProduction,
            'is_sanitized' => $isSanitized,
            'is_3ds' => $is3ds
        ]);
        
        // Validation
        $validationErrors = [];
        if (empty($serverKey)) {
            $validationErrors[] = 'Server key is missing or empty';
        }
        if (empty($merchantId)) {
            $validationErrors[] = 'Merchant ID is missing or empty';
        }
        if (empty($clientKey)) {
            $validationErrors[] = 'Client key is missing or empty';
        }
        
        if (!empty($validationErrors)) {
            Log::error('Midtrans configuration validation failed', [
                'errors' => $validationErrors,
                'merchant_id' => $merchantId ? 'set' : 'missing',
                'client_key' => $clientKey ? 'set' : 'missing',
                'server_key' => $serverKey ? 'set' : 'missing'
            ]);
            throw new \Exception('Midtrans configuration is invalid: ' . implode(', ', $validationErrors));
        }
        
        // Set configuration
        Config::$serverKey = $serverKey;
        Config::$isProduction = $isProduction;
        Config::$isSanitized = $isSanitized;
        Config::$is3ds = $is3ds;
        
        // Log configuration for debugging
        Log::info('Midtrans Configuration loaded successfully', [
            'server_key_exists' => !empty(Config::$serverKey),
            'merchant_id_exists' => !empty($merchantId),
            'client_key_exists' => !empty($clientKey),
            'is_production' => Config::$isProduction,
            'is_sanitized' => Config::$isSanitized,
            'is_3ds' => Config::$is3ds
        ]);
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
            // Log the parameters being sent to Midtrans
            Log::info('Creating Midtrans payment', [
                'order_id' => $orderId,
                'amount' => $reservasi->total_harga,
                'customer' => $reservasi->user->email,
                'params' => $params
            ]);

            // Attempt to create the transaction with retry logic for system errors
            $maxRetries = 3;
            $retryCount = 0;
            
            while ($retryCount < $maxRetries) {
                try {
                    $snapToken = Snap::getSnapToken($params);
                    break; // Success, exit the retry loop
                } catch (\Exception $e) {
                    $retryCount++;
                    
                    // If it's not a system error or we've reached max retries, throw the exception
                    if (strpos($e->getMessage(), 'system error') === false || $retryCount >= $maxRetries) {
                        throw $e;
                    }
                    
                    // Wait before retrying (exponential backoff)
                    usleep(500000 * $retryCount); // 0.5s, 1s, 1.5s
                    Log::warning('Retrying Midtrans payment creation due to system error', [
                        'attempt' => $retryCount,
                        'order_id' => $orderId
                    ]);
                }
            }

            Log::info('Snap token created successfully', [
                'order_id' => $orderId,
                'snap_token_length' => strlen($snapToken)
            ]);

            // Create or update transaction record
            $transaction = Transaksi::updateOrCreate(
                ['id_reservasi' => $reservasi->id_reservasi],
                [
                    'order_id' => $orderId,
                    'jumlah_pembayaran' => $reservasi->total_harga,
                    'metode_pembayaran' => 'midtrans', // Add default payment method
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
            Log::error('Midtrans payment creation failed', [
                'order_id' => $orderId,
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'trace' => $e->getTraceAsString()
            ]);
            
            // Provide more specific error messages based on the exception
            $errorMessage = 'Failed to create payment. ';
            
            // Check for common Midtrans errors
            if (strpos($e->getMessage(), '401') !== false) {
                $errorMessage .= 'Authentication failed. Please contact support.';
            } elseif (strpos($e->getMessage(), '400') !== false) {
                $errorMessage .= 'Invalid request data. Please check your input.';
            } elseif (strpos($e->getMessage(), '500') !== false || strpos($e->getMessage(), 'system error') !== false) {
                $errorMessage .= 'System error from payment provider. Please try again in a few minutes.';
            } else {
                $errorMessage .= 'Please try again or contact support if the problem persists.';
            }
            
            throw new \Exception($errorMessage);
        }
    }

    public function handleNotification(array $notificationData)
    {
        try {
            $notification = new Notification($notificationData);

            $orderId = $notification->order_id;
            $transactionStatus = $notification->transaction_status;
            $transactionId = $notification->transaction_id;
            $fraudStatus = $notification->fraud_status ?? null;
            $paymentType = $notification->payment_type;

            // Find transaction
            $transaction = Transaksi::where('order_id', $orderId)->first();

            if (!$transaction) {
                Log::error('Transaction not found for notification', ['order_id' => $orderId]);
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

            Log::info('Midtrans notification processed successfully', [
                'order_id' => $orderId,
                'status' => $transactionStatus,
                'fraud_status' => $fraudStatus
            ]);

            return $transaction;
        } catch (\Exception $e) {
            Log::error('Error processing Midtrans notification', [
                'order_id' => $orderId ?? 'unknown',
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    private function updateReservationStatus(Transaksi $transaction, string $status)
    {
        $reservasi = $transaction->reservasi;
        $reservasi->update(['status' => $status]);

        // If cancelled/denied, make room available again
        if (in_array($status, ['cancelled', 'denied'])) {
            $reservasi->kamar->update(['status' => 'tersedia']);
        }
        
        Log::info('Reservation status updated', [
            'reservation_id' => $reservasi->id_reservasi,
            'new_status' => $status
        ]);
    }

    public function getTransactionStatus(string $orderId)
    {
        try {
            Log::info('Checking Midtrans transaction status', ['order_id' => $orderId]);
            
            $status = Transaction::status($orderId);
            
            Log::info('Midtrans status retrieved', [
                'order_id' => $orderId,
                'status' => $status
            ]);
            
            return $status;
        } catch (\Exception $e) {
            Log::error('Midtrans API error', [
                'order_id' => $orderId,
                'error' => $e->getMessage(),
                'code' => $e->getCode() ?? 'unknown'
            ]);
            
            // Provide more specific error messages
            $errorMessage = 'Failed to get transaction status. ';
            
            if ($e->getCode() == 404) {
                $errorMessage .= 'Transaction not found.';
            } elseif ($e->getCode() == 401) {
                $errorMessage .= 'Authentication failed.';
            } elseif ($e->getCode() >= 500) {
                $errorMessage .= 'System error from payment provider. Please try again later.';
            } else {
                $errorMessage .= 'Please try again.';
            }
            
            throw new \Exception($errorMessage);
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