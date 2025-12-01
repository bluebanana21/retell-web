<x-form-layout>
    <div class="text-center align-middle bg-white rounded-lg p-4 text-black mt-4 shadow-xl ">
        <h1 class="font-bold">Pemesanan Berhasil!</h1>
        <p class="text-gray-400">
            Terima kasih telah melakukan reservasi kamar {{$reservasi->user->name}}!. 
        </p>
        <div class="mt-4">
            <a href="/" class="btn-retell-primary w-full text-center">Kembali ke Beranda</a>
        </div>

    </div>
</x-form-layout>