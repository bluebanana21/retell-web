@extends('layouts.resepsionis-modern')

@section('title', 'Kelola Reservasi')

@section('breadcrumb')
    <li class="flex items-center text-gray-500">
        <i class="fas fa-chevron-right text-xs mx-2"></i>
        <a href="{{ route('resepsionis.dashboard') }}" class="text-indigo-600 hover:text-indigo-800">Dashboard</a>
    </li>
    <li class="flex items-center text-gray-500">
        <i class="fas fa-chevron-right text-xs mx-2"></i>
        <span>Kelola Reservasi</span>
    </li>
@endsection

@section('content')
<div class="card bg-white">
    <div class="px-6 py-5 border-b border-gray-100">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <h3 class="text-lg font-bold text-gray-900 flex items-center">
                <i class="fas fa-calendar-check mr-2 text-indigo-600"></i>
                Daftar Reservasi
            </h3>
            <div class="mt-3 md:mt-0">
                <!-- Filter Form -->
                <form method="GET" class="flex flex-col md:flex-row md:items-center space-y-2 md:space-y-0 md:space-x-3">
                    <div>
                        <input type="date" name="check_in_date" value="{{ request('check_in_date') }}" class="search-input w-full md:w-40">
                    </div>
                    <div>
                        <select name="status" class="search-input w-full md:w-36">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="dikonfirmasi" {{ request('status') == 'dikonfirmasi' ? 'selected' : '' }}>Dikonfirmasi</option>
                            <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>
                    <button type="submit" class="btn-primary px-4 py-2.5">
                        <i class="fas fa-filter mr-1"></i>Filter
                    </button>
                </form>
            </div>
        </div>
    </div>
    
    <div class="p-6">
        <!-- Search -->
        <div class="mb-6">
            <div class="max-w-md">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" id="searchReservasi" class="search-input w-full pl-10" placeholder="Cari berdasarkan nama tamu...">
                </div>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200" id="reservasiTable">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tamu</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hotel</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kamar</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Check-in</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Check-out</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($reservations as $reservation)
                    <tr class="hover:bg-gray-50 transition-colors reservasi-row">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="avatar bg-indigo-500">
                                    {{ substr($reservation->user->name, 0, 1) }}
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $reservation->user->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $reservation->user->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $reservation->kamar->hotel->nama_hotel }}</div>
                            <div class="text-sm text-gray-500">{{ $reservation->kamar->hotel->kota->nama_kota }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="badge bg-indigo-100 text-indigo-800">
                                {{ ucfirst($reservation->kamar->detailKamar->tipe_kamar) }}
                            </span>
                            <div class="text-sm text-gray-500 mt-1">Lantai {{ $reservation->kamar->lantai }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $reservation->check_in->format('d M Y') }}</div>
                            <div class="text-sm text-gray-500">{{ $reservation->check_in->format('H:i') }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $reservation->check_out->format('d M Y') }}</div>
                            <div class="text-sm text-gray-500">{{ $reservation->check_out->format('H:i') }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($reservation->status == 'pending')
                                <span class="badge bg-yellow-100 text-yellow-800">
                                    <i class="fas fa-clock mr-1"></i>Pending
                                </span>
                            @elseif($reservation->status == 'dikonfirmasi')
                                <span class="badge bg-green-100 text-green-800">
                                    <i class="fas fa-check mr-1"></i>Dikonfirmasi
                                </span>
                            @else
                                <span class="badge bg-blue-100 text-blue-800">
                                    <i class="fas fa-check-double mr-1"></i>Selesai
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <a href="{{ route('resepsionis.reservations.show', $reservation->id_reservasi) }}" class="text-indigo-600 hover:text-indigo-900" title="Detail">
                                    <button class="btn-primary px-3 py-2 text-sm">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </a>
                                
                                @if($reservation->status == 'pending')
                                <form action="{{ route('resepsionis.reservations.update.status', $reservation->id_reservasi) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="dikonfirmasi">
                                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-2 rounded-lg text-sm transition-colors" title="Konfirmasi" onclick="return confirm('Konfirmasi reservasi ini?')">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </form>
                                @endif
                                
                                @if($reservation->status == 'dikonfirmasi')
                                <form action="{{ route('resepsionis.reservations.checkin', $reservation->id_reservasi) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-lg text-sm transition-colors" title="Check-in" onclick="return confirm('Proses check-in untuk tamu ini?')">
                                        <i class="fas fa-sign-in-alt"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center">
                            <i class="fas fa-calendar-times fa-3x text-gray-300 mb-4"></i>
                            <h3 class="text-lg font-medium text-gray-900 mb-1">Tidak ada reservasi</h3>
                            <p class="text-gray-500">Belum ada reservasi yang dibuat</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($reservations->hasPages())
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mt-6">
            <div class="text-sm text-gray-700 mb-4 md:mb-0">
                Menampilkan {{ $reservations->firstItem() }} sampai {{ $reservations->lastItem() }} dari {{ $reservations->total() }} hasil
            </div>
            <div>
                {{ $reservations->links() }}
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search functionality
    const searchInput = document.getElementById('searchReservasi');
    const tableRows = document.querySelectorAll('.reservasi-row');
    
    if (searchInput) {
        searchInput.addEventListener('keyup', function() {
            const value = this.value.toLowerCase();
            
            tableRows.forEach(function(row) {
                const rowText = row.textContent.toLowerCase();
                if (rowText.indexOf(value) > -1) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    }
});
</script>
@endpush