@extends('layouts.admin')

@section('title', 'Detail Hotel Image')

@section('breadcrumb')
    <li class="inline-flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-indigo-600 transition-colors">Dashboard</a>
    </li>
    <li class="inline-flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <a href="{{ route('admin.hotel-images.index') }}" class="text-gray-500 hover:text-indigo-600 transition-colors">Hotel Images</a>
    </li>
    <li class="inline-flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <span class="text-gray-500">Detail Hotel Image</span>
    </li>
@endsection

@section('content')
<div class="bg-white/70 backdrop-blur-xl rounded-2xl shadow-lg border border-white/20">
    <!-- Header -->
    <div class="p-6 border-b border-gray-200/50 flex items-center space-x-3">
        <div class="w-10 h-10 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center">
            <i class="fas fa-image text-white"></i>
        </div>
        <h3 class="text-xl font-bold text-gray-900">Detail Hotel Image</h3>
    </div>
    
    <!-- Content -->
    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Image Preview -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Image Preview</label>
                <div class="border-2 border-dashed border-gray-300 rounded-xl p-4 flex items-center justify-center h-96">
                    <img src="{{ $hotelImage->image_url }}" alt="Hotel Image" class="max-h-full max-w-full object-contain">
                </div>
            
            <!-- Details -->
            <div>
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Hotel</label>
                    <div class="text-lg font-semibold text-gray-900">{{ $hotelImage->hotel->nama_hotel }}</div>
                    <div class="text-gray-600">{{ $hotelImage->hotel->kota->nama_kota }}</div>
                </div>
                
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Image Source</label>
                    <div class="text-gray-900 break-words">
                        @if(filter_var($hotelImage->image_url, FILTER_VALIDATE_URL))
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                <i class="fas fa-link mr-1"></i> URL
                            </span>
                            <div class="mt-2">{{ $hotelImage->image_url }}</div>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <i class="fas fa-file-image mr-1"></i> File
                            </span>
                            <div class="mt-2">{{ basename($hotelImage->image_url) }}</div>
                        @endif
                    </div>
                </div>
                
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Created At</label>
                    <div class="text-gray-900">{{ $hotelImage->created_at->format('d M Y, H:i') }}</div>
                </div>
                
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Updated At</label>
                    <div class="text-gray-900">{{ $hotelImage->updated_at->format('d M Y, H:i') }}</div>
                </div>
            </div>
        
        <!-- Actions -->
        <div class="flex items-center justify-end space-x-4 mt-8">
            <a href="{{ route('admin.hotel-images.index') }}" 
               class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-50 transition-all duration-200">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali
            </a>
            <a href="{{ route('admin.hotel-images.edit', $hotelImage->image_id) }}" 
               class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white font-medium rounded-xl shadow-lg hover:shadow-xl transition-all duration-300">
                <i class="fas fa-edit mr-2"></i>
                Edit
            </a>
            
            <form action="{{ route('admin.hotel-images.destroy', $hotelImage->image_id) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="inline-flex items-center px-4 py-2 bg-red-500 hover:bg-red-600 text-white font-medium rounded-xl shadow-lg hover:shadow-xl transition-all duration-300"
                        onclick="return confirm('Apakah Anda yakin ingin menghapus hotel image ini?')">
                    <i class="fas fa-trash mr-2"></i>
                    Hapus
                </button>
            </form>
        </div>
    </div>
</div>
@endsection