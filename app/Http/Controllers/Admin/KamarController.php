<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kamar;
use App\Models\Hotel;
use App\Models\DetailKamar;
use Illuminate\Http\Request;

class KamarController extends Controller
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
        $kamars = Kamar::with(['hotel', 'detailKamar'])
            ->paginate(10);
        
        return view('admin.kamar.index', compact('kamars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hotels = Hotel::all();
        $detailKamars = DetailKamar::all();
        
        return view('admin.kamar.create', compact('hotels', 'detailKamars'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_hotel' => 'required|exists:hotels,id',
            'detail_id' => 'required|exists:detail_kamars,detail_id',
            'harga_per_malam' => 'required|numeric|min:0',
            'lantai' => 'required|integer|min:1',
            'status' => 'required|in:tersedia,dibooked,maintenance'
        ]);

        Kamar::create($request->all());

        return redirect()->route('admin.kamar.index')
            ->with('success', 'Kamar berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kamar $kamar)
    {
        $kamar->load(['hotel', 'detailKamar', 'reservasis.user']);
        
        return view('admin.kamar.show', compact('kamar'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kamar $kamar)
    {
        $hotels = Hotel::all();
        $detailKamars = DetailKamar::all();
        
        return view('admin.kamar.edit', compact('kamar', 'hotels', 'detailKamars'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kamar $kamar)
    {
        $request->validate([
            'id_hotel' => 'required|exists:hotels,id',
            'detail_id' => 'required|exists:detail_kamars,detail_id',
            'harga_per_malam' => 'required|numeric|min:0',
            'lantai' => 'required|integer|min:1',
            'status' => 'required|in:tersedia,dibooked,maintenance'
        ]);

        $kamar->update($request->all());

        return redirect()->route('admin.kamar.index')
            ->with('success', 'Kamar berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kamar $kamar)
    {
        $kamar->delete();

        return redirect()->route('admin.kamar.index')
            ->with('success', 'Kamar berhasil dihapus.');
    }
}