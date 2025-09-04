@extends('layouts.admin')

@section('title', 'Create Product')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Create Product</h1>
            <p class="text-gray-600">Add a new product to your store</p>
        </div>
        <a href="{{ route('admin.products.index') }}" 
           class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors">
            Back to Products
        </a>
    </div>

    <!-- Create Form -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Basic Information -->
                <div class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Product Name *</label>
                        <input type="text" id="name" name="name" required 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               value="{{ old('name') }}">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Category *</label>
                        <select id="category_id" name="category_id" required 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="brand" class="block text-sm font-medium text-gray-700 mb-1">Brand</label>
                        <input type="text" id="brand" name="brand" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               value="{{ old('brand') }}" placeholder="e.g., Samsung, Apple, HP">
                        @error('brand')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Price (KES) *</label>
                        <input type="number" id="price" name="price" step="0.01" min="0" required 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               value="{{ old('price') }}">
                        @error('price')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="old_price" class="block text-sm font-medium text-gray-700 mb-1">Old Price (KES)</label>
                        <input type="number" id="old_price" name="old_price" step="0.01" min="0" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               value="{{ old('old_price') }}">
                        @error('old_price')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="stock_quantity" class="block text-sm font-medium text-gray-700 mb-1">Stock Quantity *</label>
                        <input type="number" id="stock_quantity" name="stock_quantity" min="0" required 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               value="{{ old('stock_quantity', 0) }}">
                        @error('stock_quantity')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Additional Information -->
                <div class="space-y-4">
                    <div>
                        <label for="badge" class="block text-sm font-medium text-gray-700 mb-1">Badge</label>
                        <input type="text" id="badge" name="badge" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               value="{{ old('badge') }}" placeholder="e.g., New, Sale, Featured">
                        @error('badge')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="rating" class="block text-sm font-medium text-gray-700 mb-1">Rating</label>
                        <input type="number" id="rating" name="rating" min="1" max="5" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               value="{{ old('rating') }}">
                        @error('rating')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="reviews_count" class="block text-sm font-medium text-gray-700 mb-1">Reviews Count</label>
                        <input type="number" id="reviews_count" name="reviews_count" min="0" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               value="{{ old('reviews_count', 0) }}">
                        @error('reviews_count')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center space-x-4">
                        <label class="flex items-center">
                            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-700">Featured Product</span>
                        </label>
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

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description *</label>
                <textarea id="description" name="description" rows="4" required 
                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                          placeholder="Enter product description...">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
           
            {{-- <textarea  required id="article-ckeditor" name="ckeditor" class="materialilze-textarea" placeholder="content" style="min-height:500px !important"></textarea> --}}
            {{-- CKEditor 5 CDN --}}
            {{-- <script src="https://cdn.ckeditor.com/4.25.1-lts/standard/ckeditor.js"></script> --}}
            <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    

            <script>
                CKEDITOR.replace('description', {
                    filebrowserUploadUrl: "https://africanpharmaceuticalreview.com/product/img?_token=mbshGdbPIBHaYR8lxZTHV2zwwjJQJrwrDsk5jevS",
                    filebrowserUploadMethod: 'form'
                });
            </script>


            <!-- Specifications -->
           <div class="space-y-6">
    <!-- Header with add group button -->
    <div class="flex items-center justify-between">
        <label class="block text-sm font-medium text-gray-700">Specification Groups</label>
        <button type="button" onclick="addGroup()" 
            class="text-sm bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700 transition-colors">
            Add Group
        </button>
    </div>

    <!-- Groups container -->
    <div id="groups-container" class="space-y-6">
        <!-- Groups will be appended here -->
    </div>

    <p class="text-sm text-gray-500">Add groups like Display, Platform, Sound, etc., and their specifications.</p>
</div>

            <!-- Images Section -->
            <div class="space-y-6">
                <h3 class="text-lg font-medium text-gray-900">Product Images</h3>
                
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

                <!-- Additional Images -->
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <label class="block text-sm font-medium text-gray-700">Additional Images</label>
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

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit" 
                        class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                    Create Product
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
<script>
let groupIndex = 0;

function addGroup() {
    const groupsContainer = document.getElementById('groups-container');
    
    const groupDiv = document.createElement('div');
    groupDiv.className = 'group border p-4 rounded-lg space-y-3 bg-gray-50';
    groupDiv.dataset.groupIndex = groupIndex;

    groupDiv.innerHTML = `
        <!-- Group name + remove -->
        <div class="flex items-center justify-between">
            <input type="text" name="specifications[${groupIndex}][group]" 
                placeholder="Group name (e.g. Display)" 
                class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 mr-3">
            <button type="button" onclick="removeGroup(this)" 
                class="text-red-600 hover:text-red-800 p-2">
                Remove Group
            </button>
        </div>

        <!-- Specs inside this group -->
        <div class="space-y-2" id="specs-${groupIndex}">
            <!-- Specs rows will appear here -->
        </div>

        <!-- Add spec button -->
        <button type="button" onclick="addSpecificationRow(${groupIndex})" 
            class="text-sm bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition-colors">
            Add Specification
        </button>
    `;

    groupsContainer.appendChild(groupDiv);
    groupIndex++;
}

function addSpecificationRow(groupIndex) {
    const container = document.getElementById(`specs-${groupIndex}`);
    const rowCount = container.querySelectorAll('.specification-row').length;

    const newRow = document.createElement('div');
    newRow.className = 'specification-row flex items-center space-x-3';

    newRow.innerHTML = `
        <input type="text" name="specifications[${groupIndex}][items][${rowCount}][key]" 
               placeholder="Specification name (e.g. Size)" 
               class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        <input type="text" name="specifications[${groupIndex}][items][${rowCount}][value]" 
               placeholder="Specification value (e.g. 22 inch)" 
               class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        <button type="button" onclick="removeSpecificationRow(this)" 
                class="text-red-600 hover:text-red-800 p-2">
            ✕
        </button>
    `;

    container.appendChild(newRow);
}

function removeGroup(button) {
    button.closest('.group').remove();
}

function removeSpecificationRow(button) {
    button.closest('.specification-row').remove();
}
</script>
@endpush
@endsection 