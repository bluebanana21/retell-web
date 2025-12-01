<x-form-layout>
    <div class="max-w-2xl mx-auto text-center">
        <div class="bg-white rounded-lg p-8 shadow-xl">
            <!-- Success Icon -->
            <div class="w-16 h-16 mx-auto mb-4 bg-green-100 rounded-full flex items-center justify-center">
                <i class="fas fa-check text-green-600 text-2xl"></i>
            </div>
            
            <h1 class="text-2xl font-bold text-green-600 mb-2">Pembayaran Berhasil!</h1>
            <p class="text-gray-600 mb-6">Terima kasih! Pembayaran Anda telah berhasil diproses.</p>
            
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
                        <span class="px-2 py-1 rounded-full text-sm font-semibold
                            @if($transaction->status_pembayaran === 'pending') bg-yellow-100 text-yellow-800
                            @elseif(in_array($transaction->status_pembayaran, ['success', 'settlement', 'capture'])) bg-green-100 text-green-800
                            @elseif($transaction->status_pembayaran === 'challenge') bg-orange-100 text-orange-800
                            @else bg-red-100 text-red-800
                            @endif">
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
                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-sm font-semibold">
                            {{ ucfirst($reservasi->status) }}
                        </span>
                    </div>
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('guest.booking.success', $reservasi) }}" 
                   class="bg-blue-600 text-white px-6 py-3 rounded-md hover:bg-blue-700 font-semibold">
                    <i class="fas fa-file-alt mr-2"></i>Lihat Detail Reservasi
                </a>
                <a href="{{ route('guest.print.reservation', $reservasi) }}" 
                   class="bg-gray-600 text-white px-6 py-3 rounded-md hover:bg-gray-700 font-semibold" target="_blank">
                    <i class="fas fa-print mr-2"></i>Cetak Voucher
                </a>
                <a href="{{ route('home') }}" 
                   class="bg-green-600 text-white px-6 py-3 rounded-md hover:bg-green-700 font-semibold">
                    <i class="fas fa-home mr-2"></i>Kembali ke Beranda
                </a>
            </div>
            
            <!-- Important Notice -->
            <div class="mt-6 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                <p class="text-sm text-yellow-800">
                    <i class="fas fa-info-circle mr-2"></i>
                    <strong>Penting:</strong> Simpan detail transaksi ini untuk referensi Anda. 
                    Voucher reservasi telah dikirim ke email Anda.
                </p>
            </div>
        </div>
    </div>
</x-form-layout>
