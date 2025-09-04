@extends('layouts.admin')

@section('title', 'Edit Kota')

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
        <span class="text-gray-500">Edit Kota</span>
    </li>
@endsection

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white/70 backdrop-blur-xl rounded-2xl shadow-lg border border-white/20">
        <!-- Header -->
        <div class="p-6 border-b border-gray-200/50">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-gradient-to-r from-amber-500 to-orange-600 rounded-xl flex items-center justify-center">
                    <i class="fas fa-edit text-white"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900">Edit Kota</h3>
            </div>
        </div>
        
        <!-- Form -->
        <form action="{{ route('admin.kota.update', $kota) }}" method="POST" class="p-6">
            @csrf
            @method('PUT')
            
            <div class="space-y-6">
                <!-- City Name -->
                <div class="space-y-2">
                    <label for="nama_kota" class="block text-sm font-semibold text-gray-700">Nama Kota</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-map-marker-alt text-gray-400"></i>
                        </div>
                        <input type="text" name="nama_kota" id="nama_kota" 
                               value="{{ old('nama_kota') ?? $kota->nama_kota }}"
                               class="block w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all duration-200 @error('nama_kota') border-red-500 @enderror"
                               placeholder="Contoh: Jakarta, Bandung, Surabaya">
                    </div>
                    @error('nama_kota')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Current Info -->
                <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center">
                            <i class="fas fa-info text-white text-sm"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-blue-900">Informasi Kota</h4>
                            <p class="text-sm text-blue-700 mt-1">
                                Kota ini saat ini memiliki <strong>{{ $kota->hotels->count() }} hotel</strong>
                                @if($kota->hotels->count() > 0)
                                    dan tidak dapat dihapus
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end space-x-4 mt-8 pt-6 border-t border-gray-200/50">
                <a href="{{ route('admin.kota.index') }}" 
                   class="inline-flex items-center px-6 py-3 border border-gray-300 shadow-sm text-sm font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition-all duration-200">
                    <i class="fas fa-times mr-2"></i>
                    Batal
                </a>
                <button type="submit" 
                        class="inline-flex items-center px-6 py-3 border border-transparent text-sm font-medium rounded-xl shadow-sm text-white bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition-all duration-300 hover:-translate-y-0.5 hover:shadow-lg">
                    <i class="fas fa-save mr-2"></i>
                    Update Kota
                </button>
            </div>
        </form>
    </div>
</div>
@endsection