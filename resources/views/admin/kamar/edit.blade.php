@extends('layouts.admin')

@section('title', 'Edit Kamar')

@section('breadcrumb')
    <li class="inline-flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-indigo-600 transition-colors">Dashboard</a>
    </li>
    <li class="inline-flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <a href="{{ route('admin.kamar.index') }}" class="text-gray-500 hover:text-indigo-600 transition-colors">Kelola Kamar</a>
    </li>
    <li class="inline-flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <span class="text-gray-500">Edit Kamar</span>
    </li>
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white/70 backdrop-blur-xl rounded-2xl shadow-lg border border-white/20">
        <!-- Header -->
        <div class="p-6 border-b border-gray-200/50">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-gradient-to-r from-amber-500 to-orange-600 rounded-xl flex items-center justify-center">
                    <i class="fas fa-edit text-white"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900">Edit Kamar</h3>
            </div>
        </div>
        
        <!-- Form -->
        <form action="{{ route('admin.kamar.update', $kamar->id_kamar) }}" method="POST" class="p-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Hotel Selection -->
                <div class="space-y-2">
                    <label for="id_hotel" class="block text-sm font-semibold text-gray-700">Hotel</label>
                    <select name="id_hotel" id="id_hotel" 
                            class="block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 @error('id_hotel') border-red-500 @enderror">
                        <option value="">Pilih Hotel</option>
                        @foreach($hotels as $hotel)
                            <option value="{{ $hotel->id }}" {{ (old('id_hotel') ?? $kamar->id_hotel) == $hotel->id ? 'selected' : '' }}>
                                {{ $hotel->nama_hotel }} - {{ $hotel->kota->nama_kota }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_hotel')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Room Type Selection -->
                <div class="space-y-2">
                    <label for="detail_id" class="block text-sm font-semibold text-gray-700">Tipe Kamar</label>
                    <select name="detail_id" id="detail_id" 
                            class="block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 @error('detail_id') border-red-500 @enderror">
                        <option value="">Pilih Tipe Kamar</option>
                        @foreach($detailKamars as $detail)
                            <option value="{{ $detail->detail_id }}" {{ (old('detail_id') ?? $kamar->detail_id) == $detail->detail_id ? 'selected' : '' }}>
                                {{ ucfirst($detail->tipe_kamar) }} - {{ $detail->kapasitas }} orang
                            </option>
                        @endforeach
                    </select>
                    @error('detail_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Price -->
                <div class="space-y-2">
                    <label for="harga_per_malam" class="block text-sm font-semibold text-gray-700">Harga per Malam</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 text-sm">Rp</span>
                        </div>
                        <input type="number" name="harga_per_malam" id="harga_per_malam" 
                               value="{{ old('harga_per_malam') ?? $kamar->harga_per_malam }}"
                               class="block w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 @error('harga_per_malam') border-red-500 @enderror"
                               placeholder="500000">
                    </div>
                    @error('harga_per_malam')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Floor -->
                <div class="space-y-2">
                    <label for="lantai" class="block text-sm font-semibold text-gray-700">Lantai</label>
                    <input type="number" name="lantai" id="lantai" 
                           value="{{ old('lantai') ?? $kamar->lantai }}"
                           class="block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 @error('lantai') border-red-500 @enderror"
                           placeholder="1" min="1">
                    @error('lantai')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div class="space-y-2 md:col-span-2">
                    <label for="status" class="block text-sm font-semibold text-gray-700">Status</label>
                    <select name="status" id="status" 
                            class="block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 @error('status') border-red-500 @enderror">
                        <option value="">Pilih Status</option>
                        <option value="tersedia" {{ (old('status') ?? $kamar->status) == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                        <option value="dibooked" {{ (old('status') ?? $kamar->status) == 'dibooked' ? 'selected' : '' }}>Dibooked</option>
                        <option value="maintenance" {{ (old('status') ?? $kamar->status) == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end space-x-4 mt-8 pt-6 border-t border-gray-200/50">
                <a href="{{ route('admin.kamar.index') }}" 
                   class="inline-flex items-center px-6 py-3 border border-gray-300 shadow-sm text-sm font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                    <i class="fas fa-times mr-2"></i>
                    Batal
                </a>
                <button type="submit" 
                        class="inline-flex items-center px-6 py-3 border border-transparent text-sm font-medium rounded-xl shadow-sm text-white bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-300 hover:-translate-y-0.5 hover:shadow-lg">
                    <i class="fas fa-save mr-2"></i>
                    Update Kamar
                </button>
            </div>
        </form>
    </div>
</div>
@endsection