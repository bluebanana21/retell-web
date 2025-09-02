<!-- Retell Navbar Component -->
<header class="bg-white shadow-md border-b border-gray-100 fixed w-full top-0 z-50">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex items-center justify-between h-16">
            <!-- Logo Section -->
            <div class="flex items-center space-x-3">
                <div
                    class="w-10 h-10 bg-gradient-to-br from-teal-400 to-teal-600 rounded-lg flex items-center justify-center shadow-md">
                    <span class="text-white text-lg font-bold">R</span>
                </div>
                <h1 class="font-joan text-2xl font-semibold" style="color: #006B83;">RETELL</h1>
            </div>

            <!-- Navigation Menu -->
            <nav class="hidden md:flex items-center space-x-8">
                <a href="{{ url('/') }}"
                    class="text-gray-600 hover:text-teal-600 font-medium transition-colors duration-200 py-2 px-1 relative group">
                    Home
                    <span
                        class="absolute bottom-0 left-0 w-0 h-0.5 bg-teal-600 transition-all duration-300 group-hover:w-full"></span>
                </a>
                <a href="{{ url('/#rooms') }}"
                    class="text-gray-600 hover:text-teal-600 font-medium transition-colors duration-200 py-2 px-1 relative group">
                    Rooms
                    <span
                        class="absolute bottom-0 left-0 w-0 h-0.5 bg-teal-600 transition-all duration-300 group-hover:w-full"></span>
                </a>
                <a href="{{ url('/#properties') }}"
                    class="text-gray-600 hover:text-teal-600 font-medium transition-colors duration-200 py-2 px-1 relative group">
                    Properties
                    <span
                        class="absolute bottom-0 left-0 w-0 h-0.5 bg-teal-600 transition-all duration-300 group-hover:w-full"></span>
                </a>
                <a href="{{ url('/#facilities') }}"
                    class="text-gray-600 hover:text-teal-600 font-medium transition-colors duration-200 py-2 px-1 relative group">
                    Facilities
                    <span
                        class="absolute bottom-0 left-0 w-0 h-0.5 bg-teal-600 transition-all duration-300 group-hover:w-full"></span>
                </a>
            </nav>

            <!-- Auth Buttons -->
            <div class="flex items-center space-x-3">
                <!-- Mobile menu button -->
                <button class="md:hidden p-2 text-gray-600 hover:text-teal-600 transition-colors duration-200"
                    onclick="toggleMobileMenu()">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>

                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="hidden md:block px-6 py-2.5 bg-gradient-to-r from-teal-500 to-teal-600 text-white font-medium rounded-lg hover:from-teal-600 hover:to-teal-700 transition-all duration-300 shadow-md hover:shadow-lg transform hover:scale-105">
                            Dashboard
                        </a>
                    @else
                        @if(request()->routeIs('login'))
                            <a href="{{ route('register') }}"
                                class="hidden md:block px-6 py-2.5 bg-gradient-to-r from-teal-500 to-teal-600 text-white font-medium rounded-lg hover:from-teal-600 hover:to-teal-700 transition-all duration-300 shadow-md hover:shadow-lg transform hover:scale-105">
                                Register
                            </a>
                        @elseif(request()->routeIs('register'))
                            <a href="{{ route('login') }}"
                                class="hidden md:block px-6 py-2.5 bg-gradient-to-r from-teal-500 to-teal-600 text-white font-medium rounded-lg hover:from-teal-600 hover:to-teal-700 transition-all duration-300 shadow-md hover:shadow-lg transform hover:scale-105">
                                Login
                            </a>
                        @else
                            <div class="hidden md:flex items-center overflow-hidden rounded-lg shadow-md">
                                <a href=" {{ route('login') }} " class="px-6 py-2.5 bg-gray-100 text-gray-700 font-medium hover:bg-gray-200 transition-all duration-300">
                                    Login
                            </a>
                                <a href="{{ route('register') }}"
                                    class="px-6 py-2.5 bg-gradient-to-r from-teal-500 to-teal-600 text-white font-medium hover:from-teal-600 hover:to-teal-700 transition-all duration-300">
                                    Register
                                </a>
                            </div>
                        @endif
                    @endauth
                @endif
            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-100">
            <div class="px-6 py-4 space-y-3">
                <a href="{{ url('/') }}"
                    class="block text-gray-600 hover:text-teal-600 font-medium py-2 transition-colors duration-200">
                    Home
                </a>
                <a href="{{ url('/#rooms') }}"
                    class="block text-gray-600 hover:text-teal-600 font-medium py-2 transition-colors duration-200">
                    Rooms
                </a>
                <a href="{{ url('/#properties') }}"
                    class="block text-gray-600 hover:text-teal-600 font-medium py-2 transition-colors duration-200">
                    Properties
                </a>
                <a href="{{ url('/#facilities') }}"
                    class="block text-gray-600 hover:text-teal-600 font-medium py-2 transition-colors duration-200">
                    Facilities
                </a>

                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="block w-full text-center px-6 py-3 bg-gradient-to-r from-teal-500 to-teal-600 text-white font-medium rounded-lg hover:from-teal-600 hover:to-teal-700 transition-all duration-300 mt-4">
                            Dashboard
                        </a>
                    @else
                        <div class="flex flex-col space-y-2 mt-4">
                            @if(!request()->routeIs('login'))
                                <a href="{{ route('login') }}"
                                    class="block text-center px-6 py-3 bg-gray-100 text-gray-700 font-medium rounded-lg hover:bg-gray-200 transition-all duration-300">
                                    Login
                                </a>
                            @endif
                            @if(!request()->routeIs('register'))
                                <a href="{{ route('register') }}"
                                    class="block text-center px-6 py-3 bg-gradient-to-r from-teal-500 to-teal-600 text-white font-medium rounded-lg hover:from-teal-600 hover:to-teal-700 transition-all duration-300">
                                    Register
                                </a>
                            @endif
                        </div>
                    @endauth
                @endif
            </div>
        </div>
    </div>
</header>

<!-- Mobile Menu Script -->
<script>
    function toggleMobileMenu() {
        const mobileMenu = document.getElementById('mobile-menu');
        mobileMenu.classList.toggle('hidden');
    }
</script>