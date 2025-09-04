@extends('layouts.admin')

@section('title', 'Tambah Kota')

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
        <span class="text-gray-500">Tambah Kota</span>
    </li>
@endsection

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white/70 backdrop-blur-xl rounded-2xl shadow-lg border border-white/20">
        <!-- Header -->
        <div class="p-6 border-b border-gray-200/50">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-gradient-to-r from-amber-500 to-orange-600 rounded-xl flex items-center justify-center">
                    <i class="fas fa-plus text-white"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900">Tambah Kota Baru</h3>
            </div>
        </div>
        
        <!-- Form -->
        <form action="{{ route('admin.kota.store') }}" method="POST" class="p-6">
            @csrf
            
            <div class="space-y-6">
                <!-- City Name -->
                <div class="space-y-2">
                    <label for="nama_kota" class="block text-sm font-semibold text-gray-700">Nama Kota</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-map-marker-alt text-gray-400"></i>
                        </div>
                        <input type="text" name="nama_kota" id="nama_kota" 
                               value="{{ old('nama_kota') }}"
                               class="block w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all duration-200 @error('nama_kota') border-red-500 @enderror"
                               placeholder="Contoh: Jakarta, Bandung, Surabaya">
                    </div>
                    @error('nama_kota')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Popular Cities -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">Kota Populer</label>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                        <button type="button" class="city-btn p-3 bg-gray-100 hover:bg-amber-100 rounded-xl transition-colors duration-200 text-left" data-city="Jakarta">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-building text-gray-600"></i>
                                <span class="text-sm font-medium text-gray-700">Jakarta</span>
                            </div>
                        </button>
                        <button type="button" class="city-btn p-3 bg-gray-100 hover:bg-amber-100 rounded-xl transition-colors duration-200 text-left" data-city="Bandung">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-mountain text-gray-600"></i>
                                <span class="text-sm font-medium text-gray-700">Bandung</span>
                            </div>
                        </button>
                        <button type="button" class="city-btn p-3 bg-gray-100 hover:bg-amber-100 rounded-xl transition-colors duration-200 text-left" data-city="Surabaya">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-ship text-gray-600"></i>
                                <span class="text-sm font-medium text-gray-700">Surabaya</span>
                            </div>
                        </button>
                        <button type="button" class="city-btn p-3 bg-gray-100 hover:bg-amber-100 rounded-xl transition-colors duration-200 text-left" data-city="Yogyakarta">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-landmark text-gray-600"></i>
                                <span class="text-sm font-medium text-gray-700">Yogyakarta</span>
                            </div>
                        </button>
                        <button type="button" class="city-btn p-3 bg-gray-100 hover:bg-amber-100 rounded-xl transition-colors duration-200 text-left" data-city="Bali">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-umbrella-beach text-gray-600"></i>
                                <span class="text-sm font-medium text-gray-700">Bali</span>
                            </div>
                        </button>
                        <button type="button" class="city-btn p-3 bg-gray-100 hover:bg-amber-100 rounded-xl transition-colors duration-200 text-left" data-city="Medan">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-city text-gray-600"></i>
                                <span class="text-sm font-medium text-gray-700">Medan</span>
                            </div>
                        </button>
                    </div>
                    <p class="text-xs text-gray-500 mt-2">Klik untuk mengisi nama kota secara otomatis</p>
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
                    Simpan Kota
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const cityInput = document.getElementById('nama_kota');
    const cityButtons = document.querySelectorAll('.city-btn');
    
    // City button clicks
    cityButtons.forEach(button => {
        button.addEventListener('click', function() {
            const cityName = this.dataset.city;
            cityInput.value = cityName;
            
            // Remove active class from all buttons
            cityButtons.forEach(btn => btn.classList.remove('bg-amber-200'));
            // Add active class to clicked button
            this.classList.add('bg-amber-200');
        });
    });
});
</script>
@endpush
@endsection