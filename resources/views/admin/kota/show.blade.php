@extends('layouts.admin')

@section('title', 'Detail Kota')

@section('breadcrumb')
    <li class="inline-flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-indigo-600 transition-colors">Dashboard</a>
    </li>
    <li class="inline-flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <a href="{{ route('admin.kota.index') }}" class="text-gray-500 hover:text-indigo-600 transition-colors">Kelola Kota</a>
    </li>
    <li class="inline-flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <span class="text-gray-500">Detail Kota</span>
    </li>
@endsection

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- City Details -->
        <div class="lg:col-span-1">
            <div class="bg-white/70 backdrop-blur-xl rounded-2xl shadow-lg border border-white/20">
                <!-- Header -->
                <div class="p-6 border-b border-gray-200/50">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-gradient-to-r from-amber-500 to-orange-600 rounded-xl flex items-center justify-center">
                                <i class="fas fa-map-marker-alt text-white text-xl"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">{{ $kota->nama_kota }}</h3>
                        </div>
                        <a href="{{ route('admin.kota.edit', $kota) }}"
                           class="inline-flex items-center px-3 py-2 bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white font-medium rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-0.5">
                            <i class="fas fa-edit"></i>
                        </a>
                    </div>
                </div>
                
                <!-- City Information -->
                <div class="p-6">
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 uppercase tracking-wide">Nama Kota</label>
                            <p class="text-2xl font-bold text-gray-900 mt-2">{{ $kota->nama_kota }}</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 uppercase tracking-wide">Total Hotel</label>
                            <div class="mt-2">
                                <span class="inline-flex items-center px-4 py-2 rounded-xl text-lg font-bold {{ $kota->hotels->count() > 0 ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-600' }}">
                                    <i class="fas fa-hotel mr-2"></i>
                                    {{ $kota->hotels->count() }} Hotel
                                </span>
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 uppercase tracking-wide">ID Kota</label>
                            <p class="text-lg font-mono text-gray-900 mt-2">#{{ $kota->id }}</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 uppercase tracking-wide">Dibuat</label>
                            <p class="text-lg text-gray-900 mt-2">{{ $kota->created_at->format('d M Y, H:i') }}</p>
                        </div>
                        
                        @if($kota->updated_at != $kota->created_at)
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 uppercase tracking-wide">Terakhir Diupdate</label>
                            <p class="text-lg text-gray-900 mt-2">{{ $kota->updated_at->format('d M Y, H:i') }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Hotels in This City -->
        <div class="lg:col-span-2">
            <div class="bg-white/70 backdrop-blur-xl rounded-2xl shadow-lg border border-white/20">
                <div class="p-6 border-b border-gray-200/50">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-hotel mr-3 text-amber-600"></i>
                        Hotel di {{ $kota->nama_kota }}
                    </h3>
                </div>
                <div class="p-6">
                    @if($kota->hotels && $kota->hotels->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($kota->hotels as $hotel)
                            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 hover:shadow-md transition-all duration-300">
                                <div class="flex items-start space-x-3">
                                    <div class="w-10 h-10 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-hotel text-white"></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h4 class="text-sm font-semibold text-gray-900 truncate">{{ $hotel->nama_hotel }}</h4>
                                        <p class="text-xs text-gray-500 mt-1">{{ $hotel->alamat }}</p>
                                        <div class="flex items-center space-x-2 mt-2">
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                                <i class="fas fa-bed mr-1"></i>
                                                {{ $hotel->kamars->count() }} kamar
                                            </span>
                                            @if($hotel->reviews_avg_rating)
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800">
                                                <i class="fas fa-star mr-1"></i>
                                                {{ number_format($hotel->reviews_avg_rating, 1) }}
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <i class="fas fa-hotel text-6xl text-gray-300 mb-4"></i>
                            <h4 class="text-lg font-semibold text-gray-900 mb-2">Belum ada hotel</h4>
                            <p class="text-gray-500 mb-6">Kota ini belum memiliki hotel yang terdaftar.</p>
                            <a href="{{ route('admin.hotel.create') }}" 
                               class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white font-medium rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-0.5">
                                <i class="fas fa-plus mr-2"></i>
                                Tambah Hotel
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection