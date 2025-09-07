<x-form-layout>

    <div class="">

        <h1 class="font-bold text-left text-lg">Pemesanan Akomodasi</h1>

        <h2 class="retell-blue font-bold text-left"> Pastikan kamu mengisi semua informasi di halaman ini benar sebelum

            melanjutkan ke pembayaran. </h2>

    </div>

    <form action="" method="POST"> @csrf

        <div class="grid grid-cols-3 gap-4">

            {{-- Sisi Kiri --}}

            <div class="col-span-2">

                <div class="bg-white rounded-lg p-4 text-black mt-4 shadow-xl">

                    <h1 class="font-bold">Data Pemesanan</h1>

                    <p class="text-gray-400"> Isi semua kolom dengan benar untuk memastikan kamu dapat menerima voucher

                        konfirmasi pemesanan di email yang dicantumkan.

                    </p>

                    <div class="py-4">

                        <label class="block text-sm text-gray-400 mb-2">Nama Lengkap (sesuai

                            KTP/Paspor/SIM)

                        </label>

                        <input
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            type="text" name="full_name">

                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">

                        <div>

                            <label class="block text-sm text-gray-400 mb-2">Email</label>

                            <input
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                type="email" name="email">

                        </div>

                        <div>

                            <label class="block text-sm text-gray-400 mb-2">Nomor Handphone</label>

                            <input
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                type="text" name="phone">

                        </div>

                    </div>

                </div> {{-- Rincian Harga --}}

                <div class="bg-white rounded-lg p-4 text-black mt-4 shadow-xl">

                    <h1 class="font-bold">Rincian Harga</h1>

                    <div class="grid grid-cols-2 mb-4">

                        <p class="font-bold">

                            Harga Kamar (<span id="nights-count">{{ $nights }}</span> malam)


                        </p>

                        <p class="font-bold" id="room-price">

                            Rp {{ number_format($totalPrice, 0, ',', '.') }}

                        </p>

                    </div>

                    <div class="grid grid-cols-2 mb-4">

                        <p class="font-bold">Pajak dan biaya</p>

                        <p id="tax-price">Rp {{ number_format($totalPrice * 0.1, 0, ',', '.') }}</p>

                    </div>

                    <div class="border-t border-gray-800 grid grid-cols-2 mb-4 pt-2">

                        <p class="font-bold">Harga total</p>

                        <p class="retell-blue font-bold" id="total-price">Rp
                            {{ number_format($totalPrice * 1.1, 0, ',', '.') }}</p>

                    </div>



                    <button type="submit" class="btn-retell-primary w-full"> Lanjut ke

                        Pembayaran

                    </button>

                </div>

            </div>



            {{-- Sisi Kanan --}}

            <div class="col-span-1">

                <div class="bg-white rounded-lg p-4 text-black mt-4 shadow-xl">

                    <h1>{{ $detailKamar->tipe_kamar }}</h1>

                    <div class="rounded-sm">

                        <img src="https://images.unsplash.com/photo-1582719478249-c89cae4dc85b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                            alt="" class="w-full h-24 object-cover rounded-md mb-4">

                    </div>

                    <div class="grid grid-cols-2 gap-3 mb-4">

                        <div>

                            <label class="block text-sm font-medium text-gray-700 mb-2">Check In</label>

                            <input type="date" name="check_in" value="{{ $checkIn->format('Y-m-d') }}"
                                onchange="calculatePrice()"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                        </div>

                        <div>

                            <label class="block text-sm font-medium text-gray-700 mb-2">Check Out</label>

                            <input type="date" name="check_out" value="{{ $checkOut->format('Y-m-d') }}"
                                onchange="calculatePrice()"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                        </div>

                    </div>

                    <div
                        class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50 text-gray-700 font-medium mb-4">
                        {{ $hotel->nama_hotel }}
                    </div>

                    <div class="flex mt-4 mb-4 gap-4">

                        <div class="flex flex-row items-center gap-2"> <i class="fa-solid fa-cube retell-blue"></i>

                            <p>{{ $detailKamar->ukuran_kamar }} m²</p>

                        </div>

                        <div class="flex flex-row items-center gap-2"> <i class="fa-solid fa-users retell-blue"></i>

                            <p>{{ $detailKamar->kapasitas }} tamu</p>

                        </div>

                    </div>

                    <div> Fasilitas kamar </div>

                    <div class="flex flex-col gap-4 mt-5">

                        <h1 class="text-xl font-bold retell-blue mt-2 mb-2"> Rp
                            {{ number_format($availableRooms->first()->harga_per_malam, 0, ',', '.') }}

                            <span class="text-sm text-gray-400"> per night

                            </span>

                        </h1>

                    </div>

                </div>

            </div>

        </div>

    </form>

    <script>
        function calculatePrice() {
            const checkInInput = document.querySelector('input[name="check_in"]');
            const checkOutInput = document.querySelector('input[name="check_out"]');
            const pricePerNight = {{ $availableRooms->first()->harga_per_malam }};
            const rooms = {{ request('rooms', 1) }};

            if (checkInInput.value && checkOutInput.value) {
                const checkIn = new Date(checkInInput.value);
                const checkOut = new Date(checkOutInput.value);

                if (checkOut > checkIn) {
                    const timeDiff = checkOut.getTime() - checkIn.getTime();
                    const nights = Math.ceil(timeDiff / (1000 * 3600 * 24));

                    const roomPrice = pricePerNight * nights * rooms;
                    const tax = roomPrice * 0.1;
                    const totalPrice = roomPrice + tax;

                    // Update the display
                    document.getElementById('nights-count').textContent = nights;
                    document.getElementById('room-price').textContent = 'Rp ' + roomPrice.toLocaleString('id-ID');
                    document.getElementById('tax-price').textContent = 'Rp ' + tax.toLocaleString('id-ID');
                    document.getElementById('total-price').textContent = 'Rp ' + totalPrice.toLocaleString('id-ID');
                }
            }
        }
    </script>

</x-form-layout>
