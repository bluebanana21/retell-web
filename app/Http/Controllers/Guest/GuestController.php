<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\Kamar;
use App\Models\DetailKamar;
use App\Models\Kota;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class GuestController extends Controller
{
    public function index()
    {
        $hotels = Hotel::with(['kota', 'fasilitas'])
            ->withAvg('reviews', 'rating')
            ->take(6)
            ->get();

        $kotas = Kota::withCount('hotels')->get();

        return view('guest.index', compact('hotels', 'kotas'));
    }

    public function hotels(Request $request)
    {
        $query = Hotel::with(['kota', 'fasilitas'])->withAvg('reviews', 'rating');

        // Filter by city
        if ($request->filled('kota_id')) {
            $query->where('kota_id', $request->kota_id);
        }

        // Search by name
        if ($request->filled('search')) {
            $query->where('nama_hotel', 'like', '%' . $request->search . '%');
        }

        $hotels = $query->paginate(12);
        $kotas = Kota::all();

        return view('guest.hotels', compact('hotels', 'kotas'));
    }

    public function hotelDetail(Hotel $hotel)
    {
        $hotel->load(['kota', 'fasilitas', 'reviews.user']);

        // Get available room types with their details and prices
        $roomTypes = DetailKamar::with(['kamars' => function ($query) use ($hotel) {
            $query->where('id_hotel', $hotel->id)
                ->where('status', 'tersedia');
        }])->get()->filter(function ($detailKamar) {
            return $detailKamar->kamars->count() > 0;
        });

        return view('guest.hotel-detail', compact('hotel', 'roomTypes'));
    }

    public function searchRooms(Request $request)
    {
        $request->validate([
            'hotel_id' => 'required|exists:hotel,id',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|integer|min:1'
        ]);

        $hotel = Hotel::with(['kota', 'fasilitas'])->findOrFail($request->hotel_id);
        $checkIn = Carbon::parse($request->check_in);
        $checkOut = Carbon::parse($request->check_out);
        $guests = $request->guests;

        // Get available room types that can accommodate the guests
        $availableRooms = DetailKamar::with(['kamars' => function ($query) use ($hotel, $checkIn, $checkOut) {
            $query->where('id_hotel', $hotel->id)
                ->where('status', 'tersedia')
                ->whereDoesntHave('reservasis', function ($q) use ($checkIn, $checkOut) {
                    $q->where(function ($query) use ($checkIn, $checkOut) {
                        $query->whereBetween('check_in', [$checkIn, $checkOut])
                            ->orWhereBetween('check_out', [$checkIn, $checkOut])
                            ->orWhere(function ($q) use ($checkIn, $checkOut) {
                                $q->where('check_in', '<=', $checkIn)
                                    ->where('check_out', '>=', $checkOut);
                            });
                    });
                });
        }])->where('kapasitas', '>=', $guests)
            ->get()
            ->filter(function ($detailKamar) {
                return $detailKamar->kamars->count() > 0;
            });

        $nights = $checkIn->diffInDays($checkOut);

        return view('guest.search-results', compact('hotel', 'availableRooms', 'checkIn', 'checkOut', 'guests', 'nights'));
    }

    public function bookingFormView()
    {
        return view('guest.booking-form-view');
    }

    public function bookingForm(Request $request)
    {
        $request->validate([
            'detail_id' => 'required|exists:detail_kamars,detail_id',
            'hotel_id' => 'required|exists:hotel,id',
            'check_in' => 'required|date',
            'check_out' => 'required|date',
            'guests' => 'required|integer',
            'rooms' => 'required|integer|min:1'
        ]);

        $hotel = Hotel::findOrFail($request->hotel_id);
        $detailKamar = DetailKamar::findOrFail($request->detail_id);
        $checkIn = Carbon::parse($request->check_in);
        $checkOut = Carbon::parse($request->check_out);
        $nights = $checkIn->diffInDays($checkOut);

        // Get available rooms of this type
        $availableRooms = Kamar::where('id_hotel', $hotel->id)
            ->where('detail_id', $detailKamar->detail_id)
            ->where('status', 'tersedia')
            ->limit($request->rooms)
            ->get();

        if ($availableRooms->count() < $request->rooms) {
            return redirect()->back()->with('error', 'Tidak cukup kamar tersedia.');
        }

        $totalPrice = $availableRooms->sum('harga_per_malam') * $nights;

        return view('guest.booking-form', compact(
            'hotel',
            'detailKamar',
            'availableRooms',
            'checkIn',
            'checkOut',
            'nights',
            'totalPrice',
            'request'
        ));
    }

    public function storeBooking(Request $request)
    {
        $request->validate([
            'kamar_ids' => 'required|array',
            'kamar_ids.*' => 'exists:kamars,id_kamar',
            'check_in' => 'required|date',
            'check_out' => 'required|date',
            'total_harga' => 'required|numeric'
        ]);

        $reservations = [];

        foreach ($request->kamar_ids as $kamarId) {
            $reservation = Reservasi::create([
                'id_user' => Auth::id(),
                'kamar_id' => $kamarId,
                'tanggal_reservasi' => now(),
                'check_in' => $request->check_in,
                'check_out' => $request->check_out,
                'status' => 'pending',
                'total_harga' => $request->total_harga / count($request->kamar_ids)
            ]);

            $reservations[] = $reservation;

            // Update room status
            Kamar::find($kamarId)->update(['status' => 'dibooked']);
        }

        return redirect()->route('guest.booking.success', ['reservasi' => $reservations[0]->id_reservasi])
            ->with('success', 'Reservasi berhasil dibuat!');
    }

    public function bookingSuccess(Reservasi $reservasi)
    {
        $reservasi->load(['kamar.hotel', 'kamar.detailKamar', 'user']);

        return view('guest.booking-success', compact('reservasi'));
    }

    public function printReservation(Reservasi $reservasi)
    {
        if ($reservasi->id_user !== Auth::id()) {
            abort(403);
        }

        $reservasi->load(['kamar.hotel', 'kamar.detailKamar', 'user']);

        return view('guest.print-reservation', compact('reservasi'));
    }
}
