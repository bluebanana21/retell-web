@extends('layouts.resepsionis')

@section('title', 'Resepsionis Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
<!-- Info boxes -->
<div class="row">
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-calendar-check"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total Reservasi</span>
                <span class="info-box-number">{{ $stats['total_reservations'] }}</span>
            </div>
        </div>
    </div>
    
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-sign-in-alt"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Check-in Hari Ini</span>
                <span class="info-box-number">{{ $stats['today_checkin'] }}</span>
            </div>
        </div>
    </div>
    
    <div class="clearfix hidden-md-up"></div>
    
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-sign-out-alt"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Check-out Hari Ini</span>
                <span class="info-box-number">{{ $stats['today_checkout'] }}</span>
            </div>
        </div>
    </div>
    
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-clock"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Pending</span>
                <span class="info-box-number">{{ $stats['pending_reservations'] }}</span>
            </div>
        </div>
    </div>
</div>

<!-- Main row -->
<div class="row">
    <!-- Check-in Hari Ini -->
    <section class="col-lg-12 connectedSortable">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-calendar-day mr-1"></i>
                    Check-in Hari Ini
                </h3>
                <div class="card-tools">
                    <a href="{{ route('resepsionis.reservations.index') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-list mr-1"></i>
                        Lihat Semua Reservasi
                    </a>
                </div>
            </div>
            <div class="card-body p-0">
                @if($todayReservations->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Tamu</th>
                                    <th>Hotel</th>
                                    <th>Tipe Kamar</th>
                                    <th>Check-in</th>
                                    <th>Check-out</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($todayReservations as $reservation)
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
                                            <small class="text-muted">{{ $reservation->kamar->detailKamar->kapasitas }} orang</small>
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
                                        <a href="{{ route('resepsionis.reservations.show', $reservation->id_reservasi) }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-eye mr-1"></i>Detail
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-calendar-times fa-4x text-muted mb-3"></i>
                        <h5 class="text-muted">Tidak ada check-in hari ini</h5>
                        <p class="text-muted">Semua tamu sudah check-in atau belum ada reservasi untuk hari ini</p>
                    </div>
                @endif
            </div>
        </div>
    </section>
</div>
@endsection