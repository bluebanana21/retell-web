@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('breadcrumb')
    <li class="inline-flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <span class="text-gray-500">Dashboard</span>
    </li>
@endsection

@section('content')
<!-- Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Hotels -->
    <div class="bg-white/70 backdrop-blur-xl rounded-2xl p-6 shadow-lg border border-white/20 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 uppercase tracking-wide">Total Hotel</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_hotels'] }}</p>
            </div>
            <div class="w-14 h-14 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg">
                <i class="fas fa-hotel text-white text-xl"></i>
            </div>
        </div>
    </div>

    <!-- Total Rooms -->
    <div class="bg-white/70 backdrop-blur-xl rounded-2xl p-6 shadow-lg border border-white/20 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 uppercase tracking-wide">Total Kamar</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_rooms'] }}</p>
                <p class="text-xs text-green-600 mt-1">{{ $stats['available_rooms'] }} tersedia</p>
            </div>
            <div class="w-14 h-14 bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-xl flex items-center justify-center shadow-lg">
                <i class="fas fa-bed text-white text-xl"></i>
            </div>
        </div>
    </div>

    <!-- Total Reservations -->
    <div class="bg-white/70 backdrop-blur-xl rounded-2xl p-6 shadow-lg border border-white/20 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 uppercase tracking-wide">Total Reservasi</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_reservations'] }}</p>
            </div>
            <div class="w-14 h-14 bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                <i class="fas fa-calendar-check text-white text-xl"></i>
            </div>
        </div>
    </div>

    <!-- Total Users -->
    <div class="bg-white/70 backdrop-blur-xl rounded-2xl p-6 shadow-lg border border-white/20 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 uppercase tracking-wide">Total Tamu</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_users'] }}</p>
            </div>
            <div class="w-14 h-14 bg-gradient-to-r from-amber-500 to-amber-600 rounded-xl flex items-center justify-center shadow-lg">
                <i class="fas fa-users text-white text-xl"></i>
            </div>
        </div>
    </div>
</div>

<!-- Room Status and Recent Reservations -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
    <!-- Room Status -->
    <div class="lg:col-span-2">
        <div class="bg-white/70 backdrop-blur-xl rounded-2xl shadow-lg border border-white/20">
            <div class="p-6 border-b border-gray-200/50">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-chart-pie mr-3 text-indigo-600"></i>
                    Status Kamar
                </h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Available Rooms -->
                    <div class="bg-gradient-to-r from-green-500 to-emerald-600 rounded-xl p-6 text-white shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-green-100 text-sm font-medium uppercase tracking-wide">Tersedia</p>
                                <p class="text-3xl font-bold mt-2">{{ $stats['available_rooms'] }}</p>
                            </div>
                            <i class="fas fa-check-circle text-4xl text-green-200"></i>
                        </div>
                    </div>

                    <!-- Booked Rooms -->
                    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl p-6 text-white shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-blue-100 text-sm font-medium uppercase tracking-wide">Dibooked</p>
                                <p class="text-3xl font-bold mt-2">{{ $stats['booked_rooms'] }}</p>
                            </div>
                            <i class="fas fa-calendar-times text-4xl text-blue-200"></i>
                        </div>
                    </div>

                    <!-- Maintenance Rooms -->
                    <div class="bg-gradient-to-r from-amber-500 to-orange-600 rounded-xl p-6 text-white shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-amber-100 text-sm font-medium uppercase tracking-wide">Maintenance</p>
                                <p class="text-3xl font-bold mt-2">{{ $stats['maintenance_rooms'] }}</p>
                            </div>
                            <i class="fas fa-tools text-4xl text-amber-200"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Reservations -->
    <div class="lg:col-span-1">
        <div class="bg-white/70 backdrop-blur-xl rounded-2xl shadow-lg border border-white/20 h-full">
            <div class="p-6 border-b border-gray-200/50 flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-clock mr-3 text-indigo-600"></i>
                    Reservasi Terbaru
                </h3>
                <a href="{{ route('resepsionis.reservations.index') }}" 
                   class="text-sm text-indigo-600 hover:text-indigo-800 font-medium transition-colors">
                    Lihat Semua
                </a>
            </div>
            <div class="p-6">
                @if($recent_reservations->count() > 0)
                    <div class="space-y-4">
                        @foreach($recent_reservations as $reservation)
                        <div class="flex items-center space-x-4 p-3 bg-gray-50/50 rounded-xl hover:bg-gray-100/50 transition-colors">
                            <div class="w-10 h-10 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full flex items-center justify-center flex-shrink-0">
                                <span class="text-white text-sm font-semibold">{{ substr($reservation->user->name, 0, 1) }}</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate">{{ $reservation->user->name }}</p>
                                <p class="text-xs text-gray-500 truncate">{{ $reservation->kamar->hotel->nama_hotel }}</p>
                                <p class="text-xs text-gray-400">{{ $reservation->created_at->diffForHumans() }}</p>
                            </div>
                            <div class="flex-shrink-0">
                                @if($reservation->status == 'pending')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        Pending
                                    </span>
                                @elseif($reservation->status == 'dikonfirmasi')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Dikonfirmasi
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        Selesai
                                    </span>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <i class="fas fa-calendar-times text-4xl text-gray-300 mb-4"></i>
                        <p class="text-gray-500 font-medium">Belum ada reservasi</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="bg-white/70 backdrop-blur-xl rounded-2xl shadow-lg border border-white/20">
    <div class="p-6 border-b border-gray-200/50">
        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
            <i class="fas fa-bolt mr-3 text-indigo-600"></i>
            Quick Actions
        </h3>
    </div>
    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <a href="{{ route('admin.kamar.create') }}" 
               class="group bg-gradient-to-r from-emerald-500 to-green-600 hover:from-emerald-600 hover:to-green-700 text-white rounded-xl p-6 text-center transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
                <i class="fas fa-plus-circle text-3xl mb-3 group-hover:scale-110 transition-transform duration-300"></i>
                <p class="font-semibold">Tambah Kamar</p>
            </a>
            
            <a href="{{ route('admin.fasilitas.create') }}" 
               class="group bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white rounded-xl p-6 text-center transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
                <i class="fas fa-concierge-bell text-3xl mb-3 group-hover:scale-110 transition-transform duration-300"></i>
                <p class="font-semibold">Tambah Fasilitas</p>
            </a>
            
            <a href="{{ route('admin.kota.create') }}" 
               class="group bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white rounded-xl p-6 text-center transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
                <i class="fas fa-map-marker-alt text-3xl mb-3 group-hover:scale-110 transition-transform duration-300"></i>
                <p class="font-semibold">Tambah Kota</p>
            </a>
            
            <a href="{{ route('resepsionis.reservations.index') }}" 
               class="group bg-gradient-to-r from-purple-500 to-indigo-600 hover:from-purple-600 hover:to-indigo-700 text-white rounded-xl p-6 text-center transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
                <i class="fas fa-list text-3xl mb-3 group-hover:scale-110 transition-transform duration-300"></i>
                <p class="font-semibold">Lihat Reservasi</p>
            </a>
        </div>
    </div>
</div>
@endsection