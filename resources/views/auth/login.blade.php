<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Login</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,600&family=joan:400&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-inter antialiased bg-gray-50">
    <!-- Include Navbar -->
    @include('layouts.retell-navbar')

    <!-- Main Content -->
    <div class="min-h-screen flex pt-16"
        style="background: linear-gradient(135deg, rgba(110, 180, 192, 0.9) 0%, rgba(0, 107, 131, 0.8) 100%);">
        <!-- Left Side - Hotel Images -->
        <div class="w-3/5 p-8 relative overflow-hidden">
            <div class="grid grid-cols-4 gap-4 h-full">
                <!-- Column 1 -->
                <div class="flex flex-col gap-4">
                    <div
                        class="bg-white/20 backdrop-blur-sm rounded-xl h-48 shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                    </div>
                    <div
                        class="bg-white/20 backdrop-blur-sm rounded-xl h-64 shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                    </div>
                    <div
                        class="bg-white/20 backdrop-blur-sm rounded-xl h-40 shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                    </div>
                </div>
                <!-- Column 2 -->
                <div class="flex flex-col gap-4 mt-16">
                    <div
                        class="bg-white/20 backdrop-blur-sm rounded-xl h-36 shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                    </div>
                    <div
                        class="bg-white/20 backdrop-blur-sm rounded-xl h-56 shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                    </div>
                    <div
                        class="bg-white/20 backdrop-blur-sm rounded-xl h-48 shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                    </div>
                </div>
                <!-- Column 3 -->
                <div class="flex flex-col gap-4">
                    <div
                        class="bg-white/20 backdrop-blur-sm rounded-xl h-52 shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                    </div>
                    <div
                        class="bg-white/20 backdrop-blur-sm rounded-xl h-44 shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                    </div>
                    <div
                        class="bg-white/20 backdrop-blur-sm rounded-xl h-60 shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                    </div>
                </div>
                <!-- Column 4 -->
                <div class="flex flex-col gap-4 mt-32">
                    <div
                        class="bg-white/20 backdrop-blur-sm rounded-xl h-48 shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                    </div>
                    <div
                        class="bg-white/20 backdrop-blur-sm rounded-xl h-56 shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Login Form -->
        <div class="w-2/5 flex items-center justify-center p-8">
            <div class="bg-white/95 backdrop-blur-xl rounded-2xl shadow-2xl p-8 max-w-md w-full border border-white/20">
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <div class="text-center mb-8">
                    <h2 class="font-joan text-3xl font-semibold mb-2" style="color: #006B83;">Welcome Back</h2>
                    <p class="text-gray-600">Sign in to your account</p>
                </div>

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                            autocomplete="username" placeholder="Enter your email"
                            class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all duration-200 bg-white text-gray-900 placeholder-gray-500" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            placeholder="Enter your password"
                            class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all duration-200 bg-white text-gray-900 placeholder-gray-500" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox"
                                class="rounded border-gray-300 text-teal-600 shadow-sm focus:ring-teal-500"
                                name="remember">
                            <span class="ml-2 text-sm text-gray-600">Remember me</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-sm text-teal-600 hover:text-teal-800 font-medium"
                                href="{{ route('password.request') }}">
                                Forgot password?
                            </a>
                        @endif
                    </div>

                    <!-- Login Button -->
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-teal-500 to-teal-600 text-white font-medium py-3 px-4 rounded-lg hover:from-teal-600 hover:to-teal-700 transition-all duration-300 shadow-md hover:shadow-lg transform hover:scale-105">
                        LOG IN
                    </button>

                    <!-- Divider -->
                    <div class="flex items-center my-6">
                        <div class="flex-1 border-t border-gray-200"></div>
                        <span class="mx-4 text-sm text-gray-500">or continue with</span>
                        <div class="flex-1 border-t border-gray-200"></div>
                    </div>

                    <!-- Social Login Buttons -->
                    <div class="space-y-3">
                        <a href="{{ route('google.redirect') }}"
                            class="w-full flex items-center justify-center px-4 py-3 border border-gray-200 rounded-lg bg-white hover:bg-gray-50 transition-all duration-200 group">
                            <svg class="w-5 h-5 text-red-500 mr-3" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" />
                                <path fill="currentColor"
                                    d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" />
                                <path fill="currentColor"
                                    d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" />
                                <path fill="currentColor"
                                    d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" />
                            </svg>
                            <span class="text-gray-700 font-medium group-hover:text-gray-900">Continue with Google</span>
                        </a>

                        <button type="button"
                            class="w-full flex items-center justify-center px-4 py-3 border border-gray-200 rounded-lg bg-white hover:bg-gray-50 transition-all duration-200 group">
                            <svg class="w-5 h-5 text-blue-600 mr-3" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                            <span class="text-gray-700 font-medium group-hover:text-gray-900">Facebook</span>
                        </button>
                    </div>
                </form>

                <div class="text-center mt-6">
                    <p class="text-gray-600">
                        Don't have an account?
                        <a href="{{ route('register') }}" class="text-teal-600 hover:text-teal-800 font-medium">
                            Sign up here
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Menu Script -->
    <script>
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        }
    </script>
</body>

</html>