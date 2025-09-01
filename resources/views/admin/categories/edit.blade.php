@extends('layouts.admin')

@section('title', 'Edit Category')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Edit Category</h1>
            <p class="text-gray-600">Update category information</p>
        </div>
        <a href="{{ route('admin.categories.index') }}" 
           class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors">
            Back to Categories
        </a>
    </div>

    <!-- Edit Form -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <form action="{{ route('admin.categories.update', $category) }}" method="POST" class="space-y-6" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Basic Information -->
                <div class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Category Name *</label>
                        <input type="text" id="name" name="name" required 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               value="{{ old('name', $category->name) }}" placeholder="Enter category name">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="icon" class="block text-sm font-medium text-gray-700 mb-1">Icon (Font Awesome)</label>
                        <input type="text" id="icon" name="icon" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               value="{{ old('icon', $category->icon) }}" placeholder="e.g., fas fa-mobile-alt">
                        <p class="text-sm text-gray-500 mt-1">Font Awesome icon class (optional)</p>
                        @error('icon')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-1">Sort Order</label>
                        <input type="number" id="sort_order" name="sort_order" min="0" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               value="{{ old('sort_order', $category->sort_order) }}">
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
                                  placeholder="Enter category description...">{{ old('description', $category->description) }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center space-x-4">
                        <label class="flex items-center">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $category->is_active) ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-700">Active</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Images Section -->
            <div class="space-y-6">
                <h3 class="text-lg font-medium text-gray-900">Product Images</h3>
                
                <!-- Current Images -->
               
                    <div class="space-y-4">
                        <h4 class="text-md font-medium text-gray-700">Current Images</h4>
                        
                        <!-- Main Image -->
                        @if($category->image)
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">Main Image</label>
                                <div id="existing-main-image" class="relative group">
                                    <img src="{{ url('/') }}/storage/{{ $category->image }}" alt="{{ $category->name }}" 
                                         class="w-32 h-32 object-cover rounded-lg border" data-image-path="{{ $category->image }}">
                                    <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity rounded-lg flex items-center justify-center">
                                        <button type="button" onclick="productImageManager.removeMainImage()" 
                                                class="bg-red-500 text-white p-1 rounded-full hover:bg-red-600">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif

                        
                    {{-- <h4 class="text-md font-medium text-gray-700">Add New Images</h4> --}}
                    
                    <!-- New Main Image -->
                    <div class="space-y-3">
                        <label class="block text-sm font-medium text-gray-700">New Banner Image</label>
                        
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
                                    <p class="text-sm text-gray-600">Upload a new main image</p>
                                    <p class="text-xs text-gray-500">JPEG, PNG, JPG, GIF up to 2MB</p>
                                    <p class="text-xs text-gray-500">Leave empty to keep current image</p>
                                </div>
                            </div>
                        </div>
                        @error('image')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- New Additional Images -->
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <label class="block text-sm font-medium text-gray-700">New Additional Images</label>
                            <span class="text-sm text-gray-500">Selected: <span id="image-count">0</span></span>
                        </div>
                        
                        <!-- Drag and Drop Zone -->
                        <div id="image-drop-zone" class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-gray-400 transition-colors">
                            <div class="space-y-2">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="text-gray-600">
                                    <label for="images" class="cursor-pointer">
                                        <span class="font-medium text-blue-600 hover:text-blue-500">Click to upload</span>
                                        <span class="text-gray-500"> or drag and drop</span>
                                    </label>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB each</p>
                            </div>
                            <input type="file" id="images" name="images[]" accept="image/*" multiple class="hidden">
                        </div>

                        <!-- Image Preview Container -->
                        <div id="image-preview-container" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 mt-4"></div>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit" 
                        class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                    Update Category
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