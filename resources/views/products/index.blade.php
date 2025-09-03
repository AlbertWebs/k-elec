@extends('layouts.app-products')

@section('title', isset($pageTitle) ? $pageTitle . ' in kenya - K-elec' : 'Products - K-elec')
@section('description', isset($pageTitle) ? 'Shop the latest ' . $pageTitle . ' products in Kenya. Find smartphones, laptops, cameras, tablets, and more at K-elec. Fast delivery and excellent customer service.' : 'Shop a wide range of electronics and technology products in Kenya at K-elec. Fast delivery and excellent customer service.')
@section('keywords', isset($pageTitle) ? 'electronics Kenya, ' . strtolower($pageTitle) . ', smartphones Nairobi, laptops Kenya, cameras Kenya, tablets Kenya, technology store, K-elec, online electronics shop' : 'electronics Kenya, smartphones Nairobi, laptops Kenya, cameras Kenya, tablets Kenya, technology store, K-elec, online electronics shop')
@section('og_title', isset($pageTitle) ? $pageTitle . ' - K-elec' : 'Products - K-elec')
@section('og_description', isset($pageTitle) ? 'Shop the latest ' . $pageTitle . ' products in Kenya. Find smartphones, laptops, cameras, and more at K-elec.' : 'Shop a wide range of electronics and technology products in Kenya at K-elec.')
@section('og_type', 'website')
@section('og_image', asset('images/logo.svg'))

@section('structured_data')
@php
    $itemListElements = [];
    foreach($products as $index => $product) {
        $itemListElements[] = '{
            "@type": "ListItem",
            "position": ' . ($index + 1) . ',
            "item": {
                "@type": "Product",
                "name": "' . addslashes($product->name) . '",
                "url": "' . route('products.show', $product->slug) . '",
                "image": "' . $product->main_image_url . '",
                "description": "' . addslashes($product->description) . '",
                "category": "' . addslashes($product->category->name ?? 'Electronics') . '",
                "brand": "' . addslashes($product->brand ?? 'K-elec') . '",
                "offers": {
                    "@type": "Offer",
                    "price": "' . $product->price . '",
                    "priceCurrency": "KES",
                    "availability": "' . ($product->stock > 0 ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock') . '"
                }
            }
        }';
    }
    $itemListJson = implode(',', $itemListElements);
@endphp
{!! '<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "ItemList",
    "name": "' . (isset($pageTitle) ? $pageTitle : 'Electronics & Technology') . ' Products",
    "description": "' . (isset($pageTitle) ? 'Explore a wide range of ' . $pageTitle . ' products in Kenya. Shop smartphones, laptops, tablets, cameras, and more from K-elec.' : 'Explore a wide range of electronics and technology products in Kenya from K-elec.') . '",
    "url": "' . request()->url() . '",
    "numberOfItems": ' . $products->count() . ',
    "itemListElement": [
        ' . $itemListJson . '
    ]
}
</script>' !!}
@endsection



@section('content')
    <!-- Page Header -->
 <section class="w-full bg-gray-50 py-8 bg-cover bg-center min-h-[500px]" style="background-image: url('{{ asset('storage/' . $category->featured) }}'); background-position:contain; background-repeat:no-repeat; height:680px !important; ">
     {{--  --}}
<div class="container mx-auto px-4 sm:px-6 lg:px-8 h-full">
    <div class="grid grid-cols-1 md:grid-cols-2 items-center h-full gap-6">
        
        <!-- Left column: Image category -->
        <div class="flex justify-center">
            <img src="{{ asset('storage/' . $category->image) }}" alt="Banner Image" class="" style="width:100% !important; height:100%; object-fit:cover; position:relative; bottom:0px z-index: ">
        </div>
        
        <!-- Right column: Title -->
        <div class="text-right">
            <h1 class="text-4xl text-white leading-tight " style="font-size:90px; font-weight:900 !important; max-width:400px; float:right;">
                {{ $pageTitle ?? 'All Products' }}
            </h1>
        </div>
        
    </div>
</div>

     {{--  --}}
</section>



    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8" style="z-index:1">
        <div class="grid grid-cols-1 {{ $show_product_filters == '1' ? 'lg:grid-cols-4' : 'lg:grid-cols-3' }} gap-8">

            @if($show_product_filters == '1')
                <!-- Filters Sidebar -->
                <div class="lg:col-span-1">
                    <!-- Mobile Filter Toggle -->
                    <div class="lg:hidden mb-4">
                        <button id="mobile-filter-toggle" class="w-full flex items-center justify-between p-4 bg-white rounded-lg shadow-sm border border-gray-200">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-filter text-gray-600"></i>
                                <span class="font-medium text-gray-900">Filters</span>
                                @if(request()->hasAny(['search', 'category', 'min_price', 'max_price', 'rating', 'sort']))
                                    <span class="bg-blue-500 text-white text-xs rounded-full px-2 py-1">{{ count(array_filter(request()->only(['search', 'category', 'min_price', 'max_price', 'rating', 'sort']))) }}</span>
                                @endif
                            </div>
                            <i class="fas fa-chevron-down text-gray-500 transition-transform duration-200" id="filter-toggle-icon"></i>
                        </button>
                    </div>
                    
                    <!-- Filters Content -->
                    <div id="mobile-filters" class="lg:block hidden bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <h3 class="text-lg font-semibold mb-6">Filters</h3>
                        
                        <!-- Search -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                            <form method="GET" action="{{ route('products.index') }}">
                                <input type="text" 
                                    name="search" 
                                    value="{{ request('search') }}"
                                    placeholder="Search products..."
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </form>
                        </div>

                        <!-- Categories -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Categories</label>
                            <div class="space-y-2">
                                <a href="{{ route('products.index') }}" 
                                class="block text-sm {{ !request('category') ? 'text-blue-600 font-medium' : 'text-gray-600 hover:text-gray-900' }}">
                                    All Categories
                                </a>
                                @foreach($categories as $category)
                                    <a href="{{ route('products.index', ['category' => $category->slug] + request()->except('category')) }}" 
                                    class="block text-sm {{ request('category') == $category->slug ? 'text-blue-600 font-medium' : 'text-gray-600 hover:text-gray-900' }}">
                                        {{ $category->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        <!-- Price Range -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Price Range</label>
                            <form method="GET" action="{{ route('products.index') }}" id="price-form">
                                @if(request('min_price') || request('max_price'))
                                    <input type="hidden" name="min_price" value="{{ request('min_price') }}">
                                    <input type="hidden" name="max_price" value="{{ request('max_price') }}">
                                @endif
                                <div class="space-y-2">
                                    <input type="range" 
                                        id="price-range" 
                                        min="{{ $minPrice }}" 
                                        max="{{ $maxPrice }}" 
                                        value="{{ request('max_price', $maxPrice) }}"
                                        class="w-full">
                                    <div class="flex justify-between text-sm text-gray-500">
                                        <span>KES {{ number_format($minPrice, 0) }}</span>
                                        <span id="price-value">KES {{ number_format(request('max_price', $maxPrice), 0) }}</span>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Rating Filter -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Rating</label>
                            <div class="space-y-2">
                                @for($i = 5; $i >= 1; $i--)
                                    <a href="{{ route('products.index', ['rating' => $i] + request()->except('rating')) }}" 
                                    class="flex items-center text-sm {{ request('rating') == $i ? 'text-blue-600 font-medium' : 'text-gray-600 hover:text-gray-900' }}">
                                        <div class="flex items-center mr-2">
                                            @for($star = 1; $star <= 5; $star++)
                                                <svg class="w-4 h-4 {{ $star <= $i ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                </svg>
                                            @endfor
                                        </div>
                                        <span>{{ $i }}+ Stars</span>
                                    </a>
                                @endfor
                            </div>
                        </div>

                        <!-- Clear Filters -->
                        @if(request()->hasAny(['search', 'category', 'min_price', 'max_price', 'rating', 'sort']))
                            <div class="pt-4 border-t border-gray-200">
                                <a href="{{ route('products.index') }}" 
                                class="text-sm text-red-600 hover:text-red-700 font-medium">
                                    Clear All Filters
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- Featured Products Sidebar -->
                    <div class="mt-6 lg:mt-0">
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                            <h3 class="text-lg font-semibold mb-4">Featured Products</h3>
                            <div class="space-y-4">
                                @foreach($featuredProducts as $product)
                                    <a href="{{ route('products.show', $product->slug) }}" class="block hover:bg-gray-50 rounded-lg p-2 -m-2 transition-colors">
                                        <div class="flex space-x-3">
                                            <img src="{{ $product->main_image_url }}" alt="{{ $product->name }}" class="w-16 h-16 object-cover rounded">
                                            <div class="flex-1">
                                                <h4 class="text-sm font-medium text-gray-900 hover:text-blue-600 transition-colors">{{ $product->name }}</h4>
                                                <p class="text-sm text-gray-500">{{ $product->formatted_price }}</p>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Products Grid -->
            <div class="{{ $show_product_filters == '1' ? 'lg:col-span-3' : 'lg:col-span-3 lg:col-start-1 lg:col-end-4' }}">
                <!-- Sort and View Options -->
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
                    <div class="flex items-center space-x-4 mb-4 sm:mb-0">
                        <span class="text-sm text-gray-500">Sort by:</span>
                        <select name="sort" 
                                onchange="window.location.href='{{ route('products.index') }}?sort=' + this.value + '&' + new URLSearchParams(window.location.search).toString().replace(/sort=[^&]*&?/g, '')"
                                class="text-sm border border-gray-300 rounded-lg px-3 py-1 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="latest" {{ request('sort', 'latest') == 'latest' ? 'selected' : '' }}>Latest</option>
                            <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                            <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Highest Rated</option>
                            <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Most Popular</option>
                            <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name A-Z</option>
                        </select>
                    </div>
                    
                    <div class="flex items-center space-x-2">
                         
                        <button class="p-2 text-gray-600" title="List View">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                            </svg>
                        </button>Showing {{ $products->firstItem() ?? 0 }} - {{ $products->lastItem() ?? 0 }} of {{ $totalProducts }} products
                    </div>
                </div>

                <!-- Products Grid -->
                @if($products->count() > 0)
                    @if($show_product_filters == '1')
                       <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-3 md:gap-6">
                    @else
                        <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-3 md:gap-6">
                    @endif
                        @foreach($products as $product)
                            <x-product-card :product="$product" />
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-8">
                        {{ $products->links() }}
                    </div>
                @else

                @if(session('success'))
                    <div class="mt-4 p-3 bg-green-100 text-green-700 rounded-lg text-center">
                        {{ session('success') }}
                    </div>
                @endif

                    <!-- No Products Found -->
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                        </svg>

                        <h3 class="mt-4 text-lg font-semibold text-gray-900">🚀 Coming Soon!</h3>
                        <p class="mt-2 text-sm text-gray-500">This product is not yet available. Leave your email and we’ll notify you once it’s live.</p>

                        <!-- Subscribe Form -->
                        <form action="{{ route('subscribe') }}" method="POST" class="mt-6 max-w-md mx-auto flex gap-2">
                            @csrf
                            <input type="email" name="email" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-l focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm"
                                placeholder="Enter your email address">
                            <button type="submit"
                                    class="px-4 py-2 bg-blue-600 text-white font-medium rounded-r hover:bg-blue-700 transition">
                                Notify Me
                            </button>
                        </form>
                    </div>

                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Price range slider
    const priceRange = document.getElementById('price-range');
    const priceValue = document.getElementById('price-value');
    const priceForm = document.getElementById('price-form');
    
    if (priceRange && priceValue) {
        priceRange.addEventListener('input', function() {
            const value = this.value;
            priceValue.textContent = 'KES ' + parseInt(value).toLocaleString();
        });
        
        priceRange.addEventListener('change', function() {
            const url = new URL(window.location);
            url.searchParams.set('max_price', this.value);
            window.location.href = url.toString();
        });
    }
});
</script>
@endpush 