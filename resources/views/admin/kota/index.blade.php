@extends('layouts.admin')

@section('title', 'Kelola Kota')

@section('breadcrumb')
    <li class="inline-flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-indigo-600 transition-colors">Dashboard</a>
    </li>
    <li class="inline-flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <span class="text-gray-500">Kelola Kota</span>
    </li>
@endsection

@section('content')
<div class="bg-white/70 backdrop-blur-xl rounded-2xl shadow-lg border border-white/20">
    <!-- Header -->
    <div class="p-6 border-b border-gray-200/50 flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-gradient-to-r from-amber-500 to-orange-600 rounded-xl flex items-center justify-center">
                <i class="fas fa-map-marker-alt text-white"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900">Daftar Kota</h3>
        </div>
        <a href="{{ route('admin.kota.create') }}" 
           class="mt-4 sm:mt-0 inline-flex items-center px-4 py-2 bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white font-medium rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-0.5">
            <i class="fas fa-plus mr-2"></i>
            Tambah Kota
        </a>
    </div>
    
    <!-- Search -->
    <div class="p-6 border-b border-gray-200/50">
        <div class="relative max-w-md">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-search text-gray-400"></i>
            </div>
            <input type="text" id="searchKota" 
                   class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all duration-200" 
                   placeholder="Cari kota...">
        </div>
    </div>
    
    <!-- Grid View -->
    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="kotaGrid">
            @foreach($kotas as $kota)
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                <div class="p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-gradient-to-r from-amber-500 to-orange-600 rounded-xl flex items-center justify-center">
                                <i class="fas fa-map-marker-alt text-white text-lg"></i>
                            </div>
                            <div>
                                <h4 class="text-lg font-semibold text-gray-900">{{ $kota->nama_kota }}</h4>
                                <p class="text-sm text-gray-500">{{ $kota->hotels_count }} hotel</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Hotel Count Badge -->
                    <div class="mb-4">
                        @if($kota->hotels_count > 0)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                <i class="fas fa-hotel mr-1"></i>
                                {{ $kota->hotels_count }} Hotel
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-600">
                                <i class="fas fa-hotel mr-1"></i>
                                Belum ada hotel
                            </span>
                        @endif
                    </div>
                    
                    <!-- Actions -->
                    <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('admin.kota.show', $kota) }}"
                               class="inline-flex items-center px-3 py-1.5 bg-blue-100 hover:bg-blue-200 text-blue-700 rounded-lg transition-colors duration-200"
                               title="View">
                                <i class="fas fa-eye text-xs"></i>
                            </a>
                            <a href="{{ route('admin.kota.edit', $kota) }}"
                               class="inline-flex items-center px-3 py-1.5 bg-amber-100 hover:bg-amber-200 text-amber-700 rounded-lg transition-colors duration-200"
                               title="Edit">
                                <i class="fas fa-edit text-xs"></i>
                            </a>
                        </div>
                        
                        @if($kota->hotels_count == 0)
                        <form action="{{ route('admin.kota.destroy', $kota) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="inline-flex items-center px-3 py-1.5 bg-red-100 hover:bg-red-200 text-red-700 rounded-lg transition-colors duration-200"
                                    title="Delete"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus kota ini?')">
                                <i class="fas fa-trash text-xs"></i>
                            </button>
                        </form>
                        @else
                        <span class="inline-flex items-center px-3 py-1.5 bg-gray-100 text-gray-500 rounded-lg text-xs" title="Tidak dapat dihapus karena masih memiliki hotel">
                            <i class="fas fa-lock"></i>
                        </span>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <!-- Empty State -->
        @if($kotas->count() == 0)
        <div class="text-center py-12">
            <i class="fas fa-map-marker-alt text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum ada kota</h3>
            <p class="text-gray-500 mb-6">Mulai dengan menambahkan kota pertama untuk hotel Anda.</p>
            <a href="{{ route('admin.kota.create') }}" 
               class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white font-medium rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-0.5">
                <i class="fas fa-plus mr-2"></i>
                Tambah Kota
            </a>
        </div>
        @endif
    </div>
    
    <!-- Pagination -->
    @if($kotas->hasPages())
    <div class="px-6 py-4 border-t border-gray-200/50 flex items-center justify-between">
        <div class="text-sm text-gray-700">
            Showing {{ $kotas->firstItem() }} to {{ $kotas->lastItem() }} of {{ $kotas->total() }} results
        </div>
        <div class="flex items-center space-x-2">
            {{ $kotas->links('pagination::tailwind') }}
        </div>
    </div>
    @endif
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search functionality
    const searchInput = document.getElementById('searchKota');
    const gridItems = document.querySelectorAll('#kotaGrid > div');
    
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