@extends('layouts.admin')

@section('title', 'Blog Settings')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Blog Settings</h1>
            <p class="text-gray-600">Configure blog page appearance and functionality</p>
        </div>
        <a href="{{ route('admin.blog-posts.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors">
            Back to Blog Posts
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Settings Form -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <form action="{{ route('admin.blog-settings.update') }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Sidebar Display -->
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Sidebar Settings</h3>
                    
                    <div class="space-y-4">
                        <!-- Show Sidebar -->
                        <div class="flex items-center">
                            <input type="checkbox" id="show_sidebar" name="show_sidebar" value="1" 
                                   class="rounded border-gray-300 text-red-600" 
                                   {{ $settings->show_sidebar ? 'checked' : '' }}>
                            <label for="show_sidebar" class="ml-3 text-sm font-medium text-gray-700">
                                Display Sidebar on Blog Page
                            </label>
                            <i class="fas fa-info-circle text-gray-400 ml-2 text-xs" title="Show or hide the sidebar with recent posts and categories"></i>
                        </div>

                        <!-- Show Recent Posts -->
                        <div class="flex items-center ml-6">
                            <input type="checkbox" id="show_recent_posts" name="show_recent_posts" value="1" 
                                   class="rounded border-gray-300 text-red-600" 
                                   {{ $settings->show_recent_posts ? 'checked' : '' }}>
                            <label for="show_recent_posts" class="ml-3 text-sm font-medium text-gray-700">
                                Show Recent Posts Section
                            </label>
                        </div>

                        <!-- Show Categories -->
                        <div class="flex items-center ml-6">
                            <input type="checkbox" id="show_categories" name="show_categories" value="1" 
                                   class="rounded border-gray-300 text-red-600" 
                                   {{ $settings->show_categories ? 'checked' : '' }}>
                            <label for="show_categories" class="ml-3 text-sm font-medium text-gray-700">
                                Show Categories Section
                            </label>
                        </div>

                        <!-- Recent Posts Count -->
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <label for="recent_posts_count" class="block text-sm font-medium text-gray-700 mb-2">
                                Number of Recent Posts to Display
                            </label>
                            <div class="flex items-center space-x-3">
                                <input type="range" id="recent_posts_count" name="recent_posts_count" 
                                       min="3" max="20" step="1"
                                       class="flex-1 h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer"
                                       value="{{ $settings->recent_posts_count }}">
                                <span id="count-display" class="text-lg font-semibold text-red-600 w-12 text-right">
                                    {{ $settings->recent_posts_count }}
                                </span>
                            </div>
                            <p class="text-xs text-gray-500 mt-2">Current: {{ $settings->recent_posts_count }} posts</p>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end space-x-4 pt-6">
                    <a href="{{ route('admin.blog-posts.index') }}" 
                       class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                        Cancel
                    </a>
                    <button type="submit" class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-gray-600 transition-colors">
                        Save Settings
                    </button>
                </div>
            </form>
        </div>

        <!-- Preview Info -->
        <div class="bg-red-50 rounded-lg shadow-sm border border-red-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Preview</h3>
            
            <div class="space-y-4">
                <div class="bg-white rounded-lg p-4 border border-gray-200">
                    <h4 class="font-semibold text-gray-900 mb-3">Blog Page Layout</h4>
                    
                    @if($settings->show_sidebar)
                        <div class="flex gap-4 text-xs">
                            <div class="flex-1 bg-gray-100 p-2 rounded">
                                <p class="font-semibold mb-2">Main Content</p>
                                <div class="space-y-2">
                                    <div class="h-4 bg-gray-300 rounded"></div>
                                    <div class="h-4 bg-gray-300 rounded"></div>
                                    <div class="h-4 bg-gray-300 rounded"></div>
                                </div>
                            </div>
                            <div class="w-32 bg-gray-100 p-2 rounded">
                                <p class="font-semibold mb-2">Sidebar</p>
                                <div class="space-y-1 text-xs">
                                    @if($settings->show_recent_posts)
                                        <p class="font-medium">Recent Posts</p>
                                    @endif
                                    @if($settings->show_categories)
                                        <p class="font-medium">Categories</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="bg-gray-100 p-4 rounded text-center text-gray-600">
                            <p class="font-semibold">Full-Width Layout</p>
                            <p class="text-xs mt-2">Sidebar is hidden</p>
                        </div>
                    @endif
                </div>

                <div class="bg-white rounded-lg p-4 border border-gray-200">
                    <h4 class="font-semibold text-gray-900 mb-3">Current Settings</h4>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Sidebar Visible:</span>
                            <span class="font-medium">
                                <i class="fas {{ $settings->show_sidebar ? 'fa-check text-green-600' : 'fa-times text-red-600' }}"></i>
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Recent Posts:</span>
                            <span class="font-medium">
                                <i class="fas {{ $settings->show_recent_posts ? 'fa-check text-green-600' : 'fa-times text-red-600' }}"></i>
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Categories:</span>
                            <span class="font-medium">
                                <i class="fas {{ $settings->show_categories ? 'fa-check text-green-600' : 'fa-times text-red-600' }}"></i>
                            </span>
                        </div>
                        <div class="flex justify-between pt-2 border-t border-gray-200">
                            <span class="text-gray-600">Recent Posts Count:</span>
                            <span class="font-medium">{{ $settings->recent_posts_count }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('recent_posts_count').addEventListener('input', function() {
    document.getElementById('count-display').textContent = this.value;
});
</script>
@endsection
