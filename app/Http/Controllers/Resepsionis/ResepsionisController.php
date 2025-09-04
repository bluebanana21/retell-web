<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use App\Models\Reservasi;
use App\Models\Kamar;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ResepsionisController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:resepsionis']);
    }

    public function dashboard()
    {
        $today = Carbon::today();
        
        $stats = [
            'total_reservations' => Reservasi::count(),
            'today_checkin' => Reservasi::whereDate('check_in', $today)->count(),
            'today_checkout' => Reservasi::whereDate('check_out', $today)->count(),
            'pending_reservations' => Reservasi::where('status', 'pending')->count(),
        ];

        $todayReservations = Reservasi::with(['user', 'kamar.hotel', 'kamar.detailKamar'])
            ->whereDate('check_in', $today)
            ->orderBy('check_in')
            ->get();

        return view('resepsionis.dashboard', compact('stats', 'todayReservations'));
    }

    public function reservations(Request $request)
    {
        $query = Reservasi::with(['user', 'kamar.hotel', 'kamar.detailKamar']);

        // Filter by check-in date
        if ($request->filled('check_in_date')) {
            $query->whereDate('check_in', $request->check_in_date);
        }

        // Search by guest name
        if ($request->filled('search')) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $reservations = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('resepsionis.reservations.index', compact('reservations'));
    }

    public function showReservation(Reservasi $reservasi)
    {
        $reservasi->load(['user', 'kamar.hotel', 'kamar.detailKamar', 'voucher']);
        
        return view('resepsionis.reservations.show', compact('reservasi'));
    }

    public function updateReservationStatus(Request $request, Reservasi $reservasi)
    {
        $request->validate([
            'status' => 'required|in:pending,dikonfirmasi,selesai'
        ]);

        $reservasi->update(['status' => $request->status]);

        // Update room status based on reservation status
        if ($request->status === 'dikonfirmasi') {
            $reservasi->kamar->update(['status' => 'dibooked']);
        } elseif ($request->status === 'selesai') {
            $reservasi->kamar->update(['status' => 'tersedia']);
        }

        return redirect()->back()->with('success', 'Status reservasi berhasil diupdate.');
    }

    public function checkIn(Reservasi $reservasi)
    {
        if ($reservasi->status !== 'dikonfirmasi') {
            return redirect()->back()->with('error', 'Reservasi harus dikonfirmasi terlebih dahulu.');
        }

        $reservasi->update(['status' => 'selesai']);
        $reservasi->kamar->update(['status' => 'dibooked']);

        return redirect()->back()->with('success', 'Check-in berhasil dilakukan.');
    }

    public function checkOut(Reservasi $reservasi)
    {
        $reservasi->kamar->update(['status' => 'tersedia']);
        
        return redirect()->back()->with('success', 'Check-out berhasil dilakukan.');
    }
}