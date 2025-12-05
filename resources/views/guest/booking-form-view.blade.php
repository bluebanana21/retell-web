<x-form-layout>
    <div class="">
        <h1 class="font-bold text-left text-lg">Pemesanan Akomodasi</h1>
        <h2 class="retell-blue font-bold text-left">
            Pastikan kamu mengisi semua informasi di halaman ini benar sebelum melanjutkan ke pembayaran.
        </h2>
    </div>

    <form action="" method="POST">
        @csrf

        <div class="grid grid-cols-3 gap-4">
            {{-- Sisi kiri --}}
            <div class="col-span-2">
                {{-- Data Pemesanan --}}
                <div class="bg-white rounded-lg p-4 text-black mt-4 shadow-xl">
                    <h1 class="font-bold">Data Pemesanan</h1>
                    <p class="text-gray-400">
                        Isi semua kolom dengan benar untuk memastikan kamu dapat menerima voucher konfirmasi pemesanan
                        di email yang dicantumkan.
                    </p>

                    <div class="py-4">
                        <label class="block text-sm text-gray-400 mb-2">Nama Lengkap (sesuai KTP/Paspor/SIM)</label>
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
                </div>

                {{-- Rincian Harga --}}
                <div class="bg-white rounded-lg p-4 text-black mt-4 shadow-xl">
                    <h1 class="font-bold">Rincian Harga</h1>
                    <div class="grid grid-cols-2 mb-4">
                        <p class="font-bold">Harga Kamar</p>
                        <p class="font-bold">Rp 3.000.000</p>
                    </div>
                    <div class="grid grid-cols-2 mb-4">
                        <p class="font-bold">Pajak dan biaya</p>
                        <p>Rp 540.000</p>
                    </div>
                    <div class="border-t border-gray-800 grid grid-cols-2 mb-4 pt-2">
                        <p class="font-bold">Harga total</p>
                        <p class="retell-blue font-bold">Rp 4.500.000</p>
                    </div>

                    {{-- Submit button should be inside the form --}}
                    <button type="submit" class="btn-retell-primary w-full">
                        Lanjut ke Pembayaran
                    </button>
                </div>
            </div>

            {{-- Sisi kanan --}}
            <div class="col-span-1">
                <div class="bg-white rounded-lg p-4 text-black mt-4 shadow-xl">
                    <h1>The Classic Twin</h1>
                    <div class="rounded-sm">
                        <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                            alt="" class="w-full h-24 object-cover rounded-md mb-4">
                    </div>

                    <select name="hotel_id"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md">
                        <option value="1">1 Kamar, 2 Tamu Dewasa</option>
                        <option value="2">2 Kamar, 4 Tamu Dewasa</option>
                        <option value="3">3 Kamar, 6 Tamu Dewasa</option>
                    </select>

                    <div class="flex mt-4 mb-4 gap-4">
                        <div class="flex flex-row items-center gap-2">
                            <i class="fa-solid fa-cube retell-blue"></i>
                            <p>32.0 m²</p>
                        </div>
                        <div class="flex flex-row items-center gap-2">
                            <i class="fa-solid fa-users retell-blue"></i>
                            <p>2 tamu</p>
                        </div>
                    </div>

                    <div>
                        Fasilitas kamar
                    </div>

                    <div class="flex flex-col gap-4 mt-5">
                        <h1 class="text-xl font-bold retell-blue mt-2 mb-2">
                            RP 1.500.000
                            <span class="text-sm text-gray-400">
                                per night
                            </span>
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-form-layout>
