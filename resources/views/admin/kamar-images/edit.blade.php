@extends('layouts.admin')

@section('title', 'Edit Kamar Image')

@section('breadcrumb')
    <li class="inline-flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-indigo-600 transition-colors">Dashboard</a>
    </li>
    <li class="inline-flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <a href="{{ route('admin.kamar-images.index') }}" class="text-gray-500 hover:text-indigo-600 transition-colors">Kamar Images</a>
    </li>
    <li class="inline-flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <span class="text-gray-500">Edit Kamar Image</span>
    </li>
@endsection

@section('content')
<div class="bg-white/70 backdrop-blur-xl rounded-2xl shadow-lg border border-white/20">
    <!-- Header -->
    <div class="p-6 border-b border-gray-200/50 flex items-center space-x-3">
        <div class="w-10 h-10 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center">
            <i class="fas fa-edit text-white"></i>
        </div>
        <h3 class="text-xl font-bold text-gray-900">Edit Kamar Image</h3>
    </div>
    
    <!-- Form -->
    <form action="{{ route('admin.kamar-images.update', $kamarImage->image_id) }}" method="POST" class="p-6" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <!-- Kamar Selection -->
        <div class="mb-6">
            <label for="kamar_id" class="block text-sm font-medium text-gray-700 mb-2">Kamar</label>
            <select name="kamar_id" id="kamar_id" class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200">
                <option value="">Pilih Kamar</option>
                @foreach($kamars as $kamar)
                    <option value="{{ $kamar->id_kamar }}" {{ (old('kamar_id', $kamarImage->kamar_id) == $kamar->id_kamar) ? 'selected' : '' }}>
                        {{ ucfirst($kamar->detailKamar->tipe_kamar) }} Room - {{ $kamar->hotel->nama_hotel }}
                    </option>
                @endforeach
            </select>
            @error('kamar_id')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        
        <!-- Image Upload Method -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Metode Upload Gambar</label>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Upload from Storage -->
                <div class="border border-gray-300 rounded-xl p-4">
                    <div class="flex items-center mb-3">
                        <input type="radio" name="upload_method" id="upload_method_file" value="file" class="mr-2" {{ !filter_var($kamarImage->image_url, FILTER_VALIDATE_URL) ? 'checked' : '' }}>
                        <label for="upload_method_file" class="font-medium text-gray-700">Upload dari Storage</label>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="block text-sm text-gray-600 mb-1">Pilih File</label>
                        <input type="file" name="image" id="image"
                               class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-medium file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition-all duration-200"
                               accept="image/*">
                        @error('image')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-2 text-sm text-gray-500">Biarkan kosong jika tidak ingin mengganti gambar</p>
                    </div>
                </div>
                
                <!-- URL Input -->
                <div class="border border-gray-300 rounded-xl p-4">
                    <div class="flex items-center mb-3">
                        <input type="radio" name="upload_method" id="upload_method_url" value="url" class="mr-2" {{ filter_var($kamarImage->image_url, FILTER_VALIDATE_URL) ? 'checked' : '' }}>
                        <label for="upload_method_url" class="font-medium text-gray-700">Masukkan URL</label>
                    </div>
                    <div class="mb-3">
                        <label for="image_url" class="block text-sm text-gray-600 mb-1">URL Gambar</label>
                        <input type="url" name="image_url" id="image_url" value="{{ old('image_url', filter_var($kamarImage->image_url, FILTER_VALIDATE_URL) ? $kamarImage->image_url : '') }}"
                               class="block w-full px-3 py-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200"
                               placeholder="https://example.com/image.jpg">
                        @error('image_url')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Preview -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Preview</label>
            <div class="border-2 border-dashed border-gray-300 rounded-xl p-4 flex items-center justify-center h-64">
                <img id="imagePreview" src="{{ $kamarImage->image_url }}" alt="Preview" class="h-full w-full object-contain">
            </div>
        </div>
        
        <!-- Actions -->
        <div class="flex items-center justify-end space-x-4">
            <a href="{{ route('admin.kamar-images.index') }}" 
               class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-50 transition-all duration-200">
                <i class="fas fa-arrow-left mr-2"></i>
                Batal
            </a>
            <button type="submit" 
                    class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white font-medium rounded-xl shadow-lg hover:shadow-xl transition-all duration-300">
                <i class="fas fa-save mr-2"></i>
                Update
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const uploadMethodFile = document.getElementById('upload_method_file');
    const uploadMethodUrl = document.getElementById('upload_method_url');
    const imageInput = document.getElementById('image');
    const imageUrlInput = document.getElementById('image_url');
    const imagePreview = document.getElementById('imagePreview');
    const originalImageUrl = '{{ $kamarImage->image_url }}';
    
    // Handle upload method selection
    uploadMethodFile.addEventListener('change', function() {
        if (this.checked) {
            imageInput.disabled = false;
            imageUrlInput.disabled = true;
        }
    });
    
    uploadMethodUrl.addEventListener('change', function() {
        if (this.checked) {
            imageInput.disabled = true;
            imageUrlInput.disabled = false;
            imagePreview.src = originalImageUrl;
        }
    });
    
    // Handle file input
    imageInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        } else {
            imagePreview.src = originalImageUrl;
        }
    });
    
    // Handle URL input
    imageUrlInput.addEventListener('input', function() {
        const url = this.value;
        
        if (url) {
            imagePreview.src = url;
            
            imagePreview.onerror = function() {
                imagePreview.src = originalImageUrl;
            };
        } else {
            imagePreview.src = originalImageUrl;
        }
    });
});
</script>
@endpush
@endsection