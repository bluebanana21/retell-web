@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('breadcrumb')
    <li class="inline-flex items-center">
        <i class="fas fa-chevron-right text-base-content/30 mx-2"></i>
        <span class="text-base-content/70">Dashboard</span>
    </li>
@endsection

@section('content')
<!-- Filters -->
<div class="card bg-base-100 shadow-sm mb-6 border border-base-200 rounded-xl">
    <div class="card-body py-4">
        <form method="GET" action="{{ route('admin.dashboard') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
            <div>
                <label class="label">
                    <span class="label-text font-medium text-base-content/80">Dari Tanggal</span>
                </label>
                <input type="date" name="from" value="{{ request('from', $from ?? '') }}" class="input input-bordered w-full modern-input rounded-lg" />
            </div>
            <div>
                <label class="label">
                    <span class="label-text font-medium text-base-content/80">Sampai Tanggal</span>
                </label>
                <input type="date" name="to" value="{{ request('to', $to ?? '') }}" class="input input-bordered w-full modern-input rounded-lg" />
            </div>
            <div class="md:col-span-2 flex gap-3">
                <button class="btn btn-primary modern-btn rounded-lg">
                    <i class="fa fa-filter mr-2"></i> Terapkan
                </button>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-ghost modern-btn rounded-lg">Reset</a>
            </div>
        </form>
    </div>
</div>
<!-- Statistics (modern) -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
    <div class="card bg-base-100 border border-base-200 rounded-xl shadow-sm hover:shadow transition-all duration-300">
        <div class="card-body p-5">
            <div class="flex items-center gap-4">
                <span class="w-12 h-12 rounded-xl bg-primary/10 text-primary inline-flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-hotel text-xl"></i>
                </span>
                <div>
                    <p class="text-sm text-base-content/70">Total Hotel</p>
                    <p class="text-2xl font-bold text-primary mt-1">{{ $stats['total_hotels'] }}</p>
                </div>
            </div>
            <p class="text-xs text-base-content/50 mt-3">Terdaftar dalam sistem</p>
        </div>
    </div>

    <div class="card bg-base-100 border border-base-200 rounded-xl shadow-sm hover:shadow transition-all duration-300">
        <div class="card-body p-5">
            <div class="flex items-center gap-4">
                <span class="w-12 h-12 rounded-xl bg-success/10 text-success inline-flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-bed text-xl"></i>
                </span>
                <div>
                    <p class="text-sm text-base-content/70">Total Kamar</p>
                    <p class="text-2xl font-bold mt-1">{{ $stats['total_rooms'] }}</p>
                </div>
            </div>
            <p class="text-xs text-success mt-3">{{ $stats['available_rooms'] }} tersedia</p>
        </div>
    </div>

    <div class="card bg-base-100 border border-base-200 rounded-xl shadow-sm hover:shadow transition-all duration-300">
        <div class="card-body p-5">
            <div class="flex items-center gap-4">
                <span class="w-12 h-12 rounded-xl bg-secondary/10 text-secondary inline-flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-calendar-check text-xl"></i>
                </span>
                <div>
                    <p class="text-sm text-base-content/70">Total Reservasi</p>
                    <p class="text-2xl font-bold mt-1">{{ $stats['total_reservations'] }}</p>
                </div>
            </div>
            <p class="text-xs text-base-content/50 mt-3">Akurat hingga hari ini</p>
        </div>
    </div>

    <div class="card bg-base-100 border border-base-200 rounded-xl shadow-sm hover:shadow transition-all duration-300">
        <div class="card-body p-5">
            <div class="flex items-center gap-4">
                <span class="w-12 h-12 rounded-xl bg-accent/10 text-accent inline-flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-users text-xl"></i>
                </span>
                <div>
                    <p class="text-sm text-base-content/70">Total Tamu</p>
                    <p class="text-2xl font-bold mt-1">{{ $stats['total_users'] }}</p>
                </div>
            </div>
            <p class="text-xs text-base-content/50 mt-3">Pengguna terdaftar</p>
        </div>
    </div>

    <div class="card bg-base-100 border border-base-200 rounded-xl shadow-sm hover:shadow transition-all duration-300">
        <div class="card-body p-5">
            <div class="flex items-center gap-4">
                <span class="w-12 h-12 rounded-xl bg-warning/10 text-warning inline-flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-coins text-xl"></i>
                </span>
                <div>
                    <p class="text-sm text-base-content/70">Total Pendapatan</p>
                    <p class="text-2xl font-bold mt-1">Rp {{ number_format($revenue_total ?? 0, 0, ',', '.') }}</p>
                </div>
            </div>
            <p class="text-xs text-base-content/50 mt-3">Dalam rentang tanggal</p>
        </div>
    </div>
</div>

<!-- Trend Chart -->
<div class="grid grid-cols-1 gap-6 mb-8">
    <div class="card bg-base-100 shadow-sm rounded-xl border border-base-200">
        <div class="card-body p-0">
            <div class="p-5 border-b border-base-200">
                <h3 class="text-lg font-semibold text-base-content flex items-center">
                    <i class="fas fa-chart-line mr-3 text-primary"></i>
                    Tren Reservasi & Pendapatan
                </h3>
                <p class="text-xs text-base-content/60 mt-1">{{ request('from', $from ?? '') }} - {{ request('to', $to ?? '') }}</p>
            </div>
            <div class="p-5">
                <canvas id="reservationsRevenueChart" height="100"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Room Status and Recent Reservations -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    <!-- Room Status -->
    <div class="lg:col-span-2">
        <div class="card bg-base-100 shadow-sm rounded-xl border border-base-200">
            <div class="card-body p-0">
                <div class="p-5 border-b border-base-200">
                    <h3 class="text-lg font-semibold text-base-content flex items-center">
                        <i class="fas fa-chart-pie mr-3 text-primary"></i>
                        Status Kamar
                    </h3>
                </div>
                <div class="p-5">
                    @php
                        $occupancy = ($stats['total_rooms'] ?? 0) > 0 ? round(($stats['booked_rooms'] / $stats['total_rooms']) * 100) : 0;
                    @endphp
                    <div class="mb-6 flex flex-col sm:flex-row items-center gap-4 p-4 rounded-xl border border-base-200 bg-base-100">
                        <div class="radial-progress text-primary" style="--value: {{ $occupancy }};" role="progressbar">{{ $occupancy }}%</div>
                        <div class="text-center sm:text-left">
                            <p class="text-sm text-base-content/70">Occupancy Rate</p>
                            <p class="text-lg font-semibold text-base-content">{{ $stats['booked_rooms'] }} / {{ $stats['total_rooms'] }} kamar terisi</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Available Rooms -->
                        <div class="card border border-success/20 bg-success/5 text-success shadow-sm hover:shadow transition-all duration-300">
                            <div class="card-body p-5">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium uppercase tracking-wide text-base-content/70">Tersedia</p>
                                        <p class="text-3xl font-bold mt-2">{{ $stats['available_rooms'] }}</p>
                                    </div>
                                    <span class="w-10 h-10 rounded-lg bg-success/10 text-success inline-flex items-center justify-center">
                                        <i class="fas fa-check-circle"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Booked Rooms -->
                        <div class="card border border-primary/20 bg-primary/5 text-primary shadow-sm hover:shadow transition-all duration-300">
                            <div class="card-body p-5">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium uppercase tracking-wide text-base-content/70">Dibooked</p>
                                        <p class="text-3xl font-bold mt-2">{{ $stats['booked_rooms'] }}</p>
                                    </div>
                                    <span class="w-10 h-10 rounded-lg bg-primary/10 text-primary inline-flex items-center justify-center">
                                        <i class="fas fa-calendar-times"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Maintenance Rooms -->
                        <div class="card border border-warning/20 bg-warning/5 text-warning shadow-sm hover:shadow transition-all duration-300">
                            <div class="card-body p-5">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium uppercase tracking-wide text-base-content/70">Maintenance</p>
                                        <p class="text-3xl font-bold mt-2">{{ $stats['maintenance_rooms'] }}</p>
                                    </div>
                                    <span class="w-10 h-10 rounded-lg bg-warning/10 text-warning inline-flex items-center justify-center">
                                        <i class="fas fa-tools"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Reservations -->
    <div class="lg:col-span-1">
        <div class="card bg-base-100 shadow-sm rounded-xl border border-base-200 h-full">
            <div class="card-body p-0">
                <div class="p-5 border-b border-base-200 flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-base-content flex items-center">
                        <i class="fas fa-clock mr-3 text-primary"></i>
                        Reservasi Terbaru
                    </h3>
                    <a href="{{ route('resepsionis.reservations.index') }}" 
                       class="text-sm text-primary hover:text-primary-focus font-medium transition-colors">
                        Lihat Semua
                    </a>
                </div>
                <div class="p-5">
                    @if($recent_reservations->count() > 0)
                        <div class="space-y-3">
                            @foreach($recent_reservations as $reservation)
                            <div class="flex items-center gap-3 p-3 rounded-lg border border-base-200 hover:bg-base-200/30 transition-colors">
                                <div class="flex-shrink-0">
                                    <div class="bg-primary/10 text-primary rounded-full w-10 h-10 flex items-center justify-center">
                                        <span class="text-sm font-semibold">{{ substr($reservation->user->name, 0, 1) }}</span>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-base-content truncate">{{ $reservation->user->name }}</p>
                                    <p class="text-xs text-base-content/70 truncate">{{ $reservation->kamar->hotel->nama_hotel }}</p>
                                    <p class="text-xs text-base-content/50">{{ $reservation->created_at->diffForHumans() }}</p>
                                </div>
                                <div class="flex items-center gap-2 flex-shrink-0">
                                    @if($reservation->status == 'pending')
                                        <span class="badge badge-sm badge-warning">
                                            Pending
                                        </span>
                                    @elseif($reservation->status == 'dikonfirmasi')
                                        <span class="badge badge-sm badge-success">
                                            Dikonfirmasi
                                        </span>
                                    @else
                                        <span class="badge badge-sm badge-info">
                                            Selesai
                                        </span>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <i class="fas fa-calendar-times text-3xl text-base-content/30 mb-3"></i>
                            <p class="text-base-content/70 text-sm">Belum ada reservasi</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Top Lists -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <!-- Top Hotels -->
    <div class="card bg-base-100 shadow-sm rounded-xl border border-base-200">
        <div class="card-body p-0">
            <div class="p-5 border-b border-base-200">
                <h3 class="text-lg font-semibold text-base-content flex items-center">
                    <i class="fas fa-hotel mr-3 text-primary"></i>
                    Top Hotel (Reservasi)
                </h3>
            </div>
            <div class="p-0">
                @if(!empty($top_hotels) && count($top_hotels))
                    <ul class="divide-y divide-base-200">
                        @foreach($top_hotels as $hotel)
                        <li class="p-4 flex items-center justify-between hover:bg-base-200/30 transition-colors">
                            <span class="text-sm font-medium">{{ $hotel->nama_hotel }}</span>
                            <span class="badge badge-primary badge-sm">{{ $hotel->total }}</span>
                        </li>
                        @endforeach
                    </ul>
                @else
                    <div class="p-8 text-center text-base-content/60">
                        <i class="fas fa-hotel text-2xl mb-2"></i>
                        <p class="text-sm">Tidak ada data</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Top Cities -->
    <div class="card bg-base-100 shadow-sm rounded-xl border border-base-200">
        <div class="card-body p-0">
            <div class="p-5 border-b border-base-200">
                <h3 class="text-lg font-semibold text-base-content flex items-center">
                    <i class="fas fa-city mr-3 text-secondary"></i>
                    Top Kota (Reservasi)
                </h3>
            </div>
            <div class="p-0">
                @if(!empty($top_cities) && count($top_cities))
                    <ul class="divide-y divide-base-200">
                        @foreach($top_cities as $city)
                        <li class="p-4 flex items-center justify-between hover:bg-base-200/30 transition-colors">
                            <span class="text-sm font-medium">{{ $city->nama_kota }}</span>
                            <span class="badge badge-secondary badge-sm">{{ $city->total }}</span>
                        </li>
                        @endforeach
                    </ul>
                @else
                    <div class="p-8 text-center text-base-content/60">
                        <i class="fas fa-city text-2xl mb-2"></i>
                        <p class="text-sm">Tidak ada data</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="card bg-base-100 shadow-sm rounded-xl border border-base-200">
    <div class="card-body p-0">
        <div class="p-5 border-b border-base-200">
            <h3 class="text-lg font-semibold text-base-content flex items-center">
                <i class="fas fa-bolt mr-3 text-primary"></i>
                Quick Actions
            </h3>
        </div>
        <div class="p-5">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <a href="{{ route('admin.kamar.create') }}" class="group modern-card p-4 flex items-center gap-4 rounded-lg border border-base-200 hover:border-primary/30 hover:shadow-sm transition-all">
                    <span class="w-10 h-10 rounded-lg bg-success/10 text-success flex items-center justify-center">
                        <i class="fas fa-plus-circle"></i>
                    </span>
                    <span class="text-left">
                        <p class="font-medium">Tambah Kamar</p>
                        <p class="text-xs text-base-content/70">Buat kamar baru</p>
                    </span>
                </a>

                <a href="{{ route('admin.fasilitas.create') }}" class="group modern-card p-4 flex items-center gap-4 rounded-lg border border-base-200 hover:border-info/30 hover:shadow-sm transition-all">
                    <span class="w-10 h-10 rounded-lg bg-info/10 text-info flex items-center justify-center">
                        <i class="fas fa-concierge-bell"></i>
                    </span>
                    <span class="text-left">
                        <p class="font-medium">Tambah Fasilitas</p>
                        <p class="text-xs text-base-content/70">Tambahkan fasilitas hotel</p>
                    </span>
                </a>

                <a href="{{ route('admin.kota.create') }}" class="group modern-card p-4 flex items-center gap-4 rounded-lg border border-base-200 hover:border-warning/30 hover:shadow-sm transition-all">
                    <span class="w-10 h-10 rounded-lg bg-warning/10 text-warning flex items-center justify-center">
                        <i class="fas fa-map-marker-alt"></i>
                    </span>
                    <span class="text-left">
                        <p class="font-medium">Tambah Kota</p>
                        <p class="text-xs text-base-content/70">Kelola daftar kota</p>
                    </span>
                </a>

                <a href="{{ route('resepsionis.reservations.index') }}" class="group modern-card p-4 flex items-center gap-4 rounded-lg border border-base-200 hover:border-primary/30 hover:shadow-sm transition-all">
                    <span class="w-10 h-10 rounded-lg bg-primary/10 text-primary flex items-center justify-center">
                        <i class="fas fa-list"></i>
                    </span>
                    <span class="text-left">
                        <p class="font-medium">Lihat Reservasi</p>
                        <p class="text-xs text-base-content/70">Pantau reservasi terbaru</p>
                    </span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>
<script>
    (function() {
        const el = document.getElementById('reservationsRevenueChart');
        if (!el) return;
        const data = @json($charts ?? ['labels'=>[], 'reservations'=>[], 'revenue'=>[]]);
        const fmtCurrency = (n) => new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(n);
        new Chart(el, {
            type: 'line',
            data: {
                labels: data.labels,
                datasets: [
                    {
                        label: 'Reservasi',
                        data: data.reservations,
                        borderColor: '#3b82f6',
                        backgroundColor: 'rgba(59,130,246,0.15)',
                        tension: 0.3,
                        yAxisID: 'y',
                    },
                    {
                        label: 'Pendapatan',
                        data: data.revenue,
                        borderColor: '#10b981',
                        backgroundColor: 'rgba(16,185,129,0.15)',
                        tension: 0.3,
                        yAxisID: 'y1',
                    }
                ]
            },
            options: {
                responsive: true,
                interaction: { mode: 'index', intersect: false },
                stacked: false,
                scales: {
                    y: {
                        type: 'linear',
                        position: 'left',
                        ticks: { precision: 0 }
                    },
                    y1: {
                        type: 'linear',
                        position: 'right',
                        grid: { drawOnChartArea: false },
                        ticks: { callback: (v) => fmtCurrency(v) }
                    }
                },
                plugins: {
                    tooltip: { callbacks: { label: (ctx) => ctx.dataset.label + ': ' + (ctx.dataset.yAxisID === 'y1' ? fmtCurrency(ctx.raw) : ctx.raw) } }
                }
            }
        });
    })();
</script>
@endpush
