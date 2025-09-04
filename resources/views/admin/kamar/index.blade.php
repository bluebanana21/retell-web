@extends('layouts.admin')

@section('title', 'Kelola Kamar')

@section('breadcrumb')
    <li class="inline-flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-indigo-600 transition-colors">Dashboard</a>
    </li>
    <li class="inline-flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <span class="text-gray-500">Kelola Kamar</span>
    </li>
@endsection

@section('content')
<div class="bg-white/70 backdrop-blur-xl rounded-2xl shadow-lg border border-white/20">
    <!-- Header -->
    <div class="p-6 border-b border-gray-200/50 flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center">
                <i class="fas fa-bed text-white"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900">Daftar Kamar</h3>
        </div>
        <a href="{{ route('admin.kamar.create') }}" 
           class="mt-4 sm:mt-0 inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white font-medium rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-0.5">
            <i class="fas fa-plus mr-2"></i>
            Tambah Kamar
        </a>
    </div>
    
    <!-- Search -->
    <div class="p-6 border-b border-gray-200/50">
        <div class="relative max-w-md">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-search text-gray-400"></i>
            </div>
            <input type="text" id="searchKamar" 
                   class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200" 
                   placeholder="Cari kamar...">
        </div>
    </div>
    
    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200" id="kamarTable">
            <thead class="bg-gray-50/50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Hotel</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tipe Kamar</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Harga/Malam</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Lantai</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($kamars as $kamar)
                <tr class="hover:bg-gray-50/50 transition-colors duration-200">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div>
                            <div class="text-sm font-medium text-gray-900">{{ $kamar->hotel->nama_hotel }}</div>
                            <div class="text-sm text-gray-500">{{ $kamar->hotel->kota->nama_kota }}</div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ ucfirst($kamar->detailKamar->tipe_kamar) }}
                            </span>
                            <div class="text-sm text-gray-500 mt-1">{{ $kamar->detailKamar->kapasitas }} orang</div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-semibold text-green-600">
                            Rp {{ number_format($kamar->harga_per_malam, 0, ',', '.') }}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                            Lantai {{ $kamar->lantai }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($kamar->status == 'tersedia')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <i class="fas fa-check mr-1"></i>Tersedia
                            </span>
                        @elseif($kamar->status == 'dibooked')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                <i class="fas fa-calendar-check mr-1"></i>Dibooked
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                <i class="fas fa-tools mr-1"></i>Maintenance
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('admin.kamar.show', $kamar->id_kamar) }}" 
                               class="inline-flex items-center px-3 py-1.5 bg-blue-100 hover:bg-blue-200 text-blue-700 rounded-lg transition-colors duration-200"
                               title="View">
                                <i class="fas fa-eye text-xs"></i>
                            </a>
                            <a href="{{ route('admin.kamar.edit', $kamar->id_kamar) }}" 
                               class="inline-flex items-center px-3 py-1.5 bg-amber-100 hover:bg-amber-200 text-amber-700 rounded-lg transition-colors duration-200"
                               title="Edit">
                                <i class="fas fa-edit text-xs"></i>
                            </a>
                            <form action="{{ route('admin.kamar.destroy', $kamar->id_kamar) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="inline-flex items-center px-3 py-1.5 bg-red-100 hover:bg-red-200 text-red-700 rounded-lg transition-colors duration-200"
                                        title="Delete"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus kamar ini?')">
                                    <i class="fas fa-trash text-xs"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    @if($kamars->hasPages())
    <div class="px-6 py-4 border-t border-gray-200/50 flex items-center justify-between">
        <div class="text-sm text-gray-700">
            Showing {{ $kamars->firstItem() }} to {{ $kamars->lastItem() }} of {{ $kamars->total() }} results
        </div>
        <div class="flex items-center space-x-2">
            {{ $kamars->links('pagination::tailwind') }}
        </div>
    </div>
    @endif
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search functionality
    const searchInput = document.getElementById('searchKamar');
    const tableRows = document.querySelectorAll('#kamarTable tbody tr');
    
    searchInput.addEventListener('keyup', function() {
        const searchValue = this.value.toLowerCase();
        
        tableRows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchValue) ? '' : 'none';
        });
    });
});
</script>
@endpush
@endsection