<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HotelImages;
use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelImagesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hotelImages = HotelImages::with('hotel')->paginate(10);
        
        return view('admin.hotel-images.index', compact('hotelImages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hotels = Hotel::all();
        
        return view('admin.hotel-images.create', compact('hotels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_url' => 'nullable|url',
            'hotel_id' => 'required|exists:hotel,id',
        ], [
            'image.image' => 'File harus berupa gambar',
            'image.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
            'image.max' => 'Ukuran gambar maksimal 2MB',
            'image_url.url' => 'URL gambar tidak valid',
        ]);
        
        // Ensure either image or image_url is provided
        if (!$request->hasFile('image') && !$request->image_url) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['image' => 'Harus mengunggah gambar atau memasukkan URL gambar']);
        }

        HotelImages::create($request->all());

        return redirect()->route('admin.hotel-images.index')
            ->with('success', 'Hotel image berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(HotelImages $hotelImage)
    {
        $hotelImage->load('hotel');
        
        return view('admin.hotel-images.show', compact('hotelImage'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HotelImages $hotelImage)
    {
        $hotels = Hotel::all();
        
        return view('admin.hotel-images.edit', compact('hotelImage', 'hotels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HotelImages $hotelImage)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_url' => 'nullable|url',
            'hotel_id' => 'required|exists:hotel,id',
        ], [
            'image.image' => 'File harus berupa gambar',
            'image.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
            'image.max' => 'Ukuran gambar maksimal 2MB',
            'image_url.url' => 'URL gambar tidak valid',
        ]);
        
        // If no image or image_url is provided, keep the existing one
        if (!$request->hasFile('image') && !$request->image_url && !$hotelImage->image_url) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['image' => 'Harus mengunggah gambar atau memasukkan URL gambar']);
        }

        $hotelImage->update($request->all());

        return redirect()->route('admin.hotel-images.index')
            ->with('success', 'Hotel image berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HotelImages $hotelImage)
    {
        $hotelImage->delete();

        return redirect()->route('admin.hotel-images.index')
            ->with('success', 'Hotel image berhasil dihapus.');
    }
}