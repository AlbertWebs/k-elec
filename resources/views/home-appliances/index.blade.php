@extends('layouts.app')

@section('title', 'Home Appliances - All Categories - K-Elec')
@section('description', 'Shop all home appliances including kitchen, laundry, and other household products at K-Elec Kenya.')
@section('keywords', 'home appliances, kitchen appliances, laundry, household products, Kenya')
@section('og_title', 'Home Appliances - K-Elec')
@section('og_description', 'Shop all home appliances and household products at K-Elec.')
@section('og_type', 'website')
@section('og_image', asset('images/logo.png'))

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
                "description": "' . addslashes(substr($product->description ?? '', 0, 100)) . '",
                "category": "' . addslashes($product->category->name ?? 'Home Appliances') . '",
                "brand": "' . addslashes($product->brand ?? 'K-elec') . '",
                "offers": {
                    "@type": "Offer",
                    "price": "' . $product->price . '",
                    "priceCurrency": "KES",
                    "availability": "' . ($product->stock_quantity > 0 ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock') . '"
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
    "name": "Home Appliances",
    "description": "Explore all home appliances and household products available at K-elec.",
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
    <section class="w-full bg-gray-50 py-8 bg-cover bg-center">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold text-gray-900 mb-4">
                    Home Appliances
                </h1>
                <p class="text-lg text-gray-600 mb-6">
                    Discover all home appliances and household products in our complete collection
                </p>
                
                <!-- Quick Category Filter Buttons -->
                <div class="flex flex-wrap justify-center gap-2">
                    <a href="{{ route('home-appliances.index') }}" 
                       class="px-4 py-2 rounded-full {{ !request('category') ? 'bg-red-600 text-white' : 'bg-white text-gray-900 border border-gray-300' }} font-medium hover:bg-red-600 hover:text-white transition">
                        All Appliances
                    </a>
                    @forelse($allCategories as $category)
                        <a href="{{ route('home-appliances.index', ['category' => $category->slug]) }}" 
                           class="px-4 py-2 rounded-full {{ request('category') == $category->slug ? 'bg-red-600 text-white' : 'bg-white text-gray-900 border border-gray-300' }} font-medium hover:bg-red-600 hover:text-white transition text-sm">
                            {{ $category->name }}
                        </a>
                    @empty
                        <p class="text-gray-500">No categories available</p>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

            <!-- Filters Sidebar -->
            <div class="lg:col-span-1">
                <!-- Mobile Filter Toggle -->
                <div class="lg:hidden mb-4">
                    <button id="mobile-filter-toggle" class="w-full flex items-center justify-between p-4 bg-white rounded-lg shadow-sm border border-gray-200">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-filter text-gray-600"></i>
                            <span class="font-medium text-gray-900">Filters</span>
                            @if(request()->hasAny(['search', 'type', 'brand', 'sort']))
                                <span class="bg-blue-500 text-white text-xs rounded-full px-2 py-1">{{ count(array_filter(request()->only(['search', 'type', 'brand', 'sort']))) }}</span>
                            @endif
                        </div>
                        <i class="fas fa-chevron-down text-gray-500 transition-transform duration-200" id="filter-toggle-icon"></i>
                    </button>
                </div>
                
                <!-- Filters Content -->
                <div id="mobile-filters" class="lg:block hidden bg-white rounded-lg shadow-sm border border-gray-200 p-6 space-y-6">
                    <h3 class="text-lg font-semibold">Filters</h3>
                    
                    <!-- Search -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                        <form method="GET" action="{{ route('home-appliances.index') }}" class="flex">
                            <input type="text" name="search" value="{{ request('search') }}" 
                                   class="flex-1 px-4 py-2 border border-gray-300 rounded-l-lg focus:ring-red-500 focus:border-red-500"
                                   placeholder="Search appliances...">
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-r-lg hover:bg-red-700">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </div>

                    <!-- Category Filter - Dynamic -->
                    @if($allCategories->count() > 0)
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                            <div class="space-y-2">
                                <a href="{{ route('home-appliances.index') }}" 
                                   class="block text-sm {{ !request('category') ? 'text-red-600 font-medium' : 'text-gray-600 hover:text-gray-900' }}">
                                    All Categories
                                </a>
                                @foreach($allCategories as $category)
                                    <a href="{{ route('home-appliances.index', ['category' => $category->slug]) }}" 
                                       class="block text-sm {{ request('category') == $category->slug ? 'text-red-600 font-medium' : 'text-gray-600 hover:text-gray-900' }}">
                                        {{ $category->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Brand Filter - Dynamic -->
                    @if($brands->count() > 0)
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Brand</label>
                            <div class="space-y-2 max-h-48 overflow-y-auto">
                                <a href="{{ route('home-appliances.index') }}" 
                                   class="block text-sm {{ !request('brand') ? 'text-red-600 font-medium' : 'text-gray-600 hover:text-gray-900' }}">
                                    All Brands
                                </a>
                                @foreach($brands as $brand)
                                    <a href="{{ route('home-appliances.index', ['brand' => $brand]) }}" 
                                       class="block text-sm {{ request('brand') == $brand ? 'text-red-600 font-medium' : 'text-gray-600 hover:text-gray-900' }}">
                                        {{ $brand }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Clear Filters -->
                    @if(request()->hasAny(['search', 'category', 'brand', 'sort']))
                        <div class="pt-4 border-t border-gray-200">
                            <a href="{{ route('home-appliances.index') }}" 
                               class="text-sm text-red-600 hover:text-red-700 font-medium">
                                Clear All Filters
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Featured Products Sidebar -->
                <div class="mt-6 lg:mt-0">
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <h3 class="text-lg font-semibold mb-4">Featured</h3>
                        @if($featuredProducts->count() > 0)
                            <div class="space-y-4">
                                @foreach($featuredProducts as $product)
                                    <a href="{{ route('products.show', $product->slug) }}" class="block hover:bg-gray-50 rounded-lg p-2 -m-2 transition-colors">
                                        <div class="flex space-x-3">
                                            <img src="{{ $product->main_image_url }}" alt="{{ $product->name }}" class="w-16 h-16 object-cover rounded">
                                            <div class="flex-1">
                                                <h4 class="text-sm font-medium text-gray-900 hover:text-red-600 transition-colors line-clamp-2">{{ $product->name }}</h4>
                                                <p class="text-sm text-gray-600 font-semibold">{{ $product->formatted_price }}</p>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 text-sm">No featured products</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="lg:col-span-3">
                <!-- Sort and View Options -->
                <div class="flex justify-between items-center mb-6">
                    <div class="flex items-center space-x-2">
                        <svg class="mx-auto h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-sm">Showing {{ $products->firstItem() ?? 0 }} - {{ $products->lastItem() ?? 0 }} of {{ $totalProducts }} products</span>
                    </div>

                    <form method="GET" action="{{ route('home-appliances.index') }}" class="flex items-center">
                        @foreach(request()->except('sort') as $key => $value)
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach
                        <select name="sort" onchange="this.form.submit()" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500">
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Newest</option>
                            <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                            <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Highest Rated</option>
                            <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Most Popular</option>
                            <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name A-Z</option>
                        </select>
                    </form>
                </div>

                <!-- Products Grid -->
                @if($products->count() > 0)
                    <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-3 md:gap-6">
                        @foreach($products as $product)
                            <x-product-card :product="$product" />
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-8">
                        {{ $products->links() }}
                    </div>
                @else
                    <!-- No Products Found -->
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                        </svg>
                        <h3 class="mt-2 text-lg font-medium text-gray-900">No products found</h3>
                        <p class="mt-1 text-gray-500">Try adjusting your filters or search criteria</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterToggle = document.getElementById('mobile-filter-toggle');
    const mobileFilters = document.getElementById('mobile-filters');
    const filterIcon = document.getElementById('filter-toggle-icon');

    if (filterToggle) {
        filterToggle.addEventListener('click', function() {
            mobileFilters.classList.toggle('hidden');
            filterIcon.style.transform = mobileFilters.classList.contains('hidden') ? 'rotate(0)' : 'rotate(180deg)';
        });
    }
});
</script>
@endpush
