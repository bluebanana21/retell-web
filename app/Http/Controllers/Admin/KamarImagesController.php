<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KamarImages;
use App\Models\Kamar;
use Illuminate\Http\Request;

class KamarImagesController extends Controller
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
        $kamarImages = KamarImages::with('kamar.detailKamar')->paginate(10);
        
        return view('admin.kamar-images.index', compact('kamarImages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kamars = Kamar::with('detailKamar')->get();
        
        return view('admin.kamar-images.create', compact('kamars'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_url' => 'nullable|url',
            'kamar_id' => 'required|exists:kamars,id_kamar',
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

        KamarImages::create($request->all());

        return redirect()->route('admin.kamar-images.index')
            ->with('success', 'Kamar image berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(KamarImages $kamarImage)
    {
        $kamarImage->load('kamar.detailKamar');
        
        return view('admin.kamar-images.show', compact('kamarImage'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KamarImages $kamarImage)
    {
        $kamars = Kamar::with('detailKamar')->get();
        
        return view('admin.kamar-images.edit', compact('kamarImage', 'kamars'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KamarImages $kamarImage)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_url' => 'nullable|url',
            'kamar_id' => 'required|exists:kamars,id_kamar',
        ], [
            'image.image' => 'File harus berupa gambar',
            'image.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
            'image.max' => 'Ukuran gambar maksimal 2MB',
            'image_url.url' => 'URL gambar tidak valid',
        ]);
        
        // If no image or image_url is provided, keep the existing one
        if (!$request->hasFile('image') && !$request->image_url && !$kamarImage->image_url) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['image' => 'Harus mengunggah gambar atau memasukkan URL gambar']);
        }

        $kamarImage->update($request->all());

        return redirect()->route('admin.kamar-images.index')
            ->with('success', 'Kamar image berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KamarImages $kamarImage)
    {
        $kamarImage->delete();

        return redirect()->route('admin.kamar-images.index')
            ->with('success', 'Kamar image berhasil dihapus.');
    }
}