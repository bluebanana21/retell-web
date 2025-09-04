<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\Kamar;
use App\Models\Reservasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    public function dashboard()
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

        $recent_reservations = Reservasi::with(['user', 'kamar.hotel'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recent_reservations'));
    }
}