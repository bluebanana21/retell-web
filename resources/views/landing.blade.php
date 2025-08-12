<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RETELL - Hotel Booking</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm fixed w-full top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-gray-900">RETELL</h1>
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <a href="#" class="text-gray-900 hover:text-blue-600 px-3 py-2 text-sm font-medium">Home</a>
                        <a href="#rooms" class="text-gray-500 hover:text-blue-600 px-3 py-2 text-sm font-medium">Rooms</a>
                        <a href="#properties" class="text-gray-500 hover:text-blue-600 px-3 py-2 text-sm font-medium">Properties</a>
                        <a href="#facilities" class="text-gray-500 hover:text-blue-600 px-3 py-2 text-sm font-medium">Facilities</a>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-white px-4 py-2 rounded-md text-sm font-medium transition duration-200" style="background-color: #006B83;" onmouseover="this.style.backgroundColor='#004d5e'" onmouseout="this.style.backgroundColor='#006B83'">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="px-3 py-2 text-sm font-medium transition duration-200" style="color: #00A4C9;" onmouseover="this.style.color='#006B83'" onmouseout="this.style.color='#00A4C9'">
                                Login
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="text-white px-4 py-2 rounded-md text-sm font-medium transition duration-200" style="background-color: #006B83;" onmouseover="this.style.backgroundColor='#004d5e'" onmouseout="this.style.backgroundColor='#006B83'">
                                    Register
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative h-screen bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80');">
        <div class="absolute inset-0 bg-black bg-opacity-40"></div>
        <div class="relative z-10 flex items-center justify-center h-full">
            <div class="text-center">
                <h1 class="text-5xl md:text-6xl font-bold text-white mb-8">RETELL</h1>
                <p class="text-xl text-white mb-12">Find Your Perfect Stay</p>
                
                <!-- Search Form -->
                <div class="bg-white rounded-lg shadow-lg p-6 max-w-4xl mx-auto">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                            <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option>Select City</option>
                                <option>Jakarta</option>
                                <option>Bali</option>
                                <option>Yogyakarta</option>
                                <option>Surabaya</option>
                                <option>Bandung</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Check In</label>
                            <input type="date" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Check Out</label>
                            <input type="date" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div class="flex items-end">
                            <button class="w-full text-white py-2 px-4 rounded-md transition duration-200" style="background-color: #006B83;" onmouseover="this.style.backgroundColor='#004d5e'" onmouseout="this.style.backgroundColor='#006B83'">
                                <i class="fas fa-search mr-2" style="color: #6EB4C0;"></i>Search
                            </button>
                        </div>
                    </div>
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
                <!-- Room Card 1 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <img src="https://images.unsplash.com/photo-1631049307264-da0ec9d70304?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Deluxe Room" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Deluxe Room</h3>
                        <p class="text-gray-600 mb-4">Spacious room with modern amenities and city view</p>
                        <div class="flex items-center justify-between">
                            <span class="text-2xl font-bold" style="color: #00A4C9;">$120/night</span>
                            <button class="text-white px-4 py-2 rounded-md transition duration-200" style="background-color: #006B83;" onmouseover="this.style.backgroundColor='#004d5e'" onmouseout="this.style.backgroundColor='#006B83'">Book Now</button>
                        </div>
                    </div>
                </div>

                <!-- Room Card 2 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <img src="https://images.unsplash.com/photo-1618773928121-c32242e63f39?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Suite Room" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Suite Room</h3>
                        <p class="text-gray-600 mb-4">Luxury suite with separate living area and premium facilities</p>
                        <div class="flex items-center justify-between">
                            <span class="text-2xl font-bold" style="color: #00A4C9;">$200/night</span>
                            <button class="text-white px-4 py-2 rounded-md transition duration-200" style="background-color: #006B83;" onmouseover="this.style.backgroundColor='#004d5e'" onmouseout="this.style.backgroundColor='#006B83'">Book Now</button>
                        </div>
                    </div>
                </div>

                <!-- Room Card 3 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Standard Room" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Standard Room</h3>
                        <p class="text-gray-600 mb-4">Comfortable room with essential amenities for budget travelers</p>
                        <div class="flex items-center justify-between">
                            <span class="text-2xl font-bold" style="color: #00A4C9;">$80/night</span>
                            <button class="text-white px-4 py-2 rounded-md transition duration-200" style="background-color: #006B83;" onmouseover="this.style.backgroundColor='#004d5e'" onmouseout="this.style.backgroundColor='#006B83'">Book Now</button>
                        </div>
                    </div>
                </div>

                <!-- Room Card 4 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <img src="https://images.unsplash.com/photo-1590490360182-c33d57733427?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Family Room" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Family Room</h3>
                        <p class="text-gray-600 mb-4">Spacious room perfect for families with multiple beds</p>
                        <div class="flex items-center justify-between">
                            <span class="text-2xl font-bold" style="color: #00A4C9;">$150/night</span>
                            <button class="text-white px-4 py-2 rounded-md transition duration-200" style="background-color: #006B83;" onmouseover="this.style.backgroundColor='#004d5e'" onmouseout="this.style.backgroundColor='#006B83'">Book Now</button>
                        </div>
                    </div>
                </div>

                <!-- Room Card 5 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <img src="https://images.unsplash.com/photo-1595576508898-0ad5c879a061?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Executive Room" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Executive Room</h3>
                        <p class="text-gray-600 mb-4">Premium room with business amenities and lounge access</p>
                        <div class="flex items-center justify-between">
                            <span class="text-2xl font-bold" style="color: #00A4C9;">$180/night</span>
                            <button class="text-white px-4 py-2 rounded-md transition duration-200" style="background-color: #006B83;" onmouseover="this.style.backgroundColor='#004d5e'" onmouseout="this.style.backgroundColor='#006B83'">Book Now</button>
                        </div>
                    </div>
                </div>

                <!-- Room Card 6 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <img src="https://images.unsplash.com/photo-1578683010236-d716f9a3f461?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Presidential Suite" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Presidential Suite</h3>
                        <p class="text-gray-600 mb-4">Ultimate luxury with panoramic views and exclusive services</p>
                        <div class="flex items-center justify-between">
                            <span class="text-2xl font-bold" style="color: #00A4C9;">$350/night</span>
                            <button class="text-white px-4 py-2 rounded-md transition duration-200" style="background-color: #006B83;" onmouseover="this.style.backgroundColor='#004d5e'" onmouseout="this.style.backgroundColor='#006B83'">Book Now</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Hotel Properties Section -->
    <section id="properties" class="py-16" style="background-color: #00A4C9;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-white mb-4">HOTEL PROPERTIES</h2>
                <p class="text-white opacity-80">Discover our premium hotel locations across Indonesia</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Property 1 -->
                <div class="relative overflow-hidden rounded-lg shadow-lg group">
                    <img src="https://images.unsplash.com/photo-1564501049412-61c2a3083791?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Jakarta Hotel" class="w-full h-64 object-cover group-hover:scale-110 transition duration-500">
                    <div class="absolute inset-0 bg-black bg-opacity-40 group-hover:bg-opacity-30 transition duration-300"></div>
                    <div class="absolute bottom-4 left-4 text-white">
                        <h3 class="text-xl font-semibold">RETELL Jakarta</h3>
                        <p class="text-sm">Central Business District</p>
                    </div>
                </div>

                <!-- Property 2 -->
                <div class="relative overflow-hidden rounded-lg shadow-lg group">
                    <img src="https://images.unsplash.com/photo-1537996194471-e657df975ab4?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Bali Hotel" class="w-full h-64 object-cover group-hover:scale-110 transition duration-500">
                    <div class="absolute inset-0 bg-black bg-opacity-40 group-hover:bg-opacity-30 transition duration-300"></div>
                    <div class="absolute bottom-4 left-4 text-white">
                        <h3 class="text-xl font-semibold">RETELL Bali</h3>
                        <p class="text-sm">Seminyak Beach</p>
                    </div>
                </div>

                <!-- Property 3 -->
                <div class="relative overflow-hidden rounded-lg shadow-lg group">
                    <img src="https://images.unsplash.com/photo-1571896349842-33c89424de2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Yogyakarta Hotel" class="w-full h-64 object-cover group-hover:scale-110 transition duration-500">
                    <div class="absolute inset-0 bg-black bg-opacity-40 group-hover:bg-opacity-30 transition duration-300"></div>
                    <div class="absolute bottom-4 left-4 text-white">
                        <h3 class="text-xl font-semibold">RETELL Yogyakarta</h3>
                        <p class="text-sm">Cultural Heritage Area</p>
                    </div>
                </div>

                <!-- Property 4 -->
                <div class="relative overflow-hidden rounded-lg shadow-lg group">
                    <img src="https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Surabaya Hotel" class="w-full h-64 object-cover group-hover:scale-110 transition duration-500">
                    <div class="absolute inset-0 bg-black bg-opacity-40 group-hover:bg-opacity-30 transition duration-300"></div>
                    <div class="absolute bottom-4 left-4 text-white">
                        <h3 class="text-xl font-semibold">RETELL Surabaya</h3>
                        <p class="text-sm">Business Center</p>
                    </div>
                </div>

                <!-- Property 5 -->
                <div class="relative overflow-hidden rounded-lg shadow-lg group">
                    <img src="https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Bandung Hotel" class="w-full h-64 object-cover group-hover:scale-110 transition duration-500">
                    <div class="absolute inset-0 bg-black bg-opacity-40 group-hover:bg-opacity-30 transition duration-300"></div>
                    <div class="absolute bottom-4 left-4 text-white">
                        <h3 class="text-xl font-semibold">RETELL Bandung</h3>
                        <p class="text-sm">Mountain Resort</p>
                    </div>
                </div>

                <!-- Property 6 -->
                <div class="relative overflow-hidden rounded-lg shadow-lg group">
                    <img src="https://images.unsplash.com/photo-1582719508461-905c673771fd?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Lombok Hotel" class="w-full h-64 object-cover group-hover:scale-110 transition duration-500">
                    <div class="absolute inset-0 bg-black bg-opacity-40 group-hover:bg-opacity-30 transition duration-300"></div>
                    <div class="absolute bottom-4 left-4 text-white">
                        <h3 class="text-xl font-semibold">RETELL Lombok</h3>
                        <p class="text-sm">Tropical Paradise</p>
                    </div>
                </div>
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
                <!-- Facility 1 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1571902943202-507ec2618e8f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Swimming Pool" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Swimming Pool</h3>
                        <p class="text-gray-600">Relax and unwind in our infinity pool with stunning city views</p>
                    </div>
                </div>

                <!-- Facility 2 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Spa & Wellness" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Spa & Wellness</h3>
                        <p class="text-gray-600">Rejuvenate your body and mind with our premium spa treatments</p>
                    </div>
                </div>

                <!-- Facility 3 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Fitness Center" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Fitness Center</h3>
                        <p class="text-gray-600">Stay fit with our state-of-the-art gym equipment and personal trainers</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-white py-12" style="background-color: #006B83;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-2xl font-bold mb-4">RETELL</h3>
                    <p class="text-gray-400">Your perfect stay awaits. Experience luxury and comfort at our premium hotel locations.</p>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-200">Home</a></li>
                        <li><a href="#rooms" class="text-gray-400 hover:text-white transition duration-200">Rooms</a></li>
                        <li><a href="#properties" class="text-gray-400 hover:text-white transition duration-200">Properties</a></li>
                        <li><a href="#facilities" class="text-gray-400 hover:text-white transition duration-200">Facilities</a></li>
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
                }
            });
        });
    </script>
</body>
</html>
