<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RETELL - Hotel Booking</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- auto complete --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js@10.2.7/dist/css/autoComplete.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js@10.2.7/dist/autoComplete.min.js"></script>
    {{-- end --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,600&family=joan:400&display=swap" rel="stylesheet" />
</head>

<body class="bg-gray-50 font-inter">
    <!-- Include Navbar -->
    @include('layouts.retell-navbar')

    <!-- Hero Section -->
    <section id="hero" class="relative h-screen bg-cover bg-center pt-16"
        style="background-image: url('https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80');">
        <div class="absolute inset-0 bg-black bg-opacity-40"></div>
        <div class="relative z-10 flex items-center justify-center h-full">
            <div class="text-center">
                <h1 class="text-5xl md:text-6xl font-bold text-white mb-8">RETELL</h1>
                <p class="text-xl text-white mb-12">Find Your Perfect Stay</p>

                <!-- Search Form -->
                <div class="bg-white rounded-lg shadow-lg p-6 w-[400px] mx-auto">
    <form action="{{ route('guest.search.hotels') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 gap-4">
            <div>
                <h1 class="block text-2xl font-medium text-black-700 mb-6">Search Hotels</h1>
                <div class="relative">
                    <input id="autoComplete" 
                           type="text" 
                           name="city" 
                           placeholder="Enter City Name" 
                           required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <div id="loading" class="absolute right-3 top-2.5 hidden">
                        <i class="fas fa-spinner fa-spin text-gray-400"></i>
                    </div>
                </div>
            </div>
            <div class="flex items-end">
                <button type="submit" class="btn-retell-primary w-full">
                    <i class="fas fa-search mr-2 text-white"></i>Search
                </button>
            </div>
        </div>
        <input type="hidden" name="guests" value="2">
    </form>
</div>
            </div>
        </div>
    </section>

    <!-- Our Rooms Section -->
    <section id="rooms" class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">OUR ROOMS</h2>
                <p class="text-gray-600">Choose from our selection of comfortable and luxurious rooms</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($roomTypes as $roomType)
                @php
                    $roomImages = [
                        'reguler' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                        'deluxe' => 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                        'suite' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
                    ];
                    $minPrice = $roomType->kamars->min('harga_per_malam');
                    $firstHotelWithThisRoomType = $roomType->kamars->first()?->hotel;
                    $roomUrl = $firstHotelWithThisRoomType ? route('guest.show.kamar', ['id' => $firstHotelWithThisRoomType->id, 'slug' => Str::slug($firstHotelWithThisRoomType->nama_hotel)]) : route('guest.search.hotels');
                @endphp
                <div class="room-card bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col h-full">
                    <img src="{{ $roomImages[$roomType->tipe_kamar] ?? $roomImages['reguler'] }}"
                        alt="{{ ucfirst($roomType->tipe_kamar) }} Room" class="w-full h-64 object-cover">
                    <div class="p-8 flex-1 flex flex-col">
                        <h3 class="text-2xl font-bold text-gray-800 mb-3">{{ ucfirst($roomType->tipe_kamar) }} Room</h3>
                        <p class="text-gray-600 text-sm mb-6 leading-relaxed line-clamp-3">{{ $roomType->deskripsi }}</p>
                        <div class="space-y-2 mb-auto">
                            <div class="flex items-center text-gray-600 text-sm">
                                <i class="fas fa-users mr-2 text-teal-600"></i>
                                {{ $roomType->kapasitas }} guests
                            </div>
                            <div class="flex items-center text-gray-600 text-sm">
                                <i class="fas fa-bed mr-2 text-teal-600"></i>
                                {{ $roomType->jumlah_kasur }} bed(s)
                            </div>
                            <div class="flex flex-wrap gap-2 mt-3">
                                @foreach(explode(',', $roomType->fasilitas) as $fasilitas)
                                    <span class="px-2 py-1 bg-teal-100 text-teal-800 text-xs rounded-full">
                                        {{ trim($fasilitas) }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                        <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-100">
                            <div class="flex flex-col">
                                <span class="text-sm text-gray-600">per night</span>
                                <span class="text-2xl font-bold text-teal-600">Rp {{ number_format($minPrice, 0, ',', '.') }}</span>
                            </div>
                            <a href="{{ route('guest.booking.form', [
                                'detail_id' => $roomType->detail_id,
                                'hotel_id' => $firstHotelWithThisRoomType ? $firstHotelWithThisRoomType->id : 1,
                                'check_in' => now()->addDay()->format('Y-m-d'),
                                'check_out' => now()->addDays(2)->format('Y-m-d'),
                                'guests' => 2,
                                'rooms' => 1
                            ]) }}" class="btn-retell-primary px-6 py-3 text-sm font-semibold whitespace-nowrap min-w-[100px] flex items-center justify-center">
                                Book Now
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Hotel Properties Section -->
    <section id="properties" class="py-16 retell-teal">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-white mb-4">HOTEL PROPERTIES</h2>
                <p class="text-white opacity-80">Discover our premium hotel locations across Indonesia</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($hotels as $hotel)
                <div class="relative overflow-hidden rounded-lg shadow-lg group">
                    @php
                        $cityImages = [
                            'Jakarta' => 'https://images.unsplash.com/photo-1564501049412-61c2a3083791?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                            'Bali' => 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                            'Yogyakarta' => 'https://images.unsplash.com/photo-1571896349842-33c89424de2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                            'Surabaya' => 'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                            'Bandung' => 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                            'default' => 'https://images.unsplash.com/photo-1582719508461-905c673771fd?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
                        ];
                    @endphp
                    <img src="{{ $cityImages[$hotel->kota->nama_kota] ?? $cityImages['default'] }}"
                        alt="{{ $hotel->nama_hotel }}"
                        class="w-full h-64 object-cover group-hover:scale-110 transition duration-500">
                    <div class="absolute inset-0 bg-black bg-opacity-40 group-hover:bg-opacity-30 transition duration-300"></div>
                    <div class="absolute bottom-4 left-4 text-white">
                        <h3 class="text-xl font-semibold">{{ $hotel->nama_hotel }}</h3>
                        <p class="text-sm">{{ $hotel->kota->nama_kota }}</p>
                        <div class="flex items-center mt-2">
                            <div class="flex text-yellow-400">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= floor($hotel->rating))
                                        <i class="fas fa-star text-xs"></i>
                                    @else
                                        <i class="far fa-star text-xs"></i>
                                    @endif
                                @endfor
                            </div>
                            <span class="text-sm ml-2">{{ number_format($hotel->rating, 1) }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Facilities Section -->
    <section id="facilities" class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">FACILITIES</h2>
                <p class="text-gray-600">Experience world-class amenities and services</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($facilities->take(6) as $facility)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    @php
                        $facilityImages = [
                            'WiFi Gratis' => 'https://images.unsplash.com/photo-1586953208448-b95a79798f07?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                            'Kolam Renang' => 'https://images.unsplash.com/photo-1571902943202-507ec2618e8f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                            'Restoran' => 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                            'Spa & Wellness' => 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                            'Fitness Center' => 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                            'default' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
                        ];
                    @endphp
                    <img src="{{ $facilityImages[$facility->nama_fasilitas] ?? $facilityImages['default'] }}"
                        alt="{{ $facility->nama_fasilitas }}" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $facility->nama_fasilitas }}</h3>
                        <p class="text-gray-600">{{ $facility->deskripsi }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-white py-12 retell-blue-bg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-2xl font-bold mb-4">RETELL</h3>
                    <p class="text-gray-400">Your perfect stay awaits. Experience luxury and comfort at our premium
                        hotel locations.</p>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-200">Home</a></li>
                        <li><a href="#rooms" class="text-gray-400 hover:text-white transition duration-200">Rooms</a>
                        </li>
                        <li><a href="#properties"
                                class="text-gray-400 hover:text-white transition duration-200">Properties</a></li>
                        <li><a href="#facilities"
                                class="text-gray-400 hover:text-white transition duration-200">Facilities</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Contact</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><i class="fas fa-phone mr-2"></i>+62 21 1234 5678</li>
                        <li><i class="fas fa-envelope mr-2"></i>info@retell.com</li>
                        <li><i class="fas fa-map-marker-alt mr-2"></i>Jakarta, Indonesia</li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Follow Us</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition duration-200">
                            <i class="fab fa-facebook-f text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition duration-200">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition duration-200">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition duration-200">
                            <i class="fab fa-linkedin-in text-xl"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center">
                <p class="text-gray-400">&copy; 2025 RETELL. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Smooth Scrolling Script -->
    <script>
        // Mobile menu toggle function
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        }

        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                    // Close mobile menu if open
                    const mobileMenu = document.getElementById('mobile-menu');
                    if (!mobileMenu.classList.contains('hidden')) {
                        mobileMenu.classList.add('hidden');
                    }
                }
            });
        });
    </script>
    <script>
document.addEventListener("DOMContentLoaded", () => {
    const formEl = document.querySelector('#autoComplete').closest('form');
    const inputEl = document.querySelector("#autoComplete");

    const autoCompleteJS = new autoComplete({
        selector: "#autoComplete",
        threshold: 2,
        debounce: 300,
        data: {
            src: async (query) => {
                const source = await fetch(`/cities/search?search=${encodeURIComponent(query)}`);
                const data = await source.json();
                return data.map(item => ({
                    id: item.id,
                    value: item.nama_kota
                }));
            },
            keys: ["value"],
        },
        resultItem: {
            highlight: true
        },
        resultsList: {
            element: (list, data) => {
                if (!data.results.length) {
                    const message = document.createElement("div");
                    message.innerHTML = `
                        <div style="padding: 12px; text-align: center; color: #6b7280;">
                            Tidak ada kota yang ditemukan untuk "${data.query}"
                        </div>
                    `;
                    list.appendChild(message);
                }
            },
            noResults: true,
            maxResults: 8
        }
    });

    // cara baru: event listener langsung ke instance
    inputEl.addEventListener("selection", (event) => {
        const feedback = event.detail;
        const selected = feedback.selection.value;

        console.log("=== Debug Selection (manual listener) ===");
        console.log("Selected object:", feedback.selection);
        console.log("Selected ID:", selected.id);
        console.log("Selected Value:", selected.value);

        inputEl.value = selected.value;
        inputEl.dispatchEvent(new Event("input", { bubbles: true }));

        let cityIdInput = formEl.querySelector('input[name="city_id"]');
        if (!cityIdInput) {
            cityIdInput = document.createElement('input');
            cityIdInput.type = 'hidden';
            cityIdInput.name = 'city_id';
            formEl.appendChild(cityIdInput);
        }
        cityIdInput.value = selected.id;
    });
});
</script>
</body>
</html>
