@extends('layouts.app')

@section('title', $post->title . ' - K-Elec Blog')
@section('description', $post->excerpt)
@section('og_title', $post->title)
@section('og_description', $post->excerpt)
@section('og_image', Storage::url($post->featured_image))

@section('content')
<div class="bg-gray-50">
    <!-- Article Header -->
    <article class="py-8 lg:py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <nav class="flex items-center text-sm text-gray-600 mb-8">
                <a href="{{ route('home') }}" class="hover:text-red-600">Home</a>
                <i class="fas fa-chevron-right mx-2"></i>
                <a href="{{ route('blog.index') }}" class="hover:text-red-600">Blog</a>
                <i class="fas fa-chevron-right mx-2"></i>
                <span class="text-gray-900">{{ $post->title }}</span>
            </nav>

            <!-- Article Content -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    <!-- Title -->
                    <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-6">
                        {{ $post->title }}
                    </h1>

                    <!-- Meta Information -->
                    <div class="flex flex-wrap items-center gap-6 text-gray-600 mb-8 pb-8 border-b border-gray-200">
                        @if($post->author)
                            <div class="flex items-center">
                                <i class="fas fa-user-circle text-2xl mr-2 text-gray-400"></i>
                                <div>
                                    <p class="text-xs text-gray-500">By</p>
                                    <p class="font-semibold text-gray-900">{{ $post->author }}</p>
                                </div>
                            </div>
                        @endif
                        
                        <div class="flex items-center">
                            <i class="fas fa-calendar text-red-600 mr-2"></i>
                            <span>{{ $post->published_at->format('F d, Y') }}</span>
                        </div>

                        <div class="flex items-center">
                            <i class="fas fa-clock text-red-600 mr-2"></i>
                            <span>{{ $post->reading_time }} min read</span>
                        </div>

                        <div class="flex items-center">
                            <i class="fas fa-eye text-red-600 mr-2"></i>
                            <span>{{ $post->views }} views</span>
                        </div>

                        @if($post->category)
                            <span class="px-3 py-1 bg-red-100 text-red-600 rounded-full text-sm font-semibold">
                                {{ $post->category }}
                            </span>
                        @endif
                    </div>

                    <!-- Featured Image -->
                    @if($post->featured_image)
                        <div class="mb-8 rounded-lg overflow-hidden shadow-lg">
                            <img src="{{ Storage::url($post->featured_image) }}" 
                                 alt="{{ $post->title }}" 
                                 class="w-full h-auto object-cover">
                        </div>
                    @endif

                    <!-- Article Body -->
                    <div class="prose prose-lg max-w-none mb-12 text-gray-700 whitespace-pre-wrap">
                        {{ $post->content }}
                    </div>

                    <!-- Related Posts -->
                    @if($relatedPosts->count() > 0)
                        <div class="mt-16 pt-12 border-t border-gray-200">
                            <h3 class="text-2xl font-bold text-gray-900 mb-8">Related Articles</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                @foreach($relatedPosts as $relatedPost)
                                    <a href="{{ route('blog.show', $relatedPost->slug) }}" class="group">
                                        <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                                            <div class="relative h-40 bg-gray-100 overflow-hidden">
                                                <img src="{{ Storage::url($relatedPost->featured_image) }}" 
                                                     alt="{{ $relatedPost->title }}" 
                                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                            </div>
                                            <div class="p-4">
                                                <h4 class="font-semibold text-gray-900 group-hover:text-red-600 transition-colors line-clamp-2">
                                                    {{ $relatedPost->title }}
                                                </h4>
                                                <p class="text-xs text-gray-500 mt-2">
                                                    {{ $relatedPost->published_at->format('M d, Y') }}
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <!-- Share Buttons -->
                    <div class="bg-white rounded-lg shadow-lg p-6 mb-8 sticky top-4">
                        <h4 class="font-bold text-gray-900 mb-4">Share This Article</h4>
                        <div class="flex flex-col space-y-2">
                            <a href="https://twitter.com/intent/tweet?url={{ route('blog.show', $post->slug) }}&text={{ urlencode($post->title) }}" 
                               target="_blank" class="flex items-center p-3 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors">
                                <i class="fab fa-twitter text-blue-500 mr-3"></i>
                                <span class="text-sm font-medium text-gray-900">Twitter</span>
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('blog.show', $post->slug) }}" 
                               target="_blank" class="flex items-center p-3 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors">
                                <i class="fab fa-facebook text-blue-600 mr-3"></i>
                                <span class="text-sm font-medium text-gray-900">Facebook</span>
                            </a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ route('blog.show', $post->slug) }}" 
                               target="_blank" class="flex items-center p-3 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors">
                                <i class="fab fa-linkedin text-blue-700 mr-3"></i>
                                <span class="text-sm font-medium text-gray-900">LinkedIn</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>

    <!-- CTA Section -->
    <section class="bg-red-600 text-white py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold mb-4">Explore Our Latest Products</h2>
            <p class="text-red-100 mb-8">Find the perfect electronics and gadgets for your needs</p>
            <a href="{{ route('products.index') }}" class="inline-block bg-white text-red-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                Shop Now →
            </a>
        </div>
    </section>
</div>
@endsection
