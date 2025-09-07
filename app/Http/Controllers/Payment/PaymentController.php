<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Reservasi;
use App\Models\Transaksi;
use App\Services\MidtransService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    protected $midtransService;

    public function __construct(MidtransService $midtransService)
    {
        $this->midtransService = $midtransService;
    }

    public function show(Reservasi $reservasi)
    {
        // Ensure user owns this reservation
        if ($reservasi->id_user !== Auth::id()) {
            abort(403, 'Unauthorized access to this reservation.');
        }

        // Check if reservation is payable
        if (!in_array($reservasi->status, ['pending', 'confirmed'])) {
            return redirect()->route('guest.booking.success', $reservasi)
                ->with('error', 'This reservation cannot be paid.');
        }

        // Load related data
        $reservasi->load(['kamar.hotel', 'kamar.detailKamar', 'user', 'transaksis']);

        // Get existing transaction if any
        $transaction = $reservasi->transaksis->first();

        return view('payment.show', compact('reservasi', 'transaction'));
    }

    public function process(Request $request, Reservasi $reservasi)
    {
        // Validate request
        $request->validate([
            'phone' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'postal_code' => 'required|string',
        ]);

        // Ensure user owns this reservation
        if ($reservasi->id_user !== Auth::id()) {
            abort(403, 'Unauthorized access to this reservation.');
        }

        // Check if reservation is payable
        if (!in_array($reservasi->status, ['pending', 'confirmed'])) {
            return response()->json([
                'success' => false,
                'message' => 'This reservation cannot be paid.'
            ], 400);
        }

        try {
            // Prepare customer details
            $customerDetails = [
                'phone' => $request->phone,
                'address' => $request->address,
                'city' => $request->city,
                'postal_code' => $request->postal_code,
            ];

            // Create Midtrans transaction
            $paymentData = $this->midtransService->createTransaction($reservasi, $customerDetails);

            return response()->json([
                'success' => true,
                'snap_token' => $paymentData['snap_token'],
                'order_id' => $paymentData['order_id']
            ]);

        } catch (\Exception $e) {
            Log::error('Payment processing failed: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to process payment. Please try again.'
            ], 500);
        }
    }

    public function callback(Request $request)
    {
        try {
            $notificationData = $request->all();
            
            // Handle the notification
            $transaction = $this->midtransService->handleNotification($notificationData);
            
            Log::info('Payment notification processed for order: ' . $transaction->order_id);
            
            return response()->json(['status' => 'success']);
            
        } catch (\Exception $e) {
            Log::error('Payment callback failed: ' . $e->getMessage());
            
            return response()->json(['status' => 'error'], 500);
        }
    }

    public function success(Request $request)
    {
        $orderId = $request->query('order_id');
        $transactionStatus = $request->query('transaction_status');

        if (!$orderId) {
            return redirect()->route('home')->with('error', 'Invalid payment session.');
        }

        // Find transaction
        $transaction = Transaksi::where('order_id', $orderId)->first();
        
        if (!$transaction) {
            return redirect()->route('home')->with('error', 'Transaction not found.');
        }

        // Load reservation with related data
        $reservasi = $transaction->reservasi;
        $reservasi->load(['kamar.hotel', 'kamar.detailKamar', 'user']);

        return view('payment.success', compact('transaction', 'reservasi'));
    }

    public function pending(Request $request)
    {
        $orderId = $request->query('order_id');
        
        if (!$orderId) {
            return redirect()->route('home')->with('error', 'Invalid payment session.');
        }

        // Find transaction
        $transaction = Transaksi::where('order_id', $orderId)->first();
        
        if (!$transaction) {
            return redirect()->route('home')->with('error', 'Transaction not found.');
        }

        // Load reservation with related data
        $reservasi = $transaction->reservasi;
        $reservasi->load(['kamar.hotel', 'kamar.detailKamar', 'user']);

        return view('payment.pending', compact('transaction', 'reservasi'));
    }

    public function failed(Request $request)
    {
        $orderId = $request->query('order_id');
        
        if (!$orderId) {
            return redirect()->route('home')->with('error', 'Invalid payment session.');
        }

        // Find transaction
        $transaction = Transaksi::where('order_id', $orderId)->first();
        
        if (!$transaction) {
            return redirect()->route('home')->with('error', 'Transaction not found.');
        }

        // Load reservation with related data
        $reservasi = $transaction->reservasi;
        $reservasi->load(['kamar.hotel', 'kamar.detailKamar', 'user']);

        return view('payment.failed', compact('transaction', 'reservasi'));
    }

    public function checkStatus(Request $request)
    {
        $orderId = $request->input('order_id');
        
        try {
            $status = $this->midtransService->getTransactionStatus($orderId);
            
            return response()->json([
                'success' => true,
                'status' => $status
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
