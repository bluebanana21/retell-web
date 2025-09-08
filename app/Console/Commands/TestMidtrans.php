<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\MidtransService;
use App\Models\Reservasi;
use App\Models\User;
use App\Models\Kamar;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Log;

class TestMidtrans extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-midtrans {--notification}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test Midtrans configuration';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if ($this->option('notification')) {
            $this->testNotification();
        } else {
            $this->testPaymentCreation();
        }
    }

    private function testPaymentCreation()
    {
        try {
            $this->info('Testing Midtrans configuration...');
            
            // Create a test user if none exists
            $user = User::first();
            if (!$user) {
                $user = User::factory()->create([
                    'name' => 'Test User',
                    'email' => 'test@example.com',
                    'password' => bcrypt('password')
                ]);
            }
            
            // Get a test room
            $kamar = Kamar::first();
            if (!$kamar) {
                $this->error('No rooms available. Please run database seeders.');
                return;
            }
            
            // Create a test reservation
            $reservasi = Reservasi::create([
                'id_user' => $user->id,
                'kamar_id' => $kamar->id_kamar,
                'tanggal_reservasi' => now(),
                'check_in' => now()->addDay(),
                'check_out' => now()->addDays(2),
                'status' => 'pending',
                'total_harga' => 100000
            ]);
            
            $this->info('Created test reservation: ' . $reservasi->id_reservasi);
            
            // Initialize Midtrans service
            $midtransService = new MidtransService();
            
            // Test creating a transaction
            $customerDetails = [
                'phone' => '+628123456789',
                'address' => 'Test Address',
                'city' => 'Test City',
                'postal_code' => '12345'
            ];
            
            $result = $midtransService->createTransaction($reservasi, $customerDetails);
            
            $this->info('Midtrans transaction created successfully!');
            $this->info('Order ID: ' . $result['order_id']);
            $this->info('Snap Token: ' . substr($result['snap_token'], 0, 20) . '...');
            
            // Show transaction details
            $transaction = Transaksi::where('order_id', $result['order_id'])->first();
            if ($transaction) {
                $this->info('Transaction details:');
                $this->info('- Order ID: ' . $transaction->order_id);
                $this->info('- Payment method: ' . $transaction->metode_pembayaran);
                $this->info('- Midtrans payment type: ' . ($transaction->midtrans_payment_type ?? 'Not set'));
                $this->info('- Status: ' . $transaction->status_pembayaran);
            }
            
        } catch (\Exception $e) {
            $this->error('Midtrans configuration test failed: ' . $e->getMessage());
            Log::error('Midtrans test failed: ' . $e->getMessage());
        }
    }

    private function testNotification()
    {
        $this->info('Testing notification handling...');
        
        // This would simulate a notification from Midtrans
        // In a real scenario, this would come from the webhook
        $this->info('In a real scenario, this would test the webhook callback.');
        $this->info('You can test this by making a payment and checking if the transaction status updates correctly.');
    }
}
