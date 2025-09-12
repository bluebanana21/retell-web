<x-form-layout>
    <div class="max-w-2xl mx-auto text-center">
        <div class="bg-white rounded-lg p-8 shadow-xl">
            <!-- Failed Icon -->
            <div class="w-16 h-16 mx-auto mb-4 bg-red-100 rounded-full flex items-center justify-center">
                <i class="fas fa-times text-red-600 text-2xl"></i>
            </div>
            
            <h1 class="text-2xl font-bold text-red-600 mb-2">Pembayaran Gagal!</h1>
            <p class="text-gray-600 mb-6">Maaf, pembayaran Anda tidak dapat diproses. Silakan coba lagi atau gunakan metode pembayaran lain.</p>
            
            <!-- Transaction Details -->
            <div class="bg-gray-50 rounded-lg p-6 mb-6 text-left">
                <h3 class="font-bold mb-4">Detail Transaksi</h3>
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Order ID:</span>
                        <span class="font-mono">{{ $transaction->order_id }}</span>
                    </div>
                    @if($transaction->transaction_id)
                    <div class="flex justify-between">
                        <span class="text-gray-600">Transaction ID:</span>
                        <span class="font-mono">{{ $transaction->transaction_id }}</span>
                    </div>
                    @endif
                    <div class="flex justify-between">
                        <span class="text-gray-600">Metode Pembayaran:</span>
                        <span>{{ $transaction->midtrans_payment_type ? ucwords(str_replace('_', ' ', $transaction->midtrans_payment_type)) : 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Jumlah:</span>
                        <span class="font-bold">Rp {{ number_format($transaction->jumlah_pembayaran, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Tanggal:</span>
                        <span>{{ $transaction->tanggal_pembayaran->format('d M Y H:i') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Status:</span>
                        <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-sm font-semibold">
                            {{ ucfirst($transaction->status_pembayaran) }}
                        </span>
                    </div>
                </div>
            </div>
            
            <!-- Reservation Details -->
            <div class="bg-blue-50 rounded-lg p-6 mb-6 text-left">
                <h3 class="font-bold mb-4">Detail Reservasi</h3>
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Hotel:</span>
                        <span class="font-semibold">{{ $reservasi->kamar->hotel->nama_hotel }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Tipe Kamar:</span>
                        <span>{{ $reservasi->kamar->detailKamar->tipe_kamar }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Check-in:</span>
                        <span>{{ $reservasi->check_in->format('d M Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Check-out:</span>
                        <span>{{ $reservasi->check_out->format('d M Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Status Reservasi:</span>
                        <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-sm font-semibold">
                            {{ ucfirst($reservasi->status) }}
                        </span>
                    </div>
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center mb-6">
                <a href="{{ route('payment.show', $reservasi) }}" 
                   class="bg-blue-600 text-white px-6 py-3 rounded-md hover:bg-blue-700 font-semibold">
                    <i class="fas fa-redo mr-2"></i>Coba Lagi
                </a>
                <a href="{{ route('home') }}" 
                   class="bg-gray-600 text-white px-6 py-3 rounded-md hover:bg-gray-700 font-semibold">
                    <i class="fas fa-home mr-2"></i>Kembali ke Beranda
                </a>
            </div>
            
            <!-- Help Information -->
            <div class="p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                <h4 class="font-semibold text-yellow-800 mb-2">Butuh Bantuan?</h4>
                <p class="text-sm text-yellow-700 mb-3">
                    Jika Anda mengalami kesulitan dengan pembayaran, berikut beberapa langkah yang dapat Anda coba:
                </p>
                <ul class="text-sm text-yellow-700 text-left list-disc list-inside space-y-1">
                    <li>Pastikan saldo atau limit kartu kredit Anda mencukupi</li>
                    <li>Coba gunakan metode pembayaran lain</li>
                    <li>Periksa koneksi internet Anda</li>
                    <li>Hubungi customer service bank atau penyedia pembayaran Anda</li>
                    <li>Jika masalah berlanjut, hubungi customer service kami</li>
                </ul>
                <div class="mt-4 p-3 bg-white border border-yellow-300 rounded-md">
                    <p class="text-sm text-yellow-800">
                        <i class="fas fa-info-circle mr-2"></i>
                        <strong>Informasi Penting:</strong> Jika Anda melihat pesan "system error", ini biasanya berarti ada masalah sementara dengan sistem pembayaran. Silakan coba lagi dalam beberapa menit.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-form-layout>
