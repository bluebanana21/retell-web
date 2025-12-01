@extends('layouts.resepsionis-modern')

@section('title', 'Dashboard Resepsionis')

@section('breadcrumb')
    <li class="flex items-center text-gray-500">
        <i class="fas fa-chevron-right text-xs mx-2"></i>
        <span>Dashboard</span>
    </li>
@endsection

@section('content')
<!-- Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Reservations -->
    <div class="stat-card bg-white p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium">Total Reservasi</p>
                <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ $stats['total_reservations'] }}</h3>
            </div>
            <div class="bg-blue-100 p-3 rounded-xl">
                <i class="fas fa-calendar-check text-blue-600 text-xl"></i>
            </div>
        </div>
        <div class="mt-4 pt-4 border-t border-gray-100">
            <p class="text-xs text-gray-500 flex items-center">
                <i class="fas fa-info-circle mr-1"></i>
                Semua reservasi yang pernah dibuat
            </p>
        </div>
    </div>
    
    <!-- Today Check-ins -->
    <div class="stat-card bg-white p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium">Check-in Hari Ini</p>
                <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ $stats['today_checkin'] }}</h3>
            </div>
            <div class="bg-red-100 p-3 rounded-xl">
                <i class="fas fa-sign-in-alt text-red-600 text-xl"></i>
            </div>
        </div>
        <div class="mt-4 pt-4 border-t border-gray-100">
            <p class="text-xs text-gray-500 flex items-center">
                <i class="fas fa-info-circle mr-1"></i>
                Tamu yang akan check-in hari ini
            </p>
        </div>
    </div>
    
    <!-- Today Check-outs -->
    <div class="stat-card bg-white p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium">Check-out Hari Ini</p>
                <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ $stats['today_checkout'] }}</h3>
            </div>
            <div class="bg-green-100 p-3 rounded-xl">
                <i class="fas fa-sign-out-alt text-green-600 text-xl"></i>
            </div>
        </div>
        <div class="mt-4 pt-4 border-t border-gray-100">
            <p class="text-xs text-gray-500 flex items-center">
                <i class="fas fa-info-circle mr-1"></i>
                Tamu yang akan check-out hari ini
            </p>
        </div>
    </div>
    
    <!-- Pending Reservations -->
    <div class="stat-card bg-white p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium">Pending</p>
                <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ $stats['pending_reservations'] }}</h3>
            </div>
            <div class="bg-yellow-100 p-3 rounded-xl">
                <i class="fas fa-clock text-yellow-600 text-xl"></i>
            </div>
        </div>
        <div class="mt-4 pt-4 border-t border-gray-100">
            <p class="text-xs text-gray-500 flex items-center">
                <i class="fas fa-info-circle mr-1"></i>
                Reservasi menunggu konfirmasi
            </p>
        </div>
    </div>
</div>

<!-- Today's Check-ins -->
<div class="card bg-white">
    <div class="px-6 py-5 border-b border-gray-100">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <h3 class="text-lg font-bold text-gray-900 flex items-center">
                <i class="fas fa-calendar-day mr-2 text-indigo-600"></i>
                Check-in Hari Ini
            </h3>
            <div class="mt-3 md:mt-0">
                <a href="{{ route('resepsionis.reservations.index') }}" class="btn-primary inline-flex items-center text-white">
                    <i class="fas fa-list mr-2 text-white"></i>
                    Lihat Semua Reservasi
                </a>
            </div>
        </div>
    </div>
    
    <div class="p-0">
        @if($todayReservations->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tamu</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hotel</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe Kamar</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Check-in</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Check-out</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($todayReservations as $reservation)
                        <tr class="hover:bg-gray-50 transition-colors">
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
                                <div class="text-sm text-gray-500 mt-1">{{ $reservation->kamar->detailKamar->kapasitas }} orang</div>
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

                                <a href="{{ route('resepsionis.reservations.show', $reservation->id_reservasi) }}" class="text-indigo-600 hover:text-indigo-900">
                                    <button class="btn-primary px-3 py-2 text-sm text-white">
                                        <i class="fas fa-eye mr-1 text-white"></i>Detail
                                    </button>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-12">
                <i class="fas fa-calendar-times fa-3x text-gray-300 mb-4"></i>
                <h3 class="text-lg font-medium text-gray-900 mb-1">Tidak ada check-in hari ini</h3>
                <p class="text-gray-500 max-w-md mx-auto">Semua tamu sudah check-in atau belum ada reservasi untuk hari ini</p>
            </div>
        @endif
    </div>
</div>
@endsection