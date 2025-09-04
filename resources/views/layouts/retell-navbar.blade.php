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
                        <!-- Profile Dropdown -->
                        <div class="relative">
                            <button onclick="toggleProfileDropdown()" class="hidden md:flex items-center space-x-2 px-4 py-2 bg-gradient-to-r from-teal-500 to-teal-600 text-white font-medium rounded-lg hover:from-teal-600 hover:to-teal-700 transition-all duration-300 shadow-md hover:shadow-lg">
                                <div class="w-8 h-8 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user text-sm"></i>
                                </div>
                                <span>{{ auth()->user()->name }}</span>
                                <i class="fas fa-chevron-down text-xs"></i>
                            </button>
                            
                            <!-- Dropdown Menu -->
                            <div id="profile-dropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-100 z-50">
                                <div class="py-2">
                                    <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                                        <i class="fas fa-user-edit mr-3 text-gray-400"></i>
                                        Edit Profile
                                    </a>
                                    <hr class="my-1">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="w-full flex items-center px-4 py-2 text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                                            <i class="fas fa-sign-out-alt mr-3 text-gray-400"></i>
                                            Logout
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
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
                        <!-- Mobile Profile Menu -->
                        <div class="border-t border-gray-200 pt-4 mt-4">
                            <div class="flex items-center mb-3">
                                <div class="w-10 h-10 bg-gradient-to-r from-teal-500 to-teal-600 rounded-full flex items-center justify-center text-white font-bold mr-3">
                                    {{ substr(auth()->user()->name, 0, 1) }}
                                </div>
                                <div>
                                    <div class="font-medium text-gray-900">{{ auth()->user()->name }}</div>
                                    <div class="text-sm text-gray-500">{{ auth()->user()->email }}</div>
                                </div>
                            </div>
                            <a href="{{ route('profile.edit') }}" class="block w-full text-center px-6 py-3 bg-gray-100 text-gray-700 font-medium rounded-lg hover:bg-gray-200 transition-all duration-300 mb-2">
                                <i class="fas fa-user-edit mr-2"></i>Edit Profile
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-center px-6 py-3 bg-gradient-to-r from-red-500 to-red-600 text-white font-medium rounded-lg hover:from-red-600 hover:to-red-700 transition-all duration-300">
                                    <i class="fas fa-sign-out-alt mr-2"></i>Logout
                                </button>
                            </form>
                        </div>
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
    
    function toggleProfileDropdown() {
        const dropdown = document.getElementById('profile-dropdown');
        dropdown.classList.toggle('hidden');
    }
    
    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const dropdown = document.getElementById('profile-dropdown');
        const button = event.target.closest('button');
        
        if (!button || !button.onclick || button.onclick.toString().indexOf('toggleProfileDropdown') === -1) {
            if (dropdown && !dropdown.classList.contains('hidden')) {
                dropdown.classList.add('hidden');
            }
        }
    });
</script>