@extends('layouts.admin')

@section('title', 'Create Blog Post')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Create Blog Post</h1>
            <p class="text-gray-600">Write a new blog post</p>
        </div>
        <a href="{{ route('admin.blog-posts.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors">
            Back to Posts
        </a>
    </div>

    @if($errors->any())
        <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
            <h4 class="font-semibold mb-2">Please fix the following errors:</h4>
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <form action="{{ route('admin.blog-posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Title -->
                <div class="md:col-span-2">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Post Title *</label>
                    <input type="text" id="title" name="title" required 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500"
                           value="{{ old('title') }}" placeholder="Enter post title">
                    @error('title')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Author -->
                <div>
                    <label for="author" class="block text-sm font-medium text-gray-700 mb-2">Author</label>
                    <input type="text" id="author" name="author" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500"
                           value="{{ old('author', auth()->user()->name ?? '') }}" placeholder="Author name">
                    @error('author')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Category -->
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                    @error('category')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <input type="text" id="category" name="category" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500"
                           value="{{ old('category') }}" placeholder="e.g., Technology, Tips, News">
                </div>

                <!-- Reading Time -->
                <div>
                    <label for="reading_time" class="block text-sm font-medium text-gray-700 mb-2">Reading Time (minutes)</label>
                    @error('reading_time')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <input type="number" id="reading_time" name="reading_time" min="1"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500"
                           value="{{ old('reading_time') }}" placeholder="Auto-calculated if left empty">
                </div>
            </div>

            <!-- Excerpt -->
            <div>
                <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-2">Excerpt</label>
                @error('excerpt')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
                <textarea id="excerpt" name="excerpt" rows="2"
                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500"
                          placeholder="Brief summary of the post (optional)">{{ old('excerpt') }}</textarea>
            </div> font-mono text-sm

            <!-- Content -->
            <div>
                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Content *</label>
                <textarea id="content" name="content" rows="10" required
                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500"
                          placeholder="Write your blog post content here...">{{ old('content') }}</textarea>
                @error('content')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Featured Image -->
            <div>
                <label for="featured_image" class="block text-sm font-medium text-gray-700 mb-2">Featured Image</label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-gray-400 transition-colors cursor-pointer" onclick="document.getElementById('featured_image').click()">
                    <div id="image-preview" class="hidden mb-4">
                        <img id="preview-img" src="" alt="Preview" class="max-w-xs h-48 object-cover rounded-lg mx-auto">
                    </div>
                    <div id="upload-placeholder">
                        <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-4"></i>
                        <p class="text-sm text-gray-600 mb-2">Click to upload or drag and drop</p>
                        <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                @error('featured_image')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
                    </div>
                    <input type="file" id="featured_image" name="featured_image" accept="image/*" class="hidden">
                </div>
            </div>

            <!-- Publish Status -->
            <div class="flex items-center space-x-6">
                <label class="flex items-center">
                    <input type="checkbox" id="is_published" name="is_published" value="1" class="rounded border-gray-300 text-red-600" {{ old('is_published') ? 'checked' : '' }}>
                    <span class="ml-2 text-sm font-medium text-gray-700">Publish Immediately</span>
                </label>
            </div>

            <!-- Submit -->
            <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.blog-posts.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-gray-600 transition-colors">
                    Create Post
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('featured_image');
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
