@extends('layouts.admin')

@section('title', 'Kelola Fasilitas')

@section('breadcrumb')
    <li class="inline-flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-indigo-600 transition-colors">Dashboard</a>
    </li>
    <li class="inline-flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <span class="text-gray-500">Kelola Fasilitas</span>
    </li>
@endsection

@section('content')
<div class="bg-white/70 backdrop-blur-xl rounded-2xl shadow-lg border border-white/20">
    <!-- Header -->
    <div class="p-6 border-b border-gray-200/50 flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-gradient-to-r from-cyan-500 to-blue-600 rounded-xl flex items-center justify-center">
                <i class="fas fa-concierge-bell text-white"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900">Daftar Fasilitas</h3>
        </div>
        <a href="{{ route('admin.fasilitas.create') }}" 
           class="mt-4 sm:mt-0 inline-flex items-center px-4 py-2 bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white font-medium rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-0.5">
            <i class="fas fa-plus mr-2"></i>
            Tambah Fasilitas
        </a>
    </div>
    
    <!-- Search -->
    <div class="p-6 border-b border-gray-200/50">
        <div class="relative max-w-md">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-search text-gray-400"></i>
            </div>
            <input type="text" id="searchFasilitas" 
                   class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition-all duration-200" 
                   placeholder="Cari fasilitas...">
        </div>
    </div>
    
    <!-- Grid View -->
    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="fasilitasGrid">
            @foreach($fasilitas as $item)
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                <div class="p-6">
                    <div class="flex items-start justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-gradient-to-r from-cyan-500 to-blue-600 rounded-xl flex items-center justify-center">
                                @if($item->icon)
                                    <i class="{{ $item->icon }} text-white text-lg"></i>
                                @else
                                    <i class="fas fa-star text-white text-lg"></i>
                                @endif
                            </div>
                            <div>
                                <h4 class="text-lg font-semibold text-gray-900">{{ $item->nama_fasilitas }}</h4>
                                @if($item->deskripsi)
                                    <p class="text-sm text-gray-500 mt-1">{{ Str::limit($item->deskripsi, 50) }}</p>
                                @endif
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-1">
                            <a href="{{ route('admin.fasilitas.show', $item) }}"
                               class="inline-flex items-center p-2 bg-blue-100 hover:bg-blue-200 text-blue-700 rounded-lg transition-colors duration-200"
                               title="View">
                                <i class="fas fa-eye text-xs"></i>
                            </a>
                            <a href="{{ route('admin.fasilitas.edit', $item) }}"
                               class="inline-flex items-center p-2 bg-amber-100 hover:bg-amber-200 text-amber-700 rounded-lg transition-colors duration-200"
                               title="Edit">
                                <i class="fas fa-edit text-xs"></i>
                            </a>
                            <form action="{{ route('admin.fasilitas.destroy', $item) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="inline-flex items-center p-2 bg-red-100 hover:bg-red-200 text-red-700 rounded-lg transition-colors duration-200"
                                        title="Delete"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus fasilitas ini?')">
                                    <i class="fas fa-trash text-xs"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    
                    @if($item->hotels && $item->hotels->count() > 0)
                        <div class="mt-4 pt-4 border-t border-gray-200">
                            <p class="text-xs text-gray-500 uppercase tracking-wide font-semibold">Digunakan di:</p>
                            <div class="flex flex-wrap gap-1 mt-2">
                                @foreach($item->hotels->take(3) as $hotel)
                                    <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-gray-100 text-gray-700">
                                        {{ $hotel->nama_hotel }}
                                    </span>
                                @endforeach
                                @if($item->hotels->count() > 3)
                                    <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-gray-100 text-gray-700">
                                        +{{ $item->hotels->count() - 3 }} lainnya
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        
        <!-- Empty State -->
        @if($fasilitas->count() == 0)
        <div class="text-center py-12">
            <i class="fas fa-concierge-bell text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum ada fasilitas</h3>
            <p class="text-gray-500 mb-6">Mulai dengan menambahkan fasilitas pertama untuk hotel Anda.</p>
            <a href="{{ route('admin.fasilitas.create') }}" 
               class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white font-medium rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-0.5">
                <i class="fas fa-plus mr-2"></i>
                Tambah Fasilitas
            </a>
        </div>
        @endif
    </div>
    
    <!-- Pagination -->
    @if($fasilitas->hasPages())
    <div class="px-6 py-4 border-t border-gray-200/50 flex items-center justify-between">
        <div class="text-sm text-gray-700">
            Showing {{ $fasilitas->firstItem() }} to {{ $fasilitas->lastItem() }} of {{ $fasilitas->total() }} results
        </div>
        <div class="flex items-center space-x-2">
            {{ $fasilitas->links('pagination::tailwind') }}
        </div>
    </div>
    @endif
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search functionality
    const searchInput = document.getElementById('searchFasilitas');
    const gridItems = document.querySelectorAll('#fasilitasGrid > div');
    
    searchInput.addEventListener('keyup', function() {
        const searchValue = this.value.toLowerCase();
        
        gridItems.forEach(item => {
            const text = item.textContent.toLowerCase();
            item.style.display = text.includes(searchValue) ? '' : 'none';
        });
    });
});
</script>
@endpush
@endsection