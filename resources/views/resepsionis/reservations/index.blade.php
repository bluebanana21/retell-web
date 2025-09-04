@extends('layouts.resepsionis')

@section('title', 'Kelola Reservasi')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('resepsionis.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Kelola Reservasi</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-calendar-check mr-1"></i>
            Daftar Reservasi
        </h3>
        <div class="card-tools">
            <!-- Filter Form -->
            <form method="GET" class="d-flex align-items-center">
                <div class="input-group input-group-sm me-2" style="width: 150px;">
                    <input type="date" name="check_in_date" value="{{ request('check_in_date') }}" class="form-control" placeholder="Filter tanggal">
                </div>
                <div class="input-group input-group-sm me-2" style="width: 120px;">
                    <select name="status" class="form-control">
                        <option value="">All Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="dikonfirmasi" {{ request('status') == 'dikonfirmasi' ? 'selected' : '' }}>Dikonfirmasi</option>
                        <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="fas fa-filter"></i>
                </button>
            </form>
        </div>
    </div>
    
    <div class="card-body">
        <!-- Search -->
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" id="searchReservasi" class="form-control" placeholder="Cari berdasarkan nama tamu...">
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <i class="fas fa-search"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="reservasiTable">
                <thead>
                    <tr>
                        <th>Tamu</th>
                        <th>Hotel</th>
                        <th>Kamar</th>
                        <th>Check-in</th>
                        <th>Check-out</th>
                        <th>Status</th>
                        <th width="200">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservations as $reservation)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; font-weight: bold;">
                                    {{ substr($reservation->user->name, 0, 1) }}
                                </div>
                                <div>
                                    <strong>{{ $reservation->user->name }}</strong>
                                    <br>
                                    <small class="text-muted">{{ $reservation->user->email }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div>
                                <strong>{{ $reservation->kamar->hotel->nama_hotel }}</strong>
                                <br>
                                <small class="text-muted">{{ $reservation->kamar->hotel->kota->nama_kota }}</small>
                            </div>
                        </td>
                        <td>
                            <div>
                                <span class="badge badge-info">{{ ucfirst($reservation->kamar->detailKamar->tipe_kamar) }}</span>
                                <br>
                                <small class="text-muted">Lantai {{ $reservation->kamar->lantai }}</small>
                            </div>
                        </td>
                        <td>
                            <strong>{{ $reservation->check_in->format('d M Y') }}</strong>
                            <br>
                            <small class="text-muted">{{ $reservation->check_in->format('H:i') }}</small>
                        </td>
                        <td>
                            <strong>{{ $reservation->check_out->format('d M Y') }}</strong>
                            <br>
                            <small class="text-muted">{{ $reservation->check_out->format('H:i') }}</small>
                        </td>
                        <td>
                            @if($reservation->status == 'pending')
                                <span class="badge badge-warning">
                                    <i class="fas fa-clock mr-1"></i>Pending
                                </span>
                            @elseif($reservation->status == 'dikonfirmasi')
                                <span class="badge badge-success">
                                    <i class="fas fa-check mr-1"></i>Dikonfirmasi
                                </span>
                            @else
                                <span class="badge badge-primary">
                                    <i class="fas fa-check-double mr-1"></i>Selesai
                                </span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('resepsionis.reservations.show', $reservation->id_reservasi) }}" class="btn btn-info btn-sm" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                
                                @if($reservation->status == 'pending')
                                <form action="{{ route('resepsionis.reservations.update.status', $reservation->id_reservasi) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="dikonfirmasi">
                                    <button type="submit" class="btn btn-success btn-sm" title="Konfirmasi" onclick="return confirm('Konfirmasi reservasi ini?')">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </form>
                                @endif
                                
                                @if($reservation->status == 'dikonfirmasi')
                                <form action="{{ route('resepsionis.reservations.checkin', $reservation->id_reservasi) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-sm" title="Check-in" onclick="return confirm('Proses check-in untuk tamu ini?')">
                                        <i class="fas fa-sign-in-alt"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="d-flex justify-content-between align-items-center mt-3">
            <div class="text-muted">
                Showing {{ $reservations->firstItem() }} to {{ $reservations->lastItem() }} of {{ $reservations->total() }} results
            </div>
            {{ $reservations->links() }}
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Search functionality
    $('#searchReservasi').on('keyup', function() {
        var value = $(this).val().toLowerCase();
        $('#reservasiTable tbody tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
    
    // Initialize tooltips
    $('[title]').tooltip();
});
</script>
@endpush