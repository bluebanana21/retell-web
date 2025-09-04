<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kota;
use Illuminate\Http\Request;

class KotaController extends Controller
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
        $kotas = Kota::withCount('hotels')->paginate(10);
        
        return view('admin.kota.index', compact('kotas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kota.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kota' => 'required|string|max:255|unique:kotas,nama_kota'
        ]);

        Kota::create($request->all());

        return redirect()->route('admin.kota.index')
            ->with('success', 'Kota berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kota $kota)
    {
        $kota->load('hotels');
        
        return view('admin.kota.show', compact('kota'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kota $kota)
    {
        return view('admin.kota.edit', compact('kota'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kota $kota)
    {
        $request->validate([
            'nama_kota' => 'required|string|max:255|unique:kotas,nama_kota,' . $kota->id
        ]);

        $kota->update($request->all());

        return redirect()->route('admin.kota.index')
            ->with('success', 'Kota berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kota $kota)
    {
        if ($kota->hotels()->count() > 0) {
            return redirect()->route('admin.kota.index')
                ->with('error', 'Tidak dapat menghapus kota yang masih memiliki hotel.');
        }

        $kota->delete();

        return redirect()->route('admin.kota.index')
            ->with('success', 'Kota berhasil dihapus.');
    }
}