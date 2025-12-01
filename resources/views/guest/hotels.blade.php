<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RETELL - Daftar Hotel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,600&family=joan:400&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #f9fafb;
        }
        .font-joan {
            font-family: 'Joan', serif;
        }
        .btn-retell-primary {
            background-color: #0f766e;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 9999px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 3px 10px rgba(15, 118, 110, 0.25);
        }
        .btn-retell-primary:hover {
            background-color: #134e4a;
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(15, 118, 110, 0.35);
        }
        .hotel-card {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            box-shadow: 0px 10px 5px 5px rgba(15, 118, 110, 0.3);
            transition: all 0.3s ease;
            cursor: pointer;
            border: 1px solid #e5e7eb;
        }
        .hotel-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 28px rgba(15, 118, 110, 0.15);
        }
        .search-card {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 15px rgba(15, 118, 110, 0.1);
            border: 1px solid #e5e7eb;
        }
        .navbar {
            background: linear-gradient(135deg, #0f766e 0%, #134e4a 100%);
            padding: 1rem 2rem;
            box-shadow: 0 2px 10px rgba(15, 118, 110, 0.25);
        }
    </style>
</head>

<body class="bg-white font-inter">
    @include('layouts.retell-navbar')
    <div class="min-h-screen pt-20 px-8">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-10">
                <h1 class="text-4xl font-bold text-gray-800 mb-3">Daftar Hotel</h1>
                <p class="text-gray-600 text-lg">Temukan hotel terbaik untuk pengalaman menginap yang tak terlupakan</p>
            </div>
            
            <!-- Search and Filter Section -->
            <div class="search-card">
                <form method="GET" action="{{ route('guest.hotels') }}">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Cari Hotel</label>
                            <input type="text"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                                   id="search"
                                   name="search"
                                   value="{{ request('search') }}"
                                   placeholder="Nama hotel...">
                        </div>
                        <div>
                            <label for="kota_id" class="block text-sm font-medium text-gray-700 mb-2">Pilih Kota</label>
                            <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                                    id="kota_id"
                                    name="kota_id">
                                <option value="">Semua Kota</option>
                                @foreach($kotas as $kota)
                                    <option value="{{ $kota->id }}"
                                            {{ request('kota_id') == $kota->id ? 'selected' : '' }}>
                                        {{ $kota->nama_kota }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex items-end space-x-3">
                            <button type="submit" class="btn-retell-primary flex-1">
                                <i class="fas fa-search mr-2"></i> Cari
                            </button>
                            <a href="{{ route('guest.hotels') }}"
                               class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                                <i class="fas fa-refresh"></i>
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Hotels Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($hotels as $hotel)
                    <div class="hotel-card">
                        @php
                            // Get the first image from hotelImages or use a default image
                            $hotelImage = $hotel->hotelImages->first();
                            $imageUrl = $hotelImage ? $hotelImage->image_url : 'https://images.unsplash.com/photo-1582719508461-905c673771fd?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80';
                        @endphp
                        <img src="{{ $imageUrl }}"
                             alt="{{ $hotel->nama_hotel }}"
                             class="w-[300px] h-[200px] object-cover rounded-lg mb-4"
                             onerror="this.onerror=null;this.src='https://via.placeholder.com/800x600/0f766e/ffffff?text=Hotel+Image';">
                        
                        <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $hotel->nama_hotel }}</h3>
                        <p class="text-gray-600 mb-3 flex items-center">
                            <i class="fas fa-map-marker-alt mr-2 text-teal-600"></i>
                            {{ $hotel->kota->nama_kota }}
                        </p>
                        
                        @if($hotel->reviews_avg_rating)
                            <div class="flex items-center mb-3">
                                <div class="flex text-yellow-400 mr-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= floor($hotel->reviews_avg_rating))
                                            <i class="fas fa-star"></i>
                                        @elseif($i - 0.5 <= $hotel->reviews_avg_rating)
                                            <i class="fas fa-star-half-alt"></i>
                                        @else
                                            <i class="far fa-star"></i>
                                        @endif
                                    @endfor
                                </div>
                                <span class="text-gray-700 font-semibold">
                                    {{ number_format($hotel->reviews_avg_rating, 1) }}/5
                                </span>
                            </div>
                        @endif

                        <div class="mb-4">
                            <p class="text-gray-600 mb-2 font-medium">Fasilitas:</p>
                            <div class="flex flex-wrap gap-2">
                                @foreach($hotel->fasilitas->take(3) as $fasilitas)
                                    <span class="bg-teal-50 text-teal-700 px-3 py-1 rounded-full text-sm border border-teal-100">
                                        {{ $fasilitas->nama_fasilitas }}
                                    </span>
                                @endforeach
                                @if($hotel->fasilitas->count() > 3)
                                    <span class="bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-sm">
                                        +{{ $hotel->fasilitas->count() - 3 }} lainnya
                                    </span>
                                @endif
                            </div>
                        </div>

                        <a href="{{ route('guest.show.kamar', ['id' => $hotel->id, 'slug' => Str::slug($hotel->nama_hotel)]) }}"
                           class="btn-retell-primary w-full justify-center">
                            <i class="fas fa-bed mr-2"></i> Lihat Kamar
                        </a>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <i class="fas fa-hotel fa-4x text-gray-300 mb-4"></i>
                        <h3 class="text-xl font-semibold text-gray-600 mb-2">Tidak ada hotel ditemukan</h3>
                        <p class="text-gray-500">Coba ubah kriteria pencarian Anda</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($hotels->hasPages())
                <div class="flex justify-center mt-8">
                    {{ $hotels->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>
</body>

</html>