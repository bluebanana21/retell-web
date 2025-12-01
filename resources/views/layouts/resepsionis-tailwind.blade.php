<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - Resepsionis</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom Resepsionis CSS -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f5f7fb;
            min-height: 100vh;
        }
        
        .sidebar {
            background: #ffffff;
            border-right: 1px solid #e2e8f0;
            box-shadow: 2px 0 10px rgba(0,0,0,0.05);
        }
        
        .brand-link {
            background: rgba(0,0,0,0.03);
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }
        
        .sidebar-nav-link {
            color: #4a5568;
            border-radius: 8px;
            margin: 2px 8px;
            transition: all 0.2s ease;
            font-weight: 500;
        }
        
        .sidebar-nav-link:hover {
            background: #f1f5f9;
            color: #2d3748;
        }
        
        .sidebar-nav-link.active {
            background: #3b82f6;
            color: #fff;
            box-shadow: 0 4px 6px rgba(59,130,246,0.2);
        }
        
        .main-header {
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid #e2e8f0;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }
        
        .content-header {
            background: #ffffff;
            border-radius: 12px;
            margin: 15px;
            padding: 20px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            border: 1px solid #e2e8f0;
        }
        
        .card {
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            background: #ffffff;
            transition: all 0.2s ease;
            border: 1px solid #e2e8f0;
        }
        
        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0,0,0,0.07);
        }
        
        .info-box {
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            background: #ffffff;
            border: 1px solid #e2e8f0;
            transition: all 0.2s ease;
        }
        
        .info-box:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0,0,0,0.07);
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            font-weight: bold;
        }
    </style>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen flex flex-col">
        <!-- Navbar -->
        <header class="main-header sticky top-0 z-50">
            <nav class="bg-white shadow-md">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Mobile menu button -->
                            <button id="mobile-menu-button" class="md:hidden inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-gray-900 hover:bg-gray-100 focus:outline-none">
                                <i class="fas fa-bars text-xl"></i>
                            </button>
                            
                            <div class="hidden md:ml-6 md:flex md:space-x-8">
                                <span class="inline-flex items-center px-1 pt-1 border-b-2 border-indigo-500 text-sm font-medium text-gray-900">
                                    @yield('title', 'Dashboard')
                                </span>
                            </div>
                        </div>
                        
                        <div class="flex items-center">
                            <div class="ml-3 relative">
                                <div class="flex items-center space-x-3">
                                    <div class="text-sm text-gray-700 hidden md:block">
                                        {{ auth()->user()->name }}
                                    </div>
                                    <div class="relative">
                                        <button id="user-menu-button" class="flex text-sm rounded-full focus:outline-none">
                                            <div class="bg-primary/10 text-primary rounded-full w-10 h-10 flex items-center justify-center font-semibold">
                                                {{ substr(auth()->user()->name, 0, 1) }}
                                            </div>
                                        </button>
                                    </div>
                                </div>
                                
                                <div id="user-dropdown" class="hidden origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50 border border-gray-200" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md" role="menuitem" tabindex="-1">
                                        <i class="fas fa-user mr-2"></i>Profile
                                    </a>
                                    <div class="border-t border-gray-200 my-1"></div>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md" role="menuitem" tabindex="-1">
                                            <i class="fas fa-sign-out-alt mr-2"></i>Logout
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Mobile menu -->
                <div id="mobile-menu" class="hidden md:hidden">
                    <div class="pt-2 pb-3 space-y-1">
                        <a href="{{ route('resepsionis.dashboard') }}" class="border-transparent {{ request()->routeIs('resepsionis.dashboard') ? 'border-primary text-primary bg-primary/10' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }} block pl-3 pr-4 py-2 border-l-4 text-base font-medium rounded-md">
                            <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                        </a>
                        <a href="{{ route('resepsionis.reservations.index') }}" class="border-transparent {{ request()->routeIs('resepsionis.reservations.*') ? 'border-primary text-primary bg-primary/10' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }} block pl-3 pr-4 py-2 border-l-4 text-base font-medium rounded-md">
                            <i class="fas fa-calendar-check mr-2"></i>Kelola Reservasi
                        </a>
                    </div>
                </div>
            </nav>
        </header>

        <!-- Page Content -->
        <div class="flex flex-1">
            <!-- Sidebar -->
            <aside class="sidebar hidden md:block md:w-64 flex-shrink-0">
                <div class="h-full flex flex-col">
                    <div class="brand-link flex items-center px-4 py-5">
                        <i class="fas fa-hotel text-primary text-2xl mr-3"></i>
                        <span class="brand-text text-primary text-xl font-semibold">Retell Hotel</span>
                    </div>
                    
                    <div class="flex-1 overflow-y-auto py-5">
                        <nav class="px-3">
                            <a href="{{ route('resepsionis.dashboard') }}" class="sidebar-nav-link {{ request()->routeIs('resepsionis.dashboard') ? 'active' : '' }} flex items-center px-4 py-3 text-base font-medium rounded-md">
                                <i class="fas fa-tachometer-alt mr-3"></i>
                                <span>Dashboard</span>
                            </a>
                            <a href="{{ route('resepsionis.reservations.index') }}" class="sidebar-nav-link {{ request()->routeIs('resepsionis.reservations.*') ? 'active' : '' }} flex items-center px-4 py-3 text-base font-medium rounded-md">
                                <i class="fas fa-calendar-check mr-3"></i>
                                <span>Kelola Reservasi</span>
                            </a>
                        </nav>
                    </div>
                </div>
            </aside>

            <!-- Main Content -->
            <main class="flex-1 overflow-hidden">
                <!-- Content Header -->
                <div class="content-header">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                            <div class="flex-1 min-w-0">
                                <h1 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                                    @yield('title', 'Dashboard')
                                </h1>
                            </div>
                            <div class="mt-4 flex md:mt-0 md:ml-4">
                                <nav class="flex" aria-label="Breadcrumb">
                                    <ol class="flex items-center space-x-2">
                                        @yield('breadcrumb')
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Alerts -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                    @if (session('success'))
                        <div class="rounded-lg bg-green-50 p-4 mb-4 border border-green-200">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-check-circle text-green-400"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-green-800">
                                        {{ session('success') }}
                                    </p>
                                </div>
                                <div class="ml-auto pl-3">
                                    <div class="-mx-1.5 -my-1.5">
                                        <button type="button" class="inline-flex bg-green-50 rounded-md p-1.5 text-green-500 hover:bg-green-100 focus:outline-none">
                                            <span class="sr-only">Dismiss</span>
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    @if (session('error'))
                        <div class="rounded-lg bg-red-50 p-4 mb-4 border border-red-200">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-exclamation-circle text-red-400"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-red-800">
                                        {{ session('error') }}
                                    </p>
                                </div>
                                <div class="ml-auto pl-3">
                                    <div class="-mx-1.5 -my-1.5">
                                        <button type="button" class="inline-flex bg-red-50 rounded-md p-1.5 text-red-500 hover:bg-red-100 focus:outline-none">
                                            <span class="sr-only">Dismiss</span>
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Main content -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-8">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
        
        // User dropdown toggle
        document.getElementById('user-menu-button').addEventListener('click', function() {
            const dropdown = document.getElementById('user-dropdown');
            dropdown.classList.toggle('hidden');
        });
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('user-dropdown');
            const button = document.getElementById('user-menu-button');
            
            if (!button.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>