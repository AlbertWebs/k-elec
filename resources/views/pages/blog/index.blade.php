@extends('layouts.app')

@section('title', 'K-Elec Blog - Technology Tips, News & Guides')
@section('description', 'Read the latest technology tips, product reviews, and industry news on the K-Elec blog. Stay informed about electronics and gadgets.')
@section('og_title', 'K-Elec Blog - Technology Tips & News')
@section('og_description', 'Discover helpful guides, product reviews, and technology news on our blog.')

@section('content')
<div class="bg-gray-50">
    <!-- Hero Section -->
    <section class="bg-red-600 text-white py-12 lg:py-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto text-center">
                <h1 class="text-4xl lg:text-5xl font-bold mb-4">
                    K-Elec Blog
                </h1>
                <p class="text-xl text-red-100 mb-8">
                    Technology tips, product guides, and industry news to help you make the most of your electronics
                </p>
                <div class="flex items-center justify-center space-x-2 text-red-100">
                    <i class="fas fa-bookmark"></i>
                    <span>Stay Updated • Expert Tips • Product Reviews</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Content -->
    <section class="py-16 lg:py-24">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 {{ $blogSettings->show_sidebar ? 'lg:grid-cols-3' : 'lg:grid-cols-1' }} gap-8">
                <!-- Main Blog Posts -->
                <div class="{{ $blogSettings->show_sidebar ? 'lg:col-span-2' : 'lg:col-span-1' }}">
                    @if($posts->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            @foreach($posts as $post)
                                <article class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                                    <!-- Featured Image -->
                                    <div class="relative h-48 bg-gray-100 overflow-hidden group">
                                        <img src="{{ Storage::url($post->featured_image) }}" 
                                             alt="{{ $post->title }}" 
                                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                        @if($post->category)
                                            <div class="absolute top-3 left-3">
                                                <span class="px-3 py-1 bg-red-600 text-white text-xs font-semibold rounded-full">
                                                    {{ $post->category }}
                                                </span>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Content -->
                                    <div class="p-6 space-y-4">
                                        <!-- Title -->
                                        <a href="{{ route('blog.show', $post->slug) }}" class="group">
                                            <h3 class="text-xl font-bold text-gray-900 group-hover:text-red-600 transition-colors">
                                                {{ $post->title }}
                                            </h3>
                                        </a>

                                        <!-- Excerpt -->
                                        <p class="text-gray-600 text-sm line-clamp-2">
                                            {{ $post->excerpt }}
                                        </p>

                                        <!-- Meta Information -->
                                        <div class="flex items-center justify-between text-xs text-gray-500 pt-4 border-t border-gray-200">
                                            <div class="flex items-center space-x-4">
                                                @if($post->author)
                                                    <span class="flex items-center">
                                                        <i class="fas fa-user mr-1"></i>
                                                        {{ $post->author }}
                                                    </span>
                                                @endif
                                                <span class="flex items-center">
                                                    <i class="fas fa-calendar mr-1"></i>
                                                    {{ $post->published_at->format('M d, Y') }}
                                                </span>
                                            </div>
                                            <span class="flex items-center">
                                                <i class="fas fa-clock mr-1"></i>
                                                {{ $post->reading_time }} min
                                            </span>
                                        </div>

                                        <!-- Read More Button -->
                                        <a href="{{ route('blog.show', $post->slug) }}" 
                                           class="inline-flex items-center text-red-600 font-semibold hover:text-red-700 transition-colors">
                                            Read More <i class="fas fa-arrow-right ml-2"></i>
                                        </a>
                                    </div>
                                </article>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-12">
                            {{ $posts->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <i class="fas fa-file-alt text-6xl text-gray-300 mb-4"></i>
                            <h3 class="text-2xl font-bold text-gray-900 mb-2">No Blog Posts Yet</h3>
                            <p class="text-gray-600">
                                @if(request('category'))
                                    No posts found in this category. 
                                    <a href="{{ route('blog.index') }}" class="text-red-600 hover:text-red-700 font-semibold">View all posts</a>
                                @else
                                    Stay tuned for exciting content!
                                @endif
                            </p>
                        </div>
                    @endif
                </div>

                <!-- Sidebar -->
                @if($blogSettings->show_sidebar)
                    <div class="lg:col-span-1">
                        <!-- Recent Posts -->
                        @if($blogSettings->show_recent_posts)
                            <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
                                <h3 class="text-xl font-bold text-gray-900 mb-6">
                                    <i class="fas fa-fire text-red-600 mr-2"></i>Recent Posts
                                </h3>
                                <div class="space-y-4">
                                    @forelse($recentPosts as $post)
                                        <a href="{{ route('blog.show', $post->slug) }}" class="group block">
                                            <p class="text-sm font-semibold text-gray-900 group-hover:text-red-600 transition-colors line-clamp-2">
                                                {{ $post->title }}
                                            </p>
                                            <p class="text-xs text-gray-500 mt-1">
                                                {{ $post->published_at->format('M d, Y') }}
                                            </p>
                                        </a>
                                    @empty
                                        <p class="text-sm text-gray-600">No posts yet</p>
                                    @endforelse
                                </div>
                            </div>
                        @endif

                        <!-- Categories -->
                        @if($blogSettings->show_categories && $categories->count() > 0)
                            <div class="bg-white rounded-lg shadow-lg p-6">
                                <h3 class="text-xl font-bold text-gray-900 mb-6">
                                    <i class="fas fa-folder text-red-600 mr-2"></i>Categories
                                </h3>
                                <div class="space-y-3">
                                    <!-- All Categories Link -->
                                    <a href="{{ route('blog.index') }}" 
                                       class="flex items-center justify-between p-3 rounded-lg {{ !request('category') ? 'bg-red-50 border border-red-200' : 'bg-gray-50 hover:bg-red-50' }} transition-colors">
                                        <span class="font-medium {{ !request('category') ? 'text-red-600' : 'text-gray-900' }}">
                                            All Posts
                                        </span>
                                        <i class="fas fa-arrow-right {{ !request('category') ? 'text-red-600' : 'text-gray-400' }}"></i>
                                    </a>

                                    <!-- Category Links -->
                                    @foreach($categories as $category)
                                        @php
                                            $categoryPostCount = \App\Models\BlogPost::published()
                                                ->where('category', $category)
                                                ->count();
                                        @endphp
                                        <a href="{{ route('blog.index', ['category' => $category]) }}" 
                                           class="flex items-center justify-between p-3 rounded-lg {{ request('category') == $category ? 'bg-red-50 border border-red-200' : 'bg-gray-50 hover:bg-red-50' }} transition-colors">
                                            <div>
                                                <span class="font-medium {{ request('category') == $category ? 'text-red-600' : 'text-gray-900' }} block">
                                                    {{ $category }}
                                                </span>
                                                <span class="text-xs text-gray-500">{{ $categoryPostCount }} {{ Str::plural('post', $categoryPostCount) }}</span>
                                            </div>
                                            <i class="fas fa-arrow-right {{ request('category') == $category ? 'text-red-600' : 'text-gray-400' }}"></i>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </section>
</div>
@endsection
