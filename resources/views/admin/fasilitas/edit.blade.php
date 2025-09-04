@extends('layouts.admin')

@section('title', 'Edit Fasilitas')

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
        <span class="text-gray-500">Edit Fasilitas</span>
    </li>
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white/70 backdrop-blur-xl rounded-2xl shadow-lg border border-white/20">
        <!-- Header -->
        <div class="p-6 border-b border-gray-200/50">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-gradient-to-r from-amber-500 to-orange-600 rounded-xl flex items-center justify-center">
                    <i class="fas fa-edit text-white"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900">Edit Fasilitas</h3>
            </div>
        </div>
        
        <!-- Form -->
        <form action="{{ route('admin.fasilitas.update', $fasilitas) }}" method="POST" class="p-6">
            @csrf
            @method('PUT')
            
            <div class="space-y-6">
                <!-- Facility Name -->
                <div class="space-y-2">
                    <label for="nama_fasilitas" class="block text-sm font-semibold text-gray-700">Nama Fasilitas</label>
                    <input type="text" name="nama_fasilitas" id="nama_fasilitas" 
                           value="{{ old('nama_fasilitas') ?? $fasilitas->nama_fasilitas }}"
                           class="block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition-all duration-200 @error('nama_fasilitas') border-red-500 @enderror"
                           placeholder="Contoh: WiFi Gratis, Kolam Renang, Gym">
                    @error('nama_fasilitas')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Icon Selection -->
                <div class="space-y-2">
                    <label for="icon" class="block text-sm font-semibold text-gray-700">Icon (Font Awesome Class)</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-icons text-gray-400"></i>
                        </div>
                        <input type="text" name="icon" id="icon" 
                               value="{{ old('icon') ?? $fasilitas->icon }}"
                               class="block w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition-all duration-200 @error('icon') border-red-500 @enderror"
                               placeholder="fas fa-wifi">
                    </div>
                    <p class="text-xs text-gray-500">Contoh: fas fa-wifi, fas fa-swimming-pool, fas fa-dumbbell</p>
                    @error('icon')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Icon Preview -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">Preview Icon</label>
                    <div class="flex items-center space-x-4 p-4 bg-gray-50 rounded-xl">
                        <div class="w-12 h-12 bg-gradient-to-r from-cyan-500 to-blue-600 rounded-xl flex items-center justify-center" id="iconPreview">
                            <i class="{{ $fasilitas->icon ?? 'fas fa-star' }} text-white text-lg" id="previewIcon"></i>
                        </div>
                        <p class="text-sm text-gray-600">Icon akan muncul seperti ini</p>
                    </div>
                </div>

                <!-- Common Icons -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">Icon Populer</label>
                    <div class="grid grid-cols-4 md:grid-cols-8 gap-3">
                        <button type="button" class="icon-btn p-3 bg-gray-100 hover:bg-cyan-100 rounded-xl transition-colors duration-200" data-icon="fas fa-wifi">
                            <i class="fas fa-wifi text-gray-600"></i>
                        </button>
                        <button type="button" class="icon-btn p-3 bg-gray-100 hover:bg-cyan-100 rounded-xl transition-colors duration-200" data-icon="fas fa-swimming-pool">
                            <i class="fas fa-swimming-pool text-gray-600"></i>
                        </button>
                        <button type="button" class="icon-btn p-3 bg-gray-100 hover:bg-cyan-100 rounded-xl transition-colors duration-200" data-icon="fas fa-dumbbell">
                            <i class="fas fa-dumbbell text-gray-600"></i>
                        </button>
                        <button type="button" class="icon-btn p-3 bg-gray-100 hover:bg-cyan-100 rounded-xl transition-colors duration-200" data-icon="fas fa-car">
                            <i class="fas fa-car text-gray-600"></i>
                        </button>
                        <button type="button" class="icon-btn p-3 bg-gray-100 hover:bg-cyan-100 rounded-xl transition-colors duration-200" data-icon="fas fa-utensils">
                            <i class="fas fa-utensils text-gray-600"></i>
                        </button>
                        <button type="button" class="icon-btn p-3 bg-gray-100 hover:bg-cyan-100 rounded-xl transition-colors duration-200" data-icon="fas fa-spa">
                            <i class="fas fa-spa text-gray-600"></i>
                        </button>
                        <button type="button" class="icon-btn p-3 bg-gray-100 hover:bg-cyan-100 rounded-xl transition-colors duration-200" data-icon="fas fa-coffee">
                            <i class="fas fa-coffee text-gray-600"></i>
                        </button>
                        <button type="button" class="icon-btn p-3 bg-gray-100 hover:bg-cyan-100 rounded-xl transition-colors duration-200" data-icon="fas fa-tv">
                            <i class="fas fa-tv text-gray-600"></i>
                        </button>
                    </div>
                </div>

                <!-- Description -->
                <div class="space-y-2">
                    <label for="deskripsi" class="block text-sm font-semibold text-gray-700">Deskripsi (Opsional)</label>
                    <textarea name="deskripsi" id="deskripsi" rows="4"
                              class="block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition-all duration-200 @error('deskripsi') border-red-500 @enderror"
                              placeholder="Deskripsi singkat tentang fasilitas ini...">{{ old('deskripsi') ?? $fasilitas->deskripsi }}</textarea>
                    @error('deskripsi')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end space-x-4 mt-8 pt-6 border-t border-gray-200/50">
                <a href="{{ route('admin.fasilitas.index') }}" 
                   class="inline-flex items-center px-6 py-3 border border-gray-300 shadow-sm text-sm font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 transition-all duration-200">
                    <i class="fas fa-times mr-2"></i>
                    Batal
                </a>
                <button type="submit" 
                        class="inline-flex items-center px-6 py-3 border border-transparent text-sm font-medium rounded-xl shadow-sm text-white bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 transition-all duration-300 hover:-translate-y-0.5 hover:shadow-lg">
                    <i class="fas fa-save mr-2"></i>
                    Update Fasilitas
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const iconInput = document.getElementById('icon');
    const previewIcon = document.getElementById('previewIcon');
    const iconButtons = document.querySelectorAll('.icon-btn');
    
    // Update icon preview
    function updateIconPreview(iconClass) {
        if (iconClass) {
            previewIcon.className = iconClass + ' text-white text-lg';
        } else {
            previewIcon.className = 'fas fa-star text-white text-lg';
        }
    }
    
    // Icon input change
    iconInput.addEventListener('input', function() {
        updateIconPreview(this.value);
    });
    
    // Icon button clicks
    iconButtons.forEach(button => {
        button.addEventListener('click', function() {
            const iconClass = this.dataset.icon;
            iconInput.value = iconClass;
            updateIconPreview(iconClass);
            
            // Remove active class from all buttons
            iconButtons.forEach(btn => btn.classList.remove('bg-cyan-200'));
            // Add active class to clicked button
            this.classList.add('bg-cyan-200');
        });
    });
    
    // Initial preview
    updateIconPreview(iconInput.value);
});
</script>
@endpush
@endsection