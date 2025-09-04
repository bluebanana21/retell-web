@extends('layouts.admin')

@section('title', 'Detail Fasilitas')

@section('breadcrumb')
    <li class="inline-flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-indigo-600 transition-colors">Dashboard</a>
    </li>
    <li class="inline-flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <a href="{{ route('admin.fasilitas.index') }}" class="text-gray-500 hover:text-indigo-600 transition-colors">Kelola Fasilitas</a>
    </li>
    <li class="inline-flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <span class="text-gray-500">Detail Fasilitas</span>
    </li>
@endsection

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Facility Details -->
        <div class="lg:col-span-2">
            <div class="bg-white/70 backdrop-blur-xl rounded-2xl shadow-lg border border-white/20">
                <!-- Header -->
                <div class="p-6 border-b border-gray-200/50">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-gradient-to-r from-cyan-500 to-blue-600 rounded-xl flex items-center justify-center">
                                @if($fasilitas->icon)
                                    <i class="{{ $fasilitas->icon }} text-white text-xl"></i>
                                @else
                                    <i class="fas fa-star text-white text-xl"></i>
                                @endif
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">{{ $fasilitas->nama_fasilitas }}</h3>
                        </div>
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('admin.fasilitas.edit', $fasilitas) }}"
                               class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white font-medium rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-0.5">
                                <i class="fas fa-edit mr-2"></i>
                                Edit
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Facility Information -->
                <div class="p-6">
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 uppercase tracking-wide">Nama Fasilitas</label>
                            <p class="text-2xl font-bold text-gray-900 mt-2">{{ $fasilitas->nama_fasilitas }}</p>
                        </div>
                        
                        @if($fasilitas->deskripsi)
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 uppercase tracking-wide">Deskripsi</label>
                            <div class="mt-2 p-4 bg-gray-50 rounded-xl">
                                <p class="text-gray-700 leading-relaxed">{{ $fasilitas->deskripsi }}</p>
                            </div>
                        </div>
                        @endif
                        
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 uppercase tracking-wide">Icon Class</label>
                            <div class="mt-2 flex items-center space-x-3">
                                <code class="px-3 py-2 bg-gray-100 rounded-lg text-sm font-mono text-gray-800">
                                    {{ $fasilitas->icon ?? 'Tidak ada icon' }}
                                </code>
                                @if($fasilitas->icon)
                                    <div class="w-8 h-8 bg-gradient-to-r from-cyan-500 to-blue-600 rounded-lg flex items-center justify-center">
                                        <i class="{{ $fasilitas->icon }} text-white"></i>
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 uppercase tracking-wide">ID Fasilitas</label>
                            <p class="text-lg font-mono text-gray-900 mt-2">#{{ $fasilitas->id }}</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 uppercase tracking-wide">Dibuat</label>
                            <p class="text-lg text-gray-900 mt-2">{{ $fasilitas->created_at->format('d M Y, H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hotels Using This Facility -->
        <div class="lg:col-span-1">
            <div class="bg-white/70 backdrop-blur-xl rounded-2xl shadow-lg border border-white/20">
                <div class="p-6 border-b border-gray-200/50">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-hotel mr-3 text-cyan-600"></i>
                        Hotel yang Menggunakan
                    </h3>
                </div>
                <div class="p-6">
                    @if($fasilitas->hotels && $fasilitas->hotels->count() > 0)
                        <div class="space-y-3">
                            @foreach($fasilitas->hotels as $hotel)
                            <div class="flex items-center space-x-3 p-3 bg-gray-50/50 rounded-xl hover:bg-gray-100/50 transition-colors">
                                <div class="w-10 h-10 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-hotel text-white"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">{{ $hotel->nama_hotel }}</p>
                                    <p class="text-xs text-gray-500 truncate">{{ $hotel->kota->nama_kota }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <i class="fas fa-hotel text-4xl text-gray-300 mb-4"></i>
                            <p class="text-gray-500 font-medium">Belum digunakan di hotel manapun</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection