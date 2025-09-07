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
        }
        .font-joan {
            font-family: 'Joan', serif;
        }
        .retell-blue {
            color: #1e40af;
        }
        .retell-blue-bg {
            background-color: #1e40af;
        }
        .retell-teal {
            background-color: #0f766e;
        }
        .btn-retell-primary {
            background-color: #0f766e;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.375rem;
            font-weight: 600;
            transition: all 0.2s;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .btn-retell-primary:hover {
            background-color: #134e4a;
        }
        .hotel-card {
            background: linear-gradient(135deg, #f0fdfa 0%, #ccfbf1 50%, #a7f3d0 100%);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            box-shadow: 0 4px 15px rgba(15, 118, 110, 0.1);
            transition: all 0.3s ease;
            cursor: pointer;
            border: 1px solid rgba(15, 118, 110, 0.1);
        }
        .hotel-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(15, 118, 110, 0.2);
            background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 50%, #a7f3d0 100%);
        }
        .hotel-card.selected {
            background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 50%, #86efac 100%);
            border-color: #0f766e;
            box-shadow: 0 0 0 3px rgba(15, 118, 110, 0.2);
        }
        .hotel-image {
            width: 120px;
            height: 80px;
            border-radius: 8px;
            object-fit: cover;
        }
        .navbar {
            background: linear-gradient(135deg, #0f766e 0%, #134e4a 100%);
            padding: 1rem 2rem;
            box-shadow: 0 2px 10px rgba(15, 118, 110, 0.2);
        }
        .price-highlight {
            background: linear-gradient(135deg, #0f766e, #134e4a);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>

<body class="bg-white font-inter">
    @include('layouts.retell-navbar')
    <div class="min-h-screen pt-20 px-8">
        <!-- Hotel Results -->
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-gray-800 mb-2">Hotel Terbaik di Jakarta Selatan</h1>
                <p class="text-gray-600 text-lg">Temukan pengalaman menginap yang tak terlupakan</p>
            </div>
            
            <!-- Hotel Cards -->
            <div class="space-y-6">
                <!-- Aston Simatupang -->
                <div class="hotel-card" data-hotel="aston-simatupang">
                    <div class="flex items-center space-x-6">
                        <img src="https://images.unsplash.com/photo-1564501049412-61c2a3083791?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                             alt="Aston Simatupang" 
                             class="hotel-image">
                        <div class="flex-1">
                            <h3 class="text-2xl font-bold text-gray-800 mb-2">Aston Simatupang</h3>
                            <p class="text-gray-600 mb-3 flex items-center">
                                <i class="fas fa-map-marker-alt mr-2 text-teal-600"></i>
                                Simatupang, Jakarta Selatan
                            </p>
                            <div class="flex items-center mb-2">
                                <div class="flex text-yellow-400 mr-3">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                                <span class="text-gray-700 font-semibold">4.2/5</span>
                                <span class="text-gray-500 ml-2">(248 ulasan)</span>
                            </div>
                            <div class="flex items-center space-x-4 text-sm text-teal-700">
                                <span><i class="fas fa-wifi mr-1"></i>WiFi Gratis</span>
                                <span><i class="fas fa-swimming-pool mr-1"></i>Kolam Renang</span>
                                <span><i class="fas fa-utensils mr-1"></i>Restoran</span>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="text-3xl font-bold price-highlight">Rp 850.000</div>
                            <div class="text-gray-600">/malam</div>
                            <button class="btn-retell-primary mt-3">
                                <i class="fas fa-calendar-check mr-2"></i>
                                Reservasi
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Aston Bellevue Radio Dalam -->
                <div class="hotel-card" data-hotel="aston-bellevue">
                    <div class="flex items-center space-x-6">
                        <img src="https://images.unsplash.com/photo-1631049307264-da0ec9d70304?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                             alt="Aston Bellevue Radio Dalam" 
                             class="hotel-image">
                        <div class="flex-1">
                            <h3 class="text-2xl font-bold text-gray-800 mb-2">Aston Bellevue Radio Dalam</h3>
                            <p class="text-gray-600 mb-3 flex items-center">
                                <i class="fas fa-map-marker-alt mr-2 text-teal-600"></i>
                                Gandok, Jakarta Selatan
                            </p>
                            <div class="flex items-center mb-2">
                                <div class="flex text-yellow-400 mr-3">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <span class="text-gray-700 font-semibold">4.5/5</span>
                                <span class="text-gray-500 ml-2">(312 ulasan)</span>
                            </div>
                            <div class="flex items-center space-x-4 text-sm text-teal-700">
                                <span><i class="fas fa-wifi mr-1"></i>WiFi Gratis</span>
                                <span><i class="fas fa-dumbbell mr-1"></i>Gym</span>
                                <span><i class="fas fa-spa mr-1"></i>Spa</span>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="text-3xl font-bold price-highlight">Rp 950.000</div>
                            <div class="text-gray-600">/malam</div>
                            <button class="btn-retell-primary mt-3">
                                <i class="fas fa-calendar-check mr-2"></i>
                                Reservasi
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Aston Priority Tower -->
                <div class="hotel-card" data-hotel="aston-priority">
                    <div class="flex items-center space-x-6">
                        <img src="https://images.unsplash.com/photo-1618773928121-c32242e63f39?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                             alt="Aston Priority Tower" 
                             class="hotel-image">
                        <div class="flex-1">
                            <h3 class="text-2xl font-bold text-gray-800 mb-2">Aston Priority Tower</h3>
                            <p class="text-gray-600 mb-3 flex items-center">
                                <i class="fas fa-map-marker-alt mr-2 text-teal-600"></i>
                                Pasar Minggu, Jakarta Selatan
                            </p>
                            <div class="flex items-center mb-2">
                                <div class="flex text-yellow-400 mr-3">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <span class="text-gray-700 font-semibold">4.8/5</span>
                                <span class="text-gray-500 ml-2">(456 ulasan)</span>
                            </div>
                            <div class="flex items-center space-x-4 text-sm text-teal-700">
                                <span><i class="fas fa-wifi mr-1"></i>WiFi Gratis</span>
                                <span><i class="fas fa-swimming-pool mr-1"></i>Rooftop Pool</span>
                                <span><i class="fas fa-concierge-bell mr-1"></i>Concierge</span>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="text-3xl font-bold price-highlight">Rp 1.200.000</div>
                            <div class="text-gray-600">/malam</div>
                            <button class="btn-retell-primary mt-3">
                                <i class="fas fa-calendar-check mr-2"></i>
                                Reservasi
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Additional Hotels -->
                <div class="hotel-card" data-hotel="grand-sahid">
                    <div class="flex items-center space-x-6">
                        <img src="https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                             alt="Grand Sahid Jaya" 
                             class="hotel-image">
                        <div class="flex-1">
                            <h3 class="text-2xl font-bold text-gray-800 mb-2">Grand Sahid Jaya</h3>
                            <p class="text-gray-600 mb-3 flex items-center">
                                <i class="fas fa-map-marker-alt mr-2 text-teal-600"></i>
                                Sudirman, Jakarta Selatan
                            </p>
                            <div class="flex items-center mb-2">
                                <div class="flex text-yellow-400 mr-3">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <span class="text-gray-700 font-semibold">4.7/5</span>
                                <span class="text-gray-500 ml-2">(389 ulasan)</span>
                            </div>
                            <div class="flex items-center space-x-4 text-sm text-teal-700">
                                <span><i class="fas fa-wifi mr-1"></i>WiFi Gratis</span>
                                <span><i class="fas fa-car mr-1"></i>Valet Parking</span>
                                <span><i class="fas fa-glass-cheers mr-1"></i>Bar</span>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="text-3xl font-bold price-highlight">Rp 1.150.000</div>
                            <div class="text-gray-600">/malam</div>
                            <button class="btn-retell-primary mt-3">
                                <i class="fas fa-calendar-check mr-2"></i>
                                Reservasi
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Load More Button -->
            <div class="text-center mt-12 mb-8">
                <button class="btn-retell-primary px-10 py-4 text-lg">
                    <i class="fas fa-plus mr-3"></i>
                    Tampilkan Lebih Banyak Hotel
                </button>
            </div>
        </div>
    </div>

    <script>
        // Enhanced hotel card interactions
        document.querySelectorAll('.hotel-card').forEach(card => {
            card.addEventListener('click', function(e) {
                // Don't select if clicking on reservation button
                if (e.target.closest('.btn-retell-primary')) return;
                
                // Remove selection from all cards
                document.querySelectorAll('.hotel-card').forEach(c => c.classList.remove('selected'));
                
                // Add selection to clicked card
                this.classList.add('selected');
            });
        });

        // Reservation button interactions
        document.querySelectorAll('.btn-retell-primary').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                const hotelName = this.closest('.hotel-card').querySelector('h3').textContent;
                alert(`Memulai reservasi untuk ${hotelName}`);
            });
        });

        // Add smooth scrolling and fade-in animation
        window.addEventListener('load', function() {
            const cards = document.querySelectorAll('.hotel-card');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    card.style.transition = 'all 0.6s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 150);
            });
        });
    </script>
</body>

</html>