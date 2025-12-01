<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="retell">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#0f172a">
    <title>{{ config('app.name', 'Laravel') }} - Admin</title>
    
    <link rel="manifest" href="/manifest.webmanifest">

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
            --sidebar-width: 260px;
            --sidebar-collapsed-width: 70px;
            --primary-color: #4361ee;
            --primary-hover: #3a56d4;
            --sidebar-bg: #ffffff;
            --sidebar-border: #e2e8f0;
            --sidebar-text: #475569;
            --sidebar-text-hover: #1e293b;
            --sidebar-text-active: #ffffff;
            --sidebar-active-bg: #4361ee;
            --sidebar-hover-bg: #f1f5f9;
            --sidebar-section-text: #94a3b8;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f5f7fb;
        }
        
        .sidebar {
            width: var(--sidebar-width);
            transition: all 0.3s ease;
            z-index: 100;
            background-color: var(--sidebar-bg);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        }
        
        .sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }
        
        .sidebar.hidden {
            margin-left: calc(var(--sidebar-collapsed-width) * -1);
        }
        
        .main-content {
            margin-left: var(--sidebar-width);
            transition: all 0.3s ease;
        }
        
        .sidebar.collapsed ~ .main-content {
            margin-left: var(--sidebar-collapsed-width);
        }
        
        .sidebar.hidden ~ .main-content {
            margin-left: 0;
        }
        
        .brand-logo {
            transition: all 0.3s ease;
        }
        
        .sidebar.collapsed .brand-text,
        .sidebar.collapsed .nav-text,
        .sidebar.collapsed .menu-title {
            display: none;
        }
        
        .sidebar.collapsed .nav-link {
            justify-content: center;
            padding: 16px 0;
        }
        
        .sidebar.collapsed .nav-link i {
            margin-right: 0;
        }
        
        .sidebar.collapsed .menu-title {
            display: none;
        }
        
        /* Professional nav link styling */
        .nav-link {
            padding: 14px 20px;
            display: flex;
            align-items: center;
            gap: 14px;
            font-weight: 500;
            transition: all 0.2s ease;
            color: var(--sidebar-text);
            border-radius: 0.75rem;
            margin: 0 8px;
        }
        
        .nav-link.active {
            background-color: var(--sidebar-active-bg);
            color: var(--sidebar-text-active);
        }
        
        .nav-link:hover:not(.active) {
            background-color: var(--sidebar-hover-bg);
            color: var(--sidebar-text-hover);
        }
        
        .nav-link i {
            font-size: 1.125rem;
            width: 24px;
            text-align: center;
        }
        
        .menu-title {
            padding: 0 20px;
            margin: 24px 0 12px 0;
        }
        
        .menu-title span {
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            color: var(--sidebar-section-text);
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
        
        /* Modern card styles */
        .modern-card {
            border-radius: 1rem;
            border: 1px solid #e2e8f0;
            background-color: #ffffff;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -2px rgba(0, 0, 0, 0.03);
            transition: all 0.3s ease;
        }
        
        .modern-card:hover {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        /* Modern button styles */
        .modern-btn {
            border-radius: 0.75rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        /* Modern input styles */
        .modern-input {
            border-radius: 0.75rem;
            border: 1px solid #cbd5e1;
            transition: all 0.3s ease;
        }
        
        .modern-input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
        }
        
        /* Collapse button styling */
        #sidebar-collapse {
            color: var(--sidebar-section-text);
            transition: all 0.2s ease;
        }
        
        #sidebar-collapse:hover {
            background-color: var(--sidebar-hover-bg);
            color: var(--sidebar-text-hover);
        }
        
        /* Brand styling */
        .brand-text {
            font-weight: 700;
            font-size: 1.25rem;
            background: linear-gradient(135deg, var(--primary-color), #64748b);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        /* Avatar styling */
        .avatar {
            background: linear-gradient(135deg, var(--primary-color), #7c3aed);
        }
    </style>
</head>
<body class="font-sans antialiased">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="sidebar fixed h-screen flex flex-col border-r" style="border-color: var(--sidebar-border);">
            <div class="p-5 flex items-center justify-between border-b" style="border-color: var(--sidebar-border);">
                <a href="{{ route('admin.dashboard') }}" class="brand-logo flex items-center">
                    <div class="avatar text-white rounded-lg w-10 h-10 flex items-center justify-center">
                        <i class="fas fa-hotel text-lg"></i>
                    </div>
                    <span class="brand-text ml-3">Retell Hotel</span>
                </a>
                <button id="sidebar-toggle" class="text-gray-500 md:hidden hover:bg-gray-100 rounded-full w-8 h-8 flex items-center justify-center">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <div class="flex-1 overflow-y-auto py-5">
                <ul class="px-2">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="fas fa-tachometer-alt"></i>
                            <span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="menu-title">
                        <span>Management</span>
                    </li>
                    <li>
                        <a href="{{ route('admin.kamar.index') }}" class="nav-link {{ request()->routeIs('admin.kamar.*') ? 'active' : '' }}">
                            <i class="fas fa-bed"></i>
                            <span class="nav-text">Kelola Kamar</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.fasilitas.index') }}" class="nav-link {{ request()->routeIs('admin.fasilitas.*') ? 'active' : '' }}">
                            <i class="fas fa-concierge-bell"></i>
                            <span class="nav-text">Kelola Fasilitas</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.kota.index') }}" class="nav-link {{ request()->routeIs('admin.kota.*') ? 'active' : '' }}">
                            <i class="fas fa-map-marker-alt"></i>
                            <span class="nav-text">Kelola Kota</span>
                        </a>
                    </li>
                    <li class="menu-title">
                        <span>Media</span>
                    </li>
                    <li>
                        <a href="{{ route('admin.hotel-images.index') }}" class="nav-link {{ request()->routeIs('admin.hotel-images.*') ? 'active' : '' }}">
                            <i class="fas fa-images"></i>
                            <span class="nav-text">Hotel Images</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.kamar-images.index') }}" class="nav-link {{ request()->routeIs('admin.kamar-images.*') ? 'active' : '' }}">
                            <i class="fas fa-images"></i>
                            <span class="nav-text">Kamar Images</span>
                        </a>
                    </li>
                </ul>
            </div>
            
            <div class="p-4 border-t" style="border-color: var(--sidebar-border);">
                <button id="sidebar-collapse" class="w-full flex items-center justify-center p-2 rounded-lg">
                    <i class="fas fa-angle-left"></i>
                </button>
            </div>
        </aside>

        <!-- Overlay for mobile -->
        <div class="overlay" id="overlay"></div>

        <!-- Main Content -->
        <div class="main-content flex-1 flex flex-col">
            <!-- Topbar -->
            <header class="bg-base-100 shadow-sm h-16 flex items-center px-6">
                <div class="flex items-center flex-1">
                    <button id="mobile-toggle" class="text-base-content mr-4 md:hidden btn btn-ghost btn-sm btn-circle">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <button id="desktop-sidebar-toggle" class="text-base-content mr-4 hidden md:block btn btn-ghost btn-sm btn-circle">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <h1 class="text-xl font-bold text-base-content">@yield('title', 'Dashboard')</h1>
                </div>
                
                <div class="flex items-center gap-2 md:gap-3">
                    <!-- Theme Switcher -->
                    <div class="dropdown dropdown-end hidden md:block">
                        <div tabindex="0" role="button" class="btn btn-ghost btn-sm btn-circle" aria-label="Theme">
                            <i class="fas fa-circle-half-stroke"></i>
                            <span class="hidden">Theme</span>
                            <i class="hidden"></i>
                        </div>
                        <ul tabindex="0" class="dropdown-content z-50 menu p-2 shadow bg-base-100 rounded-box w-40">
                            <li><a onclick="setTheme('retell')">Retell</a></li>
                            <li><a onclick="setTheme('light')">Light</a></li>
                            <li><a onclick="setTheme('dark')">Dark</a></li>
                        </ul>
                    </div>
                    <!-- Search Bar -->
                    <div class="hidden md:flex items-center">
                        <div class="form-control">
                            <div class="input-group">
                                <input type="text" placeholder="Search..." class="input input-bordered input-sm rounded-lg w-48 focus:w-56 transition-all duration-300" />
                                <button class="btn btn-square btn-sm rounded-lg">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- User Profile -->
                    <div class="dropdown dropdown-end">
                        <div tabindex="0" role="button" class="flex items-center gap-2 md:gap-3 focus:outline-none btn btn-ghost px-2 md:px-3 h-10 rounded-xl">
                            <div class="flex-shrink-0">
                                <div class="bg-primary text-primary-content rounded-full w-9 h-9 md:w-10 md:h-10 flex items-center justify-center">
                                    <span class="font-semibold">A</span>
                                </div>
                            </div>
                            <div class="hidden md:flex flex-col items-start leading-tight">
                                <span class="text-sm font-medium text-base-content">Admin User</span>
                                <span class="text-xs text-base-content/70">Admin</span>
                            </div>
                            <i class="hidden md:inline-block fas fa-chevron-down text-xs text-base-content/60"></i>
                        </div>
                        
                        <!-- Dropdown menu -->
                        <ul tabindex="0" class="dropdown-content z-50 menu p-2 shadow bg-base-100 rounded-box w-52 mt-2">
                            <li>
                                <a href="{{ route('profile.edit') }}" class="flex items-center">
                                    <i class="fas fa-user-edit mr-2"></i>Edit Profile
                                </a>
                            </li>
                            <li class="border-t border-base-200 my-1"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full text-left flex items-center">
                                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </header>

            <!-- Breadcrumb -->
            <div class="px-6 py-4 bg-base-100 border-b border-base-200">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="flex items-center space-x-2 text-sm">
                        <li>
                            <a href="{{ route('admin.dashboard') }}" class="text-primary hover:text-primary-focus">Home</a>
                        </li>
                        @yield('breadcrumb')
                    </ol>
                </nav>
            </div>

            <!-- Alerts -->
            <div class="px-6 pt-6">
                @if (session('success'))
                    <div class="alert alert-success shadow-lg mb-6 rounded-2xl">
                        <div>
                            <i class="fas fa-check-circle mr-2"></i>
                            <span>{{ session('success') }}</span>
                        </div>
                        <div class="flex-none">
                            <button class="btn btn-sm btn-circle btn-ghost" onclick="this.parentElement.parentElement.style.display='none'">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                @endif
                
                @if (session('error'))
                    <div class="alert alert-error shadow-lg mb-6 rounded-2xl">
                        <div>
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            <span>{{ session('error') }}</span>
                        </div>
                        <div class="flex-none">
                            <button class="btn btn-sm btn-circle btn-ghost" onclick="this.parentElement.parentElement.style.display='none'">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Main content -->
            <main class="flex-1 p-6">
                @yield('content')
            </main>
            
            <!-- Footer -->
            <footer class="footer footer-center p-6 bg-base-100 border-t border-base-200 text-base-content">
                <div class="text-sm">
                    <p>© {{ date('Y') }} Retell Hotel Admin. All rights reserved.</p>
                </div>
            </footer>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        // Theme preference
        (function() {
            const saved = localStorage.getItem('theme');
            if (saved) {
                document.documentElement.setAttribute('data-theme', saved);
            }
        })();

        function setTheme(theme) {
            try { localStorage.setItem('theme', theme); } catch (_) {}
            document.documentElement.setAttribute('data-theme', theme);
        }

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
        
        // Desktop sidebar toggle (hide/show completely)
        document.getElementById('desktop-sidebar-toggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('hidden');
            document.querySelector('.main-content').classList.toggle('full-width');
            
            // Update icon based on state
            const icon = this.querySelector('i');
            if (document.querySelector('.sidebar').classList.contains('hidden')) {
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-arrow-right');
            } else {
                icon.classList.remove('fa-arrow-right');
                icon.classList.add('fa-bars');
            }
        });
        
        // Sidebar collapse (compact view)
        document.getElementById('sidebar-collapse').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('collapsed');
            document.querySelector('.main-content').classList.toggle('collapsed');
            
            // Update icon based on state
            const icon = this.querySelector('i');
            if (document.querySelector('.sidebar').classList.contains('collapsed')) {
                icon.classList.remove('fa-angle-left');
                icon.classList.add('fa-angle-right');
            } else {
                icon.classList.remove('fa-angle-right');
                icon.classList.add('fa-angle-left');
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>
