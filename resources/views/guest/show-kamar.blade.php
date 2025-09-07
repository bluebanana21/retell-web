<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kamar Hotel - RETELL</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,600&family=joan:400&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #f8fafc;
        }
        .font-joan {
            font-family: 'Joan', serif;
        }
        .btn-retell-primary {
            background: linear-gradient(135deg, #0f766e 0%, #134e4a 100%);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(15, 118, 110, 0.25);
            text-decoration: none;
            font-size: 0.875rem;
        }
        .btn-retell-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(15, 118, 110, 0.35);
        }
        .btn-secondary {
            background: white;
            color: #0f766e;
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: 2px solid #0f766e;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }
        .btn-secondary:hover {
            background: #0f766e;
            color: white;
            transform: translateY(-2px);
        }
        .room-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            border: 1px solid #e5e7eb;
        }
        .room-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }
        .room-image {
            width: 100%;
            height: 240px;
            object-fit: cover;
        }
        .hero-section {
            background: linear-gradient(135deg, #0f766e 0%, #134e4a 100%);
            color: white;
            padding: 3rem 2rem;
            text-align: center;
        }
        .price-tag {
            color: #0f766e;
            font-weight: 700;
            font-size: 1.25rem;
        }
        .icon-feature {
            display: inline-flex;
            align-items: center;
            color: #6b7280;
            font-size: 0.875rem;
            margin-right: 1.5rem;
        }
        .icon-feature i {
            margin-right: 0.5rem;
            color: #0f766e;
        }
        .stagger-animation {
            opacity: 0;
            transform: translateY(30px);
            animation: slideUp 0.8s ease forwards;
        }
        @keyframes slideUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="max-w-6xl mx-auto">
            <h1 class="text-4xl font-bold mb-3 font-joan">Pilih Kamar Ternyaman</h1>
            <p class="text-xl opacity-90">Hotel Aston Simatupang - Jakarta Selatan</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-6xl mx-auto px-6 py-12">
        <!-- Back Button -->
        <div class="mb-8">
            <a href="#" class="btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali ke Hotel
            </a>
        </div>

        <!-- Room Cards Grid -->
        <div class="grid md:grid-cols-2 gap-8">
            <!-- The Classic Twin -->
            <div class="room-card stagger-animation" style="animation-delay: 0.1s">
                <img src="https://images.unsplash.com/photo-1631049307264-da0ec9d70304?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="The Classic Twin" class="room-image">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-3">
                        <h3 class="text-xl font-bold text-gray-800">The Classic Twin</h3>
                        <div class="text-right">
                            <div class="price-tag">RP 500.000</div>
                            <p class="text-sm text-gray-500">per malam</p>
                        </div>
                    </div>
                    
                    <p class="text-gray-600 text-sm mb-4 leading-relaxed">
                        Lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum
                    </p>

                    <div class="mb-4">
                        <div class="icon-feature">
                            <i class="fas fa-user"></i>
                            2 Guests
                        </div>
                        <div class="icon-feature">
                            <i class="fas fa-bed"></i>
                            2 Bed
                        </div>
                        <div class="icon-feature">
                            <i class="fas fa-wifi"></i>
                            Free Wifi
                        </div>
                    </div>

                    <button class="btn-retell-primary w-full">
                        Book Now
                    </button>
                </div>
            </div>

            <!-- The Classic King -->
            <div class="room-card stagger-animation" style="animation-delay: 0.2s">
                <img src="https://images.unsplash.com/photo-1560347876-aeef00ee58a1?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="The Classic King" class="room-image">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-3">
                        <h3 class="text-xl font-bold text-gray-800">The Classic King</h3>
                        <div class="text-right">
                            <div class="price-tag">RP 500.000</div>
                            <p class="text-sm text-gray-500">per malam</p>
                        </div>
                    </div>
                    
                    <p class="text-gray-600 text-sm mb-4 leading-relaxed">
                        Lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum
                    </p>

                    <div class="mb-4">
                        <div class="icon-feature">
                            <i class="fas fa-user"></i>
                            2 Guests
                        </div>
                        <div class="icon-feature">
                            <i class="fas fa-bed"></i>
                            1 King Bed
                        </div>
                        <div class="icon-feature">
                            <i class="fas fa-wifi"></i>
                            Free Wifi
                        </div>
                    </div>

                    <button class="btn-retell-primary w-full">
                        Book Now
                    </button>
                </div>
            </div>

            <!-- The Ambassador King -->
            <div class="room-card stagger-animation" style="animation-delay: 0.3s">
                <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="The Ambassador King" class="room-image">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-3">
                        <h3 class="text-xl font-bold text-gray-800">The Ambassador King</h3>
                        <div class="text-right">
                            <div class="price-tag">RP 500.000</div>
                            <p class="text-sm text-gray-500">per malam</p>
                        </div>
                    </div>
                    
                    <p class="text-gray-600 text-sm mb-4 leading-relaxed">
                        Lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum
                    </p>

                    <div class="mb-4">
                        <div class="icon-feature">
                            <i class="fas fa-user"></i>
                            2 Guests
                        </div>
                        <div class="icon-feature">
                            <i class="fas fa-bed"></i>
                            1 King Bed
                        </div>
                        <div class="icon-feature">
                            <i class="fas fa-wifi"></i>
                            Free Wifi
                        </div>
                    </div>

                    <button class="btn-retell-primary w-full">
                        Book Now
                    </button>
                </div>
            </div>

            <!-- The Ambassador Twin -->
            <div class="room-card stagger-animation" style="animation-delay: 0.4s">
                <img src="https://images.unsplash.com/photo-1564501049412-61c2a3083791?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="The Ambassador Twin" class="room-image">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-3">
                        <h3 class="text-xl font-bold text-gray-800">The Ambassador Twin</h3>
                        <div class="text-right">
                            <div class="price-tag">RP 500.000</div>
                            <p class="text-sm text-gray-500">per malam</p>
                        </div>
                    </div>
                    
                    <p class="text-gray-600 text-sm mb-4 leading-relaxed">
                        Lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum
                    </p>

                    <div class="mb-4">
                        <div class="icon-feature">
                            <i class="fas fa-user"></i>
                            2 Guests
                        </div>
                        <div class="icon-feature">
                            <i class="fas fa-bed"></i>
                            2 Twin Bed
                        </div>
                        <div class="icon-feature">
                            <i class="fas fa-wifi"></i>
                            Free Wifi
                        </div>
                    </div>

                    <button class="btn-retell-primary w-full">
                        Book Now
                    </button>
                </div>
            </div>

            <!-- Superior Deluxe -->
            <div class="room-card stagger-animation" style="animation-delay: 0.5s">
                <img src="https://images.unsplash.com/photo-1611892440504-42a792e24d32?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Superior Deluxe" class="room-image">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-3">
                        <h3 class="text-xl font-bold text-gray-800">Superior Deluxe</h3>
                        <div class="text-right">
                            <div class="price-tag">RP 750.000</div>
                            <p class="text-sm text-gray-500">per malam</p>
                        </div>
                    </div>
                    
                    <p class="text-gray-600 text-sm mb-4 leading-relaxed">
                        Lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum
                    </p>

                    <div class="mb-4">
                        <div class="icon-feature">
                            <i class="fas fa-user"></i>
                            2 Guests
                        </div>
                        <div class="icon-feature">
                            <i class="fas fa-bed"></i>
                            1 King Bed
                        </div>
                        <div class="icon-feature">
                            <i class="fas fa-wifi"></i>
                            Free Wifi
                        </div>
                    </div>

                    <button class="btn-retell-primary w-full">
                        Book Now
                    </button>
                </div>
            </div>

            <!-- Executive Suite -->
            <div class="room-card stagger-animation" style="animation-delay: 0.6s">
                <img src="https://images.unsplash.com/photo-1590490360182-c33d57733427?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Executive Suite" class="room-image">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-3">
                        <h3 class="text-xl font-bold text-gray-800">Executive Suite</h3>
                        <div class="text-right">
                            <div class="price-tag">RP 1.200.000</div>
                            <p class="text-sm text-gray-500">per malam</p>
                        </div>
                    </div>
                    
                    <p class="text-gray-600 text-sm mb-4 leading-relaxed">
                        Lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum
                    </p>

                    <div class="mb-4">
                        <div class="icon-feature">
                            <i class="fas fa-user"></i>
                            4 Guests
                        </div>
                        <div class="icon-feature">
                            <i class="fas fa-bed"></i>
                            1 King Bed
                        </div>
                        <div class="icon-feature">
                            <i class="fas fa-wifi"></i>
                            Free Wifi
                        </div>
                    </div>

                    <button class="btn-retell-primary w-full">
                        Book Now
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Add click functionality to Book Now buttons
        document.querySelectorAll('.btn-retell-primary').forEach(btn => {
            btn.addEventListener('click', function() {
                const roomName = this.closest('.room-card').querySelector('h3').textContent;
                const roomPrice = this.closest('.room-card').querySelector('.price-tag').textContent;
                alert(`Memulai pemesanan untuk ${roomName}\nHarga: ${roomPrice} per malam`);
            });
        });

        // Staggered animation on load
        window.addEventListener('load', function() {
            const cards = document.querySelectorAll('.stagger-animation');
            cards.forEach((card, index) => {
                setTimeout(() => {
                    card.style.animationDelay = `${index * 0.1}s`;
                }, 100);
            });
        });
    </script>
</body>

</html>