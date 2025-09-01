@extends('layouts.admin')

@section('title', 'Create Category')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Create Category</h1>
            <p class="text-gray-600">Add a new product category</p>
        </div>
        <a href="{{ route('admin.categories.index') }}" 
           class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors">
            Back to Categories
        </a>
    </div>

    <!-- Create Form -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-6" enctype="multipart/form-data">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Basic Information -->
                <div class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Category Name *</label>
                        <input type="text" id="name" name="name" required 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               value="{{ old('name') }}" placeholder="Enter category name">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="icon" class="block text-sm font-medium text-gray-700 mb-1">Icon (Font Awesome)</label>
                        <input type="text" id="icon" name="icon" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               value="{{ old('icon') }}" placeholder="e.g., fas fa-mobile-alt">
                        <p class="text-sm text-gray-500 mt-1">Font Awesome icon class (optional)</p>
                        @error('icon')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-1">Sort Order</label>
                        <input type="number" id="sort_order" name="sort_order" min="0" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               value="{{ old('sort_order', 0) }}">
                        <p class="text-sm text-gray-500 mt-1">Lower numbers appear first</p>
                        @error('sort_order')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Additional Information -->
                <div class="space-y-4">
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea id="description" name="description" rows="4" 
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                  placeholder="Enter category description...">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center space-x-4">
                        <label class="flex items-center">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-700">Active</span>
                        </label>
                    </div>
                </div>
            </div>

             <!-- Images Section -->
            <div class="space-y-6">
                <h3 class="text-lg font-medium text-gray-900">Category Banner</h3>
                
                <!-- Main Image -->
                <div class="space-y-3">
                    <label class="block text-sm font-medium text-gray-700">Main Image</label>
                    
                    <!-- Main Image Upload Area -->
                    <div class="flex items-center space-x-4">
                        <!-- Preview Area -->
                        <div id="main-image-preview" class="flex-shrink-0">
                            <div class="w-32 h-32 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center bg-gray-50 hover:bg-gray-100 transition-colors cursor-pointer" onclick="document.getElementById('image').click()">
                                <div class="text-center">
                                    <svg class="mx-auto h-8 w-8 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <p class="text-xs text-gray-500 mt-1">Click to upload</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Upload Info -->
                        <div class="flex-1">
                            <input type="file" id="image" name="image" accept="image/*" class="hidden">
                            <div class="space-y-2">
                                <p class="text-sm text-gray-600">Upload the main product image</p>
                                <p class="text-xs text-gray-500">JPEG, PNG, JPG, GIF up to 2MB</p>
                                <p class="text-xs text-gray-500">This will be the primary image shown for the product</p>
                            </div>
                        </div>
                    </div>
                    @error('image')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

             
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit" 
                        class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                    Create Category
                </button>
            </div>
        </form>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/product-images.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('assets/js/product-images.js') }}"></script>
@endpush
@endsection