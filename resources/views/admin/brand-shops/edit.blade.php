@extends('layouts.admin')

@section('title', 'Edit Brand Shop')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Edit Brand Shop</h1>
            <p class="text-gray-600">{{ $brandShop->name }}</p>
        </div>
        <a href="{{ route('admin.brand-shops.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors">
            Back to Shops
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <form action="{{ route('admin.brand-shops.update', $brandShop) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Shop Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Shop Name *</label>
                    <input type="text" id="name" name="name" required 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500"
                           value="{{ old('name', $brandShop->name) }}">
                    @error('name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Area -->
                <div>
                    <label for="area" class="block text-sm font-medium text-gray-700 mb-2">Area *</label>
                    <input type="text" id="area" name="area" required 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500"
                           value="{{ old('area', $brandShop->area) }}">
                    @error('area')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- City -->
                <div>
                    <label for="city" class="block text-sm font-medium text-gray-700 mb-2">City *</label>
                    <input type="text" id="city" name="city" required 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500"
                           value="{{ old('city', $brandShop->city) }}">
                    @error('city')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone -->
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                    <input type="tel" id="phone" name="phone" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500"
                           value="{{ old('phone', $brandShop->phone) }}">
                    @error('phone')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Directions URL -->
                <div class="md:col-span-2">
                    <label for="directions_url" class="block text-sm font-medium text-gray-700 mb-2">Google Maps Link</label>
                    <input type="url" id="directions_url" name="directions_url" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500"
                           value="{{ old('directions_url', $brandShop->directions_url) }}">
                    @error('directions_url')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Image Upload -->
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Shop Image</label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-gray-400 transition-colors cursor-pointer" onclick="document.getElementById('image').click()">
                    <div id="image-preview" class="{{ $brandShop->image ? '' : 'hidden' }} mb-4">
                        <img id="preview-img" src="{{ $brandShop->image ? Storage::url($brandShop->image) : '' }}" alt="Preview" class="max-w-xs h-48 object-cover rounded-lg mx-auto">
                    </div>
                    <div id="upload-placeholder" class="{{ $brandShop->image ? 'hidden' : '' }}">
                        <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-4"></i>
                        <p class="text-sm text-gray-600 mb-2">Click to upload or drag and drop</p>
                        <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                    </div>
                    <input type="file" id="image" name="image" accept="image/*" class="hidden">
                </div>
                @error('image')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Store Timings -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-4">Store Timings</label>
                <div class="space-y-3 bg-gray-50 p-4 rounded-lg">
                    @php
                        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                    @endphp
                    @foreach($days as $day)
                    <div class="flex items-center gap-4">
                        <label class="w-24 text-sm font-medium text-gray-700">{{ $day }}</label>
                        <input type="text" name="timing_{{ $day }}" 
                               class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500"
                               placeholder="e.g., 9AM-6PM" 
                               value="{{ old("timing_$day", $brandShop->timings[$day] ?? '') }}">
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Active Status -->
            <div class="flex items-center">
                <input type="checkbox" id="is_active" name="is_active" value="1" class="rounded border-gray-300 text-red-600" {{ old('is_active', $brandShop->is_active) ? 'checked' : '' }}>
                <label for="is_active" class="ml-2 text-sm font-medium text-gray-700">Active</label>
            </div>

            <!-- Submit -->
            <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.brand-shops.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-gray-600 transition-colors">
                    Update Shop
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('image-preview');
    const previewImg = document.getElementById('preview-img');
    const uploadPlaceholder = document.getElementById('upload-placeholder');

    imageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                imagePreview.classList.remove('hidden');
                uploadPlaceholder.classList.add('hidden');
            };
            reader.readAsDataURL(file);
        }
    });
});
</script>
@endsection
