<x-form-layout>
    <div class="max-w-4xl mx-auto">
        <h1 class="font-bold text-left text-2xl mb-2">Pembayaran</h1>
        <h2 class="retell-blue font-bold text-left mb-6">
            Lengkapi pembayaran Anda untuk mengkonfirmasi reservasi.
        </h2>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                {{ session('error') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Payment Form -->
            <div class="md:col-span-2">
                <div class="bg-white rounded-lg p-6 shadow-xl">
                    <h3 class="font-bold text-lg mb-4">Detail Pembayaran</h3>
                    
                    <form id="payment-form">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm text-gray-600 mb-2">Nama Lengkap</label>
                                <input type="text" value="{{ $reservasi->user->name }}" disabled
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50">
                            </div>
                            
                            <div>
                                <label class="block text-sm text-gray-600 mb-2">Email</label>
                                <input type="email" value="{{ $reservasi->user->email }}" disabled
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50">
                            </div>
                            
                            <div>
                                <label class="block text-sm text-gray-600 mb-2">Nomor Telepon *</label>
                                <input type="text" name="phone" id="phone" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="Contoh: +62812345678">
                            </div>
                            
                            <div>
                                <label class="block text-sm text-gray-600 mb-2">Alamat *</label>
                                <textarea name="address" id="address" required rows="3"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="Alamat lengkap Anda"></textarea>
                            </div>
                            
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm text-gray-600 mb-2">Kota *</label>
                                    <input type="text" name="city" id="city" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        placeholder="Kota">
                                </div>
                                <div>
                                    <label class="block text-sm text-gray-600 mb-2">Kode Pos *</label>
                                    <input type="text" name="postal_code" id="postal_code" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        placeholder="12345">
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-6">
                            <button type="submit" id="pay-button" 
                                class="w-full bg-blue-600 text-white py-3 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 font-semibold">
                                <i class="fas fa-credit-card mr-2"></i>
                                Bayar Sekarang - Rp {{ number_format($reservasi->total_harga, 0, ',', '.') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Booking Summary -->
            <div class="md:col-span-1">
                <div class="bg-white rounded-lg p-6 shadow-xl">
                    <h3 class="font-bold text-lg mb-4">Ringkasan Pesanan</h3>
                    
                    <div class="space-y-4">
                        <!-- Hotel Info -->
                        <div>
                            <img src="https://images.unsplash.com/photo-1582719478249-c89cae4dc85b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                                alt="{{ $reservasi->kamar->hotel->nama_hotel }}" 
                                class="w-full h-32 object-cover rounded-md mb-2">
                            <h4 class="font-semibold">{{ $reservasi->kamar->hotel->nama_hotel }}</h4>
                            <p class="text-gray-600 text-sm">{{ $reservasi->kamar->detailKamar->tipe_kamar }}</p>
                        </div>
                        
                        <!-- Booking Details -->
                        <div class="border-t pt-4">
                            <div class="flex justify-between mb-2">
                                <span class="text-gray-600">Check-in</span>
                                <span class="font-medium">{{ $reservasi->check_in->format('d M Y') }}</span>
                            </div>
                            <div class="flex justify-between mb-2">
                                <span class="text-gray-600">Check-out</span>
                                <span class="font-medium">{{ $reservasi->check_out->format('d M Y') }}</span>
                            </div>
                            <div class="flex justify-between mb-2">
                                <span class="text-gray-600">Durasi</span>
                                <span class="font-medium">{{ $reservasi->check_in->diffInDays($reservasi->check_out) }} malam</span>
                            </div>
                            <div class="flex justify-between mb-2">
                                <span class="text-gray-600">Tamu</span>
                                <span class="font-medium">{{ $reservasi->kamar->detailKamar->kapasitas }} orang</span>
                            </div>
                        </div>
                        
                        <!-- Status -->
                        <div class="border-t pt-4">
                            <div class="flex justify-between mb-2">
                                <span class="text-gray-600">Status Reservasi</span>
                                <span class="px-2 py-1 rounded-full text-xs font-semibold
                                    @if($reservasi->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($reservasi->status === 'confirmed') bg-green-100 text-green-800
                                    @else bg-gray-100 text-gray-800
                                    @endif">
                                    {{ ucfirst($reservasi->status) }}
                                </span>
                            </div>
                        </div>
                        
                        <!-- Payment Status -->
                        @if($transaction)
                        <div class="border-t pt-4">
                            <div class="flex justify-between mb-2">
                                <span class="text-gray-600">Status Pembayaran</span>
                                <span class="px-2 py-1 rounded-full text-xs font-semibold
                                    @if($transaction->status_pembayaran === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($transaction->status_pembayaran === 'success') bg-green-100 text-green-800
                                    @elseif($transaction->status_pembayaran === 'failed') bg-red-100 text-red-800
                                    @else bg-gray-100 text-gray-800
                                    @endif">
                                    {{ ucfirst($transaction->status_pembayaran) }}
                                </span>
                            </div>
                        </div>
                        @endif
                        
                        <!-- Price Breakdown -->
                        <div class="border-t pt-4">
                            <div class="flex justify-between text-lg font-bold">
                                <span>Total Pembayaran</span>
                                <span class="text-blue-600">Rp {{ number_format($reservasi->total_harga, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Midtrans Snap JS -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    
    <script>
        document.getElementById('payment-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const payButton = document.getElementById('pay-button');
            const originalText = payButton.innerHTML;
            
            // Validate form
            const phone = document.getElementById('phone').value;
            const address = document.getElementById('address').value;
            const city = document.getElementById('city').value;
            const postalCode = document.getElementById('postal_code').value;
            
            if (!phone || !address || !city || !postalCode) {
                alert('Mohon lengkapi semua field yang diperlukan.');
                return;
            }
            
            // Disable button and show loading
            payButton.disabled = true;
            payButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memproses...';
            
            // Send payment request
            fetch('{{ route("payment.process", $reservasi) }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    phone: phone,
                    address: address,
                    city: city,
                    postal_code: postalCode
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Open Midtrans Snap popup
                    window.snap.pay(data.snap_token, {
                        onSuccess: function(result) {
                            window.location.href = '{{ route("payment.success") }}?order_id=' + data.order_id + '&transaction_status=settlement';
                        },
                        onPending: function(result) {
                            window.location.href = '{{ route("payment.pending") }}?order_id=' + data.order_id;
                        },
                        onError: function(result) {
                            window.location.href = '{{ route("payment.failed") }}?order_id=' + data.order_id;
                        },
                        onClose: function() {
                            // Re-enable button
                            payButton.disabled = false;
                            payButton.innerHTML = originalText;
                        }
                    });
                } else {
                    alert(data.message || 'Terjadi kesalahan dalam memproses pembayaran.');
                    payButton.disabled = false;
                    payButton.innerHTML = originalText;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan dalam memproses pembayaran.');
                payButton.disabled = false;
                payButton.innerHTML = originalText;
            });
        });
    </script>
</x-form-layout>
