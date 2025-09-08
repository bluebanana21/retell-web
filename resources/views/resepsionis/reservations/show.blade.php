@extends('layouts.resepsionis-modern')

@section('title', 'Detail Reservasi')

@section('breadcrumb')
    <li class="flex items-center text-gray-500">
        <i class="fas fa-chevron-right text-xs mx-2"></i>
        <a href="{{ route('resepsionis.dashboard') }}" class="text-indigo-600 hover:text-indigo-800">Dashboard</a>
    </li>
    <li class="flex items-center text-gray-500">
        <i class="fas fa-chevron-right text-xs mx-2"></i>
        <a href="{{ route('resepsionis.reservations.index') }}" class="text-indigo-600 hover:text-indigo-800">Kelola Reservasi</a>
    </li>
    <li class="flex items-center text-gray-500">
        <i class="fas fa-chevron-right text-xs mx-2"></i>
        <span>Detail Reservasi</span>
    </li>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Reservation Details -->
    <div class="lg:col-span-2">
        <div class="card bg-white">
            <div class="px-6 py-5 border-b border-gray-100">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <h3 class="text-lg font-bold text-gray-900 flex items-center">
                        <i class="fas fa-receipt mr-2 text-indigo-600"></i>
                        Detail Reservasi
                    </h3>
                    <div class="mt-3 md:mt-0">
                        @if($reservasi->status == 'pending')
                            <span class="badge bg-yellow-100 text-yellow-800">
                                <i class="fas fa-clock mr-1"></i>Pending
                            </span>
                        @elseif($reservasi->status == 'dikonfirmasi')
                            <span class="badge bg-green-100 text-green-800">
                                <i class="fas fa-check mr-1"></i>Dikonfirmasi
                            </span>
                        @else
                            <span class="badge bg-blue-100 text-blue-800">
                                <i class="fas fa-check-double mr-1"></i>Selesai
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h4 class="text-sm font-medium text-gray-500 mb-1">ID Reservasi</h4>
                        <p class="text-lg font-medium text-gray-900">{{ $reservasi->id_reservasi }}</p>
                    </div>
                    
                    <div>
                        <h4 class="text-sm font-medium text-gray-500 mb-1">Tanggal Reservasi</h4>
                        <p class="text-lg font-medium text-gray-900">{{ $reservasi->created_at->format('d M Y H:i') }}</p>
                    </div>
                    
                    <div>
                        <h4 class="text-sm font-medium text-gray-500 mb-1">Check-in</h4>
                        <p class="text-lg font-medium text-gray-900">{{ $reservasi->check_in->format('d M Y') }}</p>
                        <p class="text-gray-500">{{ $reservasi->check_in->format('H:i') }}</p>
                    </div>
                    
                    <div>
                        <h4 class="text-sm font-medium text-gray-500 mb-1">Check-out</h4>
                        <p class="text-lg font-medium text-gray-900">{{ $reservasi->check_out->format('d M Y') }}</p>
                        <p class="text-gray-500">{{ $reservasi->check_out->format('H:i') }}</p>
                    </div>
                    
                    <div>
                        <h4 class="text-sm font-medium text-gray-500 mb-1">Durasi</h4>
                        <p class="text-lg font-medium text-gray-900">{{ $reservasi->durasi }} malam</p>
                    </div>
                    
                    <div>
                        <h4 class="text-sm font-medium text-gray-500 mb-1">Jumlah Tamu</h4>
                        <p class="text-lg font-medium text-gray-900">{{ $reservasi->jumlah_tamu }} orang</p>
                    </div>
                </div>
                
                <div class="mt-8">
                    <h4 class="text-sm font-medium text-gray-500 mb-3">Permintaan Khusus</h4>
                    @if($reservasi->permintaan_khusus)
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-gray-700">{{ $reservasi->permintaan_khusus }}</p>
                        </div>
                    @else
                        <p class="text-gray-500 italic">Tidak ada permintaan khusus</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <!-- Guest & Room Info -->
    <div class="space-y-6">
        <!-- Guest Info -->
        <div class="card bg-white">
            <div class="px-6 py-5 border-b border-gray-100">
                <h3 class="text-lg font-bold text-gray-900 flex items-center">
                    <i class="fas fa-user mr-2 text-indigo-600"></i>
                    Informasi Tamu
                </h3>
            </div>
            
            <div class="p-6">
                <div class="flex items-center mb-4">
                    <div class="avatar bg-indigo-500">
                        {{ substr($reservasi->user->name, 0, 1) }}
                    </div>
                    <div class="ml-4">
                        <h4 class="text-lg font-medium text-gray-900">{{ $reservasi->user->name }}</h4>
                        <p class="text-gray-500">{{ $reservasi->user->email }}</p>
                    </div>
                </div>
                
                <div class="space-y-3">
                    <div>
                        <h4 class="text-sm font-medium text-gray-500 mb-1">Nomor Telepon</h4>
                        <p class="text-gray-900">{{ $reservasi->user->no_telp ?? '-' }}</p>
                    </div>
                    
                    <div>
                        <h4 class="text-sm font-medium text-gray-500 mb-1">Alamat</h4>
                        <p class="text-gray-900">{{ $reservasi->user->alamat ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Room Info -->
        <div class="card bg-white">
            <div class="px-6 py-5 border-b border-gray-100">
                <h3 class="text-lg font-bold text-gray-900 flex items-center">
                    <i class="fas fa-bed mr-2 text-indigo-600"></i>
                    Informasi Kamar
                </h3>
            </div>
            
            <div class="p-6">
                <div class="mb-4">
                    <img src="{{ $reservasi->kamar->foto_kamar ? asset('storage/'.$reservasi->kamar->foto_kamar) : 'https://placehold.co/300x200?text=Kamar+Hotel' }}" alt="Foto Kamar" class="w-full h-40 object-cover rounded-lg">
                </div>
                
                <div class="space-y-3">
                    <div>
                        <h4 class="text-sm font-medium text-gray-500 mb-1">Hotel</h4>
                        <p class="text-lg font-medium text-gray-900">{{ $reservasi->kamar->hotel->nama_hotel }}</p>
                        <p class="text-gray-500">{{ $reservasi->kamar->hotel->kota->nama_kota }}</p>
                    </div>
                    
                    <div>
                        <h4 class="text-sm font-medium text-gray-500 mb-1">Tipe Kamar</h4>
                        <p class="text-gray-900">
                            <span class="badge bg-indigo-100 text-indigo-800">
                                {{ ucfirst($reservasi->kamar->detailKamar->tipe_kamar) }}
                            </span>
                        </p>
                    </div>
                    
                    <div>
                        <h4 class="text-sm font-medium text-gray-500 mb-1">Nomor Kamar</h4>
                        <p class="text-gray-900">{{ $reservasi->kamar->nomor_kamar }}</p>
                    </div>
                    
                    <div>
                        <h4 class="text-sm font-medium text-gray-500 mb-1">Lantai</h4>
                        <p class="text-gray-900">{{ $reservasi->kamar->lantai }}</p>
                    </div>
                    
                    <div>
                        <h4 class="text-sm font-medium text-gray-500 mb-1">Harga per Malam</h4>
                        <p class="text-lg font-medium text-gray-900">Rp {{ number_format($reservasi->kamar->harga, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Action Buttons -->
<div class="card bg-white mt-6">
    <div class="px-6 py-5 border-b border-gray-100">
        <h3 class="text-lg font-bold text-gray-900 flex items-center">
            <i class="fas fa-cogs mr-2 text-indigo-600"></i>
            Aksi
        </h3>
    </div>
    
    <div class="p-6">
        <div class="flex flex-wrap gap-3">
            @if($reservasi->status == 'pending')
                <form action="{{ route('resepsionis.reservations.update.status', $reservasi->id_reservasi) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="dikonfirmasi">
                    <button type="submit" class="btn-primary px-4 py-2" onclick="return confirm('Konfirmasi reservasi ini?')">
                        <i class="fas fa-check mr-2"></i>Konfirmasi Reservasi
                    </button>
                </form>
            @endif
            
            @if($reservasi->status == 'dikonfirmasi')
                <form action="{{ route('resepsionis.reservations.checkin', $reservasi->id_reservasi) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg font-medium transition-colors" onclick="return confirm('Proses check-in untuk tamu ini?')">
                        <i class="fas fa-sign-in-alt mr-2"></i>Check-in Tamu
                    </button>
                </form>
            @endif
            
            @if($reservasi->status == 'selesai')
                <button class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg font-medium cursor-not-allowed" disabled>
                    <i class="fas fa-check-circle mr-2"></i>Reservasi Selesai
                </button>
            @endif
            
            <a href="{{ route('resepsionis.reservations.index') }}" class="border border-gray-300 text-gray-700 hover:bg-gray-50 px-4 py-2 rounded-lg font-medium transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>
    </div>
</div>
@endsection