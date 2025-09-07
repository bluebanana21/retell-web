<?php

use App\Models\Kota;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\KotaController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\KamarController;
use App\Http\Controllers\Guest\GuestController;
use App\Http\Controllers\Admin\FasilitasController;
use App\Http\Controllers\Resepsionis\ResepsionisController;

// Guest Routes (Public)
Route::get('/', function () {
    $hotels = \App\Models\Hotel::with(['kota', 'fasilitas'])->get();
    $roomTypes = \App\Models\DetailKamar::with(['kamars' => function($query) {
        $query->where('status', 'tersedia');
    }])->get()->filter(function($detailKamar) {
        return $detailKamar->kamars->count() > 0;
    });
    $facilities = \App\Models\Fasilitas::all();
    
    return view('landing', compact('hotels', 'roomTypes', 'facilities'));
})->name('home');
Route::get('/guest', [GuestController::class, 'index'])->name('guest.home');
Route::get('/hotels', [GuestController::class, 'hotels'])->name('guest.hotels');
// Route::get('/hotel/{hotel}', [GuestController::class, 'hotelDetail'])->name('guest.hotel.detail');
Route::post('/search-hotel', [GuestController::class, 'searchHotel'])->name('guest.search.hotels');
Route::get('/cities/search', function () {
    $search = request('search', '');
    
    if (strlen($search) < 2) {
        return response()->json([]);
    }
    
    $cities = Kota::where('nama_kota', 'LIKE', '%' . $search . '%')
        ->select('id', 'nama_kota')
        ->limit(10)
        ->get();
    
    return response()->json($cities);
})->name('cities.search');
Route::get('/show-kamar/{hotel}',[GuestController::class, 'showKamar'])->name('guest.show.kamar');
// Route::get('/search-hotel/{kota}', [GuestController::class, 'showSearchHotel'])->name('guest.show.hotels');

// Guest Routes (Authenticated)
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/booking-form', [GuestController::class, 'bookingForm'])->name('guest.booking.form');
    Route::post('/booking', [GuestController::class, 'storeBooking'])->name('guest.booking.store');
    Route::get('/booking-success/{reservasi}', [GuestController::class, 'bookingSuccess'])->name('guest.booking.success');
    Route::get('/print-reservation/{reservasi}', [GuestController::class, 'printReservation'])->name('guest.print.reservation');
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('kamar', KamarController::class);
    Route::resource('fasilitas', FasilitasController::class)->parameters(['fasilitas' => 'fasilitas']);
    Route::resource('kota', KotaController::class)->parameters(['kota' => 'kota']);
});

// Resepsionis Routes
Route::middleware(['auth', 'role:resepsionis'])->prefix('resepsionis')->name('resepsionis.')->group(function () {
    Route::get('/dashboard', [ResepsionisController::class, 'dashboard'])->name('dashboard');
    Route::get('/reservations', [ResepsionisController::class, 'reservations'])->name('reservations.index');
    Route::get('/reservations/{reservasi}', [ResepsionisController::class, 'showReservation'])->name('reservations.show');
    Route::patch('/reservations/{reservasi}/status', [ResepsionisController::class, 'updateReservationStatus'])->name('reservations.update.status');
    Route::post('/reservations/{reservasi}/checkin', [ResepsionisController::class, 'checkIn'])->name('reservations.checkin');
    Route::post('/reservations/{reservasi}/checkout', [ResepsionisController::class, 'checkOut'])->name('reservations.checkout');
});

// Default Dashboard Route (redirect based on role)
Route::get('/dashboard', function () {
    if (Auth::user()->hasRole('admin')) {
        return redirect()->route('admin.dashboard');
    } elseif (Auth::user()->hasRole('resepsionis')) {
        return redirect()->route('resepsionis.dashboard');
    } else {
        return redirect()->route('home');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';