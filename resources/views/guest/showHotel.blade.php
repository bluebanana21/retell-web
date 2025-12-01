<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RETELL - Hotel Booking</title>
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
            box-shadow: 0 4px 20px rgba(15, 118, 110, 0.08);
            transition: all 0.3s ease;
            cursor: pointer;
            border: 1px solid #e5e7eb;
        }
        .hotel-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 28px rgba(15, 118, 110, 0.15);
        }
        .hotel-card.selected {
            border-color: #0f766e;
            box-shadow: 0 0 0 4px rgba(15, 118, 110, 0.15);
        }
        .hotel-image {
            width: 140px;
            height: 100px;
            border-radius: 12px;
            object-fit: cover;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
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
                <h1 class="text-4xl font-bold text-gray-800 mb-3">Hotel Terbaik di {{ $kota->nama_kota }}</h1>
                <p class="text-gray-600 text-lg">Temukan pengalaman menginap yang tak terlupakan</p>
            </div>
            
            @foreach ($hotel as $hotels )
            <div class="space-y-8">
                <div class="hotel-card" data-hotel="aston-simatupang">
                    <div class="flex items-center space-x-6">
                        <img src="" alt="Gambar Hotel" class="hotel-image">
                        <div class="flex-1">
                            <h3 class="text-2xl font-bold text-gray-800 mb-2">{{ $hotels->nama_hotel }}</h3>
                            <p class="text-gray-600 mb-3 leading-relaxed">
                               {{ $hotels->deskripsi }}
                            </p>
                            <div class="flex items-center mb-3">
                                <div class="flex text-yellow-400 mr-3 text-lg">
                                    <i class="fas fa-star"></i>
                                </div>
                                <span class="text-gray-700 font-semibold">{{ $hotels->rating }}/5</span>
                            </div>
                            <p class="text-gray-600 mb-2 font-medium">Fasilitas:</p>
                            <div class="flex flex-wrap gap-3 text-sm text-teal-700">
                                @foreach($hotels->fasilitas as $facility)
                                    <span class="flex items-center bg-teal-50 px-3 py-1 rounded-full border border-teal-100">
                                        @if($facility->id == 1)
                                            <i class="fas fa-wifi mr-2"></i>
                                        @elseif($facility->id == 2)
                                            <i class="fas fa-swimming-pool mr-2"></i>
                                        @elseif($facility->id == 3)
                                            <i class="fas fa-utensils mr-2"></i>
                                        @elseif($facility->id == 4)
                                            <i class="fas fa-spa mr-2"></i>
                                        @elseif($facility->id == 5)
                                            <i class="fas fa-dumbbell mr-2"></i>
                                        @elseif($facility->id == 6)
                                            <i class="fas fa-parking mr-2"></i>
                                        @elseif($facility->id == 7)
                                        <i class="fas fa-snowflake mr-2"></i>
                                        @elseif($facility->id == 8)
                                            <i class="fas fa-concierge-bell mr-2"></i>
                                        @elseif($facility->id == 9)
                                        <i class="fas fa-tshirt mr-2"></i>
                                        @elseif($facility->id == 10)
                                            <i class="fas fa-briefcase mr-2"></i>
                                        @else
                                            <i class="fas fa-check mr-2"></i>
                                        @endif
                                        {{ $facility->nama_fasilitas }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                        <a href="{{ route('guest.show.kamar', $hotels->nama_hotel, $hotel->id) }}">
                        <div class="text-right">
                            <button class="btn-retell-primary">
                                <i class="fa-solid fa-bed mr-2"></i>
                                    Lihat Kamar
                                </button>
                            </div>
                        </a>
                        </div>
                </div>
            </div>
            @endforeach
            {{-- end card hotel --}}
        </div>
    </div>

    <script>
        document.querySelectorAll('.hotel-card').forEach(card => {
            card.addEventListener('click', function(e) {
                if (e.target.closest('.btn-retell-primary')) return;
                document.querySelectorAll('.hotel-card').forEach(c => c.classList.remove('selected'));
                this.classList.add('selected');
            });
        });

        // document.querySelectorAll('.btn-retell-primary').forEach(btn => {
        //     btn.addEventListener('click', function(e) {
        //         e.stopPropagation();
        //         const hotelName = this.closest('.hotel-card').querySelector('h3').textContent;
        //         alert(`Memulai reservasi untuk ${hotelName}`);
        //     });
        // });

        // window.addEventListener('load', function() {
        //     const cards = document.querySelectorAll('.hotel-card');
        //     cards.forEach((card, index) => {
        //         card.style.opacity = '0';
        //         card.style.transform = 'translateY(20px)';
        //         setTimeout(() => {
        //             card.style.transition = 'all 0.6s ease';
        //             card.style.opacity = '1';
        //             card.style.transform = 'translateY(0)';
        //         }, index * 150);
        //     });
        // });
    </script>
</body>

</html>
