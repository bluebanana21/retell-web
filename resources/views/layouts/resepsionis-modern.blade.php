

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
    
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --accent: #4895ef;
            --success: #4cc9f0;
            --dark: #1d3557;
            --light: #f8f9fa;
            --gray: #6c757d;
            --sidebar-width: 260px;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f5f7fb;
            color: #333;
        }
        
        .sidebar {
            width: var(--sidebar-width);
            background: linear-gradient(180deg, var(--primary) 0%, var(--secondary) 100%);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            z-index: 100;
        }
        
        .sidebar.collapsed {
            width: 70px;
        }
        
        .main-content {
            margin-left: var(--sidebar-width);
            transition: all 0.3s ease;
        }
        
        .sidebar.collapsed ~ .main-content {
            margin-left: 70px;
        }
        
        .brand-logo {
            transition: all 0.3s ease;
        }
        
        .sidebar.collapsed .brand-text,
        .sidebar.collapsed .nav-text {
            display: none;
        }
        
        .sidebar.collapsed .nav-link {
            justify-content: center;
            padding: 12px 0;
        }
        
        .sidebar.collapsed .nav-link i {
            margin-right: 0;
        }
        
        .topbar {
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            height: 70px;
        }
        
        .card {
            border-radius: 16px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
            border: none;
            transition: all 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }
        
        .stat-card {
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            border: none;
            transition: all 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            border: none;
            border-radius: 10px;
            padding: 10px 20px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(67, 97, 238, 0.3);
        }
        
        .table th {
            font-weight: 600;
            color: var(--dark);
        }
        
        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: white;
        }
        
        .badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        .search-input {
            border-radius: 12px;
            padding: 12px 20px;
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }
        
        .search-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
        }
        
        .pagination .page-link {
            border-radius: 10px;
            margin: 0 3px;
            border: none;
            color: var(--gray);
        }
        
        .pagination .page-item.active .page-link {
            background: var(--primary);
            color: white;
        }
        
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                left: -100%;
            }
            
            .sidebar.active {
                left: 0;
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                z-index: 99;
                display: none;
            }
            
            .overlay.active {
                display: block;
            }
        }
    </style>
</head>
<body class="font-sans antialiased">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="sidebar fixed h-screen flex flex-col">
            <div class="p-5 flex items-center justify-between border-b border-blue-400/20">
                <a href="{{ route('resepsionis.dashboard') }}" class="brand-logo flex items-center">
                    <i class="fas fa-hotel text-white text-2xl mr-3"></i>
                    <span class="brand-text text-white text-xl font-bold">Retell Hotel</span>
                </a>
                <button id="sidebar-toggle" class="text-white md:hidden">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <div class="flex-1 overflow-y-auto py-5">
                <nav class="px-3">
                    <a href="{{ route('resepsionis.dashboard') }}" class="nav-link flex items-center px-4 py-3 text-base font-medium rounded-xl mb-2 text-white {{ request()->routeIs('resepsionis.dashboard') ? 'bg-white/20' : 'hover:bg-white/10' }}">
                        <i class="fas fa-tachometer-alt mr-3 text-lg"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                    <a href="{{ route('resepsionis.reservations.index') }}" class="nav-link flex items-center px-4 py-3 text-base font-medium rounded-xl mb-2 text-white {{ request()->routeIs('resepsionis.reservations.*') ? 'bg-white/20' : 'hover:bg-white/10' }}">
                        <i class="fas fa-calendar-check mr-3 text-lg"></i>
                        <span class="nav-text">Kelola Reservasi</span>
                    </a>
                </nav>
            </div>
            
            <div class="p-5 border-t border-blue-400/20">
                <button id="sidebar-collapse" class="w-full flex items-center justify-center text-white hover:bg-white/10 p-2 rounded-lg">
                    <i class="fas fa-angle-left"></i>
                </button>
            </div>
        </aside>

        <!-- Overlay for mobile -->
        <div class="overlay" id="overlay"></div>

        <!-- Main Content -->
        <div class="main-content flex-1 flex flex-col">
            <!-- Topbar -->
            <header class="topbar flex items-center justify-between px-6">
                <div class="flex items-center">
                    <button id="mobile-toggle" class="text-gray-600 mr-4 md:hidden">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <h1 class="text-xl font-bold text-gray-800">@yield('title', 'Dashboard')</h1>
                </div>
                
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <div class="flex items-center space-x-3">
                            <span class="text-gray-700 hidden md:block">{{ auth()->user()->name }}</span>
                            <div class="avatar bg-indigo-500">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Breadcrumb -->
            <div class="px-6 py-4">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="flex items-center space-x-2 text-sm">
                        <li>
                            <a href="{{ route('resepsionis.dashboard') }}" class="text-indigo-600 hover:text-indigo-800">Home</a>
                        </li>
                        @yield('breadcrumb')
                    </ol>
                </nav>
            </div>

            <!-- Alerts -->
            <div class="px-6">
                @if (session('success'))
                    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 flex items-center">
                        <i class="fas fa-check-circle mr-2"></i>
                        <span>{{ session('success') }}</span>
                        <button class="ml-auto" onclick="this.parentElement.style.display='none'">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                @endif
                
                @if (session('error'))
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-6 flex items-center">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <span>{{ session('error') }}</span>
                        <button class="ml-auto" onclick="this.parentElement.style.display='none'">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                @endif
            </div>

            <!-- Main content -->
            <main class="flex-1 p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        // Mobile sidebar toggle
        document.getElementById('mobile-toggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.add('active');
            document.getElementById('overlay').classList.add('active');
        });
        
        document.getElementById('sidebar-toggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.remove('active');
            document.getElementById('overlay').classList.remove('active');
        });
        
        document.getElementById('overlay').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.remove('active');
            this.classList.remove('active');
        });
        
        // Sidebar collapse
        document.getElementById('sidebar-collapse').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('collapsed');
            document.querySelector('.main-content').classList.toggle('collapsed');
        });
    </script>
    
    @stack('scripts')
</body>
</html>