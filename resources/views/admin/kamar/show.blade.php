@extends('layouts.admin')

@section('title', 'Detail Kamar')

@section('breadcrumb')
    <li class="inline-flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-indigo-600 transition-colors">Dashboard</a>
    </li>
    <li class="inline-flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <a href="{{ route('admin.kamar.index') }}" class="text-gray-500 hover:text-indigo-600 transition-colors">Kelola Kamar</a>
    </li>
    <li class="inline-flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <span class="text-gray-500">Detail Kamar</span>
    </li>
@endsection

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Room Details -->
        <div class="lg:col-span-2">
            <div class="bg-white/70 backdrop-blur-xl rounded-2xl shadow-lg border border-white/20">
                <!-- Header -->
                <div class="p-6 border-b border-gray-200/50">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center">
                                <i class="fas fa-bed text-white"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">Detail Kamar</h3>
                        </div>
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('admin.kamar.edit', $kamar->id_kamar) }}" 
                               class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white font-medium rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-0.5">
                                <i class="fas fa-edit mr-2"></i>
                                Edit
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Room Information -->
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-600 uppercase tracking-wide">Hotel</label>
                                <p class="text-lg font-semibold text-gray-900 mt-1">{{ $kamar->hotel->nama_hotel }}</p>
                                <p class="text-sm text-gray-500">{{ $kamar->hotel->kota->nama_kota }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-semibold text-gray-600 uppercase tracking-wide">Tipe Kamar</label>
                                <div class="mt-1">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                        {{ ucfirst($kamar->detailKamar->tipe_kamar) }}
                                    </span>
                                </div>
                                <p class="text-sm text-gray-500 mt-1">Kapasitas: {{ $kamar->detailKamar->kapasitas }} orang</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-semibold text-gray-600 uppercase tracking-wide">Harga per Malam</label>
                                <p class="text-2xl font-bold text-green-600 mt-1">
                                    Rp {{ number_format($kamar->harga_per_malam, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-600 uppercase tracking-wide">Lantai</label>
                                <p class="text-lg font-semibold text-gray-900 mt-1">Lantai {{ $kamar->lantai }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-semibold text-gray-600 uppercase tracking-wide">Status</label>
                                <div class="mt-1">
                                    @if($kamar->status == 'tersedia')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-check mr-2"></i>Tersedia
                                        </span>
                                    @elseif($kamar->status == 'dibooked')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                            <i class="fas fa-calendar-check mr-2"></i>Dibooked
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                            <i class="fas fa-tools mr-2"></i>Maintenance
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-semibold text-gray-600 uppercase tracking-wide">ID Kamar</label>
                                <p class="text-lg font-mono text-gray-900 mt-1">#{{ $kamar->id_kamar }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reservations History -->
        <div class="lg:col-span-1">
            <div class="bg-white/70 backdrop-blur-xl rounded-2xl shadow-lg border border-white/20">
                <div class="p-6 border-b border-gray-200/50">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-history mr-3 text-indigo-600"></i>
                        Riwayat Reservasi
                    </h3>
                </div>
                <div class="p-6">
                    @if($kamar->reservasis->count() > 0)
                        <div class="space-y-4">
                            @foreach($kamar->reservasis->take(5) as $reservasi)
                            <div class="flex items-start space-x-3 p-3 bg-gray-50/50 rounded-xl">
                                <div class="w-8 h-8 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full flex items-center justify-center flex-shrink-0">
                                    <span class="text-white text-xs font-semibold">{{ substr($reservasi->user->name, 0, 1) }}</span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900">{{ $reservasi->user->name }}</p>
                                    <p class="text-xs text-gray-500">
                                        {{ $reservasi->check_in->format('d M Y') }} - {{ $reservasi->check_out->format('d M Y') }}
                                    </p>
                                    <div class="mt-1">
                                        @if($reservasi->status == 'pending')
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800">
                                                Pending
                                            </span>
                                        @elseif($reservasi->status == 'dikonfirmasi')
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                                                Dikonfirmasi
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                                Selesai
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        
                        @if($kamar->reservasis->count() > 5)
                        <div class="mt-4 text-center">
                            <p class="text-sm text-gray-500">Dan {{ $kamar->reservasis->count() - 5 }} reservasi lainnya</p>
                        </div>
                        @endif
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
</div>
@endsection