@extends('layouts.admin')

@section('title', 'Kelola Hotel Images')

@section('breadcrumb')
    <li class="inline-flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-indigo-600 transition-colors">Dashboard</a>
    </li>
    <li class="inline-flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <span class="text-gray-500">Kelola Hotel Images</span>
    </li>
@endsection

@section('content')
<div class="bg-white/70 backdrop-blur-xl rounded-2xl shadow-lg border border-white/20">
    <!-- Header -->
    <div class="p-6 border-b border-gray-200/50 flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center">
                <i class="fas fa-images text-white"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900">Daftar Hotel Images</h3>
        </div>
        <a href="{{ route('admin.hotel-images.create') }}" 
           class="mt-4 sm:mt-0 inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white font-medium rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-0.5">
            <i class="fas fa-plus mr-2"></i>
            Tambah Hotel Image
        </a>
    </div>
    
    <!-- Search -->
    <div class="p-6 border-b border-gray-200/50">
        <div class="relative max-w-md">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-search text-gray-40"></i>
            </div>
            <input type="text" id="searchHotelImage" 
                   class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200" 
                   placeholder="Cari hotel image...">
        </div>
    </div>
    
    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200" id="hotelImageTable">
            <thead class="bg-gray-50/50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Hotel</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Image</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Created At</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($hotelImages as $hotelImage)
                <tr class="hover:bg-gray-50/50 transition-colors duration-200">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div>
                            <div class="text-sm font-medium text-gray-900">{{ $hotelImage->hotel->nama_hotel }}</div>
                            <div class="text-sm text-gray-500">{{ $hotelImage->hotel->kota->nama_kota }}</div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="relative">
                                <img src="{{ $hotelImage->image_url }}" onerror="this.src='data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNiIgaGVpZ2h0PSIxNiIgdmlld0JveD0iMCAwIDI0IDI0IiBmaWxsPSJub25lIiBzdHJva2U9IiNjY2NjY2MiIHN0cm9rZS13aWR0aD0iMiIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIj48cGF0aCBkPSJNOSA5SDYuNUE0LjUgNC41IDAgMCAwIDIgNC41VjZoMTJ2MS41YTQuNSA0LjUgMCAwIDAgNC41IDQuNUgxMXYuNSI+PC9wYXRoPjxwYXRoIGQ9Ik0xNiAxNnYxLjVhNC41IDQuNSAwIDAgMS00LjUgNC41SDEyYTQuNSA0LjUgMCAwIDEtNC41LTQuNVYxNiI+PC9wYXRoPjxwYXRoIGQ9Ik04IDE2di0xLjVhNC41IDQuNSAwIDAgMSA0LjUtNC41SDE2YTQuNSA0LjUgMCAwIDEgNC41IDQuNVYxNk04IDEyaDgiPjwvcGF0aD48L3N2Zz4='; this.onerror=null;" alt="Hotel Image" class="h-16 w-16 object-cover rounded-lg">
                                <div class="absolute bottom-0 right-0">
                                    @if(filter_var($hotelImage->image_url, FILTER_VALIDATE_URL))
                                        <span class="inline-flex items-center justify-center h-5 w-5 rounded-full bg-blue-500 text-white text-xs">
                                            <i class="fas fa-link"></i>
                                        </span>
                                    @else
                                        <span class="inline-flex items-center justify-center h-5 w-5 rounded-full bg-green-500 text-white text-xs">
                                            <i class="fas fa-file"></i>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $hotelImage->created_at->format('d M Y') }}</div>
                        <div class="text-sm text-gray-500">{{ $hotelImage->created_at->format('H:i') }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('admin.hotel-images.show', $hotelImage->image_id) }}" 
                               class="inline-flex items-center px-3 py-1.5 bg-blue-100 hover:bg-blue-200 text-blue-700 rounded-lg transition-colors duration-200"
                               title="View">
                                <i class="fas fa-eye text-xs"></i>
                            </a>
                            <a href="{{ route('admin.hotel-images.edit', $hotelImage->image_id) }}" 
                               class="inline-flex items-center px-3 py-1.5 bg-amber-100 hover:bg-amber-200 text-amber-700 rounded-lg transition-colors duration-200"
                               title="Edit">
                                <i class="fas fa-edit text-xs"></i>
                            </a>
                            <form action="{{ route('admin.hotel-images.destroy', $hotelImage->image_id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="inline-flex items-center px-3 py-1.5 bg-red-100 hover:bg-red-200 text-red-700 rounded-lg transition-colors duration-200"
                                        title="Delete"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus hotel image ini?')">
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
    @if($hotelImages->hasPages())
    <div class="px-6 py-4 border-t border-gray-200/50 flex items-center justify-between">
        <div class="text-sm text-gray-700">
            Showing {{ $hotelImages->firstItem() }} to {{ $hotelImages->lastItem() }} of {{ $hotelImages->total() }} results
        </div>
        <div class="flex items-center space-x-2">
            {{ $hotelImages->links('pagination::tailwind') }}
        </div>
    </div>
    @endif
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search functionality
    const searchInput = document.getElementById('searchHotelImage');
    const tableRows = document.querySelectorAll('#hotelImageTable tbody tr');
    
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