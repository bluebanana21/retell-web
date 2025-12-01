<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\Kamar;
use App\Models\Reservasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    public function dashboard(Request $request)
    {
        $stats = [
            'total_hotels' => Hotel::count(),
            'total_rooms' => Kamar::count(),
            'total_reservations' => Reservasi::count(),
            'total_users' => User::role('user')->count(),
            'available_rooms' => Kamar::where('status', 'tersedia')->count(),
            'booked_rooms' => Kamar::where('status', 'dibooked')->count(),
            'maintenance_rooms' => Kamar::where('status', 'maintenance')->count(),
        ];

        // Date range filters (defaults to last 30 days)
        $from = $request->query('from') ? Carbon::parse($request->query('from'))->startOfDay() : now()->subDays(30)->startOfDay();
        $to = $request->query('to') ? Carbon::parse($request->query('to'))->endOfDay() : now()->endOfDay();

        // Recent reservations (unchanged)
        $recent_reservations = Reservasi::with(['user', 'kamar.hotel'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Revenue (successful payments) within range
        $revenueTotal = DB::table('transaksis')
            ->where('status_pembayaran', 'success')
            ->whereBetween('tanggal_pembayaran', [$from, $to])
            ->sum('jumlah_pembayaran');

        // Reservations per day within range
        $reservationsByDay = DB::table('reservasis')
            ->selectRaw('CAST(created_at as date) as d, COUNT(*) as c')
            ->whereBetween('created_at', [$from, $to])
            ->groupBy('d')
            ->orderBy('d')
            ->get();

        // Revenue per day within range
        $revenueByDay = DB::table('transaksis')
            ->selectRaw('CAST(tanggal_pembayaran as date) as d, SUM(jumlah_pembayaran) as s')
            ->where('status_pembayaran', 'success')
            ->whereBetween('tanggal_pembayaran', [$from, $to])
            ->groupBy('d')
            ->orderBy('d')
            ->get();

        // Build continuous date labels and series
        $labels = [];
        $reservationsSeries = [];
        $revenueSeries = [];
        $cursor = $from->copy();
        $resMap = $reservationsByDay->pluck('c', 'd')->all();
        $revMap = $revenueByDay->pluck('s', 'd')->all();
        while ($cursor <= $to) {
            $key = $cursor->toDateString();
            $labels[] = $key;
            $reservationsSeries[] = (int)($resMap[$key] ?? 0);
            $revenueSeries[] = (int)($revMap[$key] ?? 0);
            $cursor->addDay();
        }

        // Top hotels by reservations in range
        $topHotels = DB::table('reservasis as r')
            ->join('kamars as k', 'k.id_kamar', '=', 'r.kamar_id')
            ->join('hotel as h', 'h.id', '=', 'k.id_hotel')
            ->select('h.nama_hotel', DB::raw('COUNT(r.id_reservasi) as total'))
            ->whereBetween('r.created_at', [$from, $to])
            ->groupBy('h.nama_hotel')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        // Top cities by reservations in range
        $topCities = DB::table('reservasis as r')
            ->join('kamars as k', 'k.id_kamar', '=', 'r.kamar_id')
            ->join('hotel as h', 'h.id', '=', 'k.id_hotel')
            ->join('kotas as c', 'c.id', '=', 'h.kota_id')
            ->select('c.nama_kota', DB::raw('COUNT(r.id_reservasi) as total'))
            ->whereBetween('r.created_at', [$from, $to])
            ->groupBy('c.nama_kota')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        $charts = [
            'labels' => $labels,
            'reservations' => $reservationsSeries,
            'revenue' => $revenueSeries,
        ];

        return view('admin.dashboard', [
            'stats' => $stats,
            'recent_reservations' => $recent_reservations,
            'from' => $from->toDateString(),
            'to' => $to->toDateString(),
            'revenue_total' => (int) $revenueTotal,
            'charts' => $charts,
            'top_hotels' => $topHotels,
            'top_cities' => $topCities,
        ]);
    }
}
