<x-form-layout>
    <div class="max-w-2xl mx-auto text-center">
        <div class="bg-white rounded-lg p-8 shadow-xl">
            <!-- Pending Icon -->
            <div class="w-16 h-16 mx-auto mb-4 bg-yellow-100 rounded-full flex items-center justify-center">
                <i class="fas fa-clock text-yellow-600 text-2xl"></i>
            </div>
            
            <h1 class="text-2xl font-bold text-yellow-600 mb-2">Pembayaran Menunggu Konfirmasi</h1>
            <p class="text-gray-600 mb-6">Pembayaran Anda sedang diproses. Harap menunggu konfirmasi dari sistem pembayaran.</p>
            
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
                        <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm font-semibold">
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
                        <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm font-semibold">
                            {{ ucfirst($reservasi->status) }}
                        </span>
                    </div>
                </div>
            </div>
            
            <!-- Status Check Button -->
            <div class="mb-6">
                <button id="check-status-btn" 
                        class="bg-yellow-600 text-white px-6 py-3 rounded-md hover:bg-yellow-700 font-semibold">
                    <i class="fas fa-sync-alt mr-2"></i>Cek Status Pembayaran
                </button>
            </div>
            
            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('home') }}" 
                   class="bg-gray-600 text-white px-6 py-3 rounded-md hover:bg-gray-700 font-semibold">
                    <i class="fas fa-home mr-2"></i>Kembali ke Beranda
                </a>
            </div>
            
            <!-- Instructions -->
            <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                <h4 class="font-semibold text-blue-800 mb-2">Instruksi Pembayaran:</h4>
                @if($transaction->midtrans_payment_type === 'bank_transfer')
                    <p class="text-sm text-blue-700">
                        Silakan lakukan transfer sesuai dengan instruksi yang telah Anda terima. 
                        Pembayaran akan otomatis terkonfirmasi setelah transfer berhasil.
                    </p>
                @elseif(str_contains($transaction->midtrans_payment_type, '_va'))
                    <p class="text-sm text-blue-700">
                        Silakan lakukan pembayaran melalui Virtual Account yang telah diberikan. 
                        Pembayaran akan otomatis terkonfirmasi dalam beberapa menit.
                    </p>
                @elseif(in_array($transaction->midtrans_payment_type, ['gopay', 'shopeepay', 'dana', 'linkaja', 'ovo']))
                    <p class="text-sm text-blue-700">
                        Silakan selesaikan pembayaran di aplikasi {{ ucwords($transaction->midtrans_payment_type) }} Anda. 
                        Status akan terupdate otomatis setelah pembayaran selesai.
                    </p>
                @else
                    <p class="text-sm text-blue-700">
                        Silakan selesaikan proses pembayaran sesuai metode yang Anda pilih. 
                        Status akan terupdate otomatis setelah pembayaran terkonfirmasi.
                    </p>
                @endif
            </div>
        </div>
    </div>

    <script>
        document.getElementById('check-status-btn').addEventListener('click', function() {
            const btn = this;
            const originalText = btn.innerHTML;
            
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memeriksa...';
            
            fetch('{{ route("payment.check.status") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    order_id: '{{ $transaction->order_id }}'
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const status = data.status;
                    if (status.transaction_status === 'settlement' || status.transaction_status === 'capture') {
                        window.location.href = '{{ route("payment.success") }}?order_id={{ $transaction->order_id }}&transaction_status=' + status.transaction_status;
                    } else if (status.transaction_status === 'deny' || status.transaction_status === 'cancel' || status.transaction_status === 'expire') {
                        window.location.href = '{{ route("payment.failed") }}?order_id={{ $transaction->order_id }}&transaction_status=' + status.transaction_status;
                    } else {
                        // Still pending, just reload the page
                        location.reload();
                    }
                } else {
                    alert('Gagal memeriksa status pembayaran. Silakan coba lagi.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat memeriksa status.');
            })
            .finally(() => {
                btn.disabled = false;
                btn.innerHTML = originalText;
            });
        });

        // Auto-refresh every 30 seconds
        setInterval(() => {
            document.getElementById('check-status-btn').click();
        }, 30000);
    </script>
</x-form-layout>
