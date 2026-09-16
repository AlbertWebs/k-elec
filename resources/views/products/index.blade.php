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
<style>
/* Desktop version (default) */
.title-stylins {
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
    font-weight: 900;
    font-size: 80px !important;
}

/* Mobile version (screens <= 640px) */
@media (max-width: 640px) {
    .title-stylins {
        font-size: 28px !important; /* adjust for mobile */
        line-height: 1.2; /* optional for readability */
    }
}

/* Optional: Tablet version (641px - 1024px) */
@media (min-width: 641px) and (max-width: 1024px) {
    .title-stylins {
        font-size: 50px !important; /* adjust for tablet */
    }
}
</style>



@section('content')
    <!-- Page Header -->
<section class="w-full bg-gray-50 py-8 bg-cover bg-center" 
         style="background-image: url('{{ asset('storage/' . $category->featured) }}'); background-repeat: no-repeat; background-size: cover;">
  <div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 md:grid-cols-2 items-center gap-6">
      
      <!-- Left column: Image category -->
      <div class="flex justify-center">
        <img src="{{ asset('storage/' . $category->image) }}" 
             alt="Banner Image" 
             class="w-full h-auto object-cover rounded-md shadow-lg" style="max-height:584px; object-fit: contain;">
      </div>
      
      <!-- Right column: Title -->
      <div class="text-center md:text-right">
        <h1 class="text-white font-extrabold leading-tight 
                   text-4xl sm:text-5xl md:text-6xl lg:text-7xl xl:text-8xl max-w-full md:max-w-md title-stylins">
          {{ $pageTitle ?? 'All Products' }}
        </h1>
      </div>

    </div>
  </div>
</section>




    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
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
                        {{-- <div class="mb-6">
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
                        </div> --}}

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
                                                {{-- <p class="text-sm text-gray-500">{{ $product->formatted_price }}</p> --}}
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
                       <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-3 md:gap-6" id="products-container">
                    @else
                        <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-3 md:gap-6" id="products-container">
                    @endif
                        @foreach($products as $product)
                            <x-product-card :product="$product" />
                        @endforeach
                    </div>

                    <!-- Show More Button -->
                    @if($products->hasMorePages())
                        <div class="mt-8 text-center">
                            <button id="load-more-btn" 
                                    class="bg-white text-red-600 px-8 py-3 rounded-lg font-semibold border-2 border-red-600 hover:bg-red-50 transition-colors"
                                    data-next-page="2"
                                    data-loading="false">
                                <i class="fas fa-chevron-down mr-2"></i>
                                Show More Products
                            </button>
                            <p class="text-sm text-gray-500 mt-3">
                                Showing <span id="product-count">{{ $products->count() }}</span> of {{ $totalProducts }} products
                            </p>
                        </div>
                    @endif
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
                            <button style="min-width:150px" type="submit" class="px-8 py-2 bg-red-600 text-white font-medium rounded-r hover:bg-red-700 transition">
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
    console.log('=== Products Page Loaded ===');
    
    // Mobile Filter Toggle
    const mobileFilterToggle = document.getElementById('mobile-filter-toggle');
    const mobileFilters = document.getElementById('mobile-filters');
    const filterToggleIcon = document.getElementById('filter-toggle-icon');
    
    if (mobileFilterToggle && mobileFilters) {
        mobileFilterToggle.addEventListener('click', function() {
            mobileFilters.classList.toggle('hidden');
            if (filterToggleIcon) {
                filterToggleIcon.style.transform = mobileFilters.classList.contains('hidden') ? 'rotate(0)' : 'rotate(180deg)';
            }
        });
    }

    // Price range slider
    const priceRange = document.getElementById('price-range');
    const priceValue = document.getElementById('price-value');
    
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

    // Show More Products Handler
    console.log('Initializing load more handler');
    const loadMoreBtn = document.getElementById('load-more-btn');
    const productsContainer = document.getElementById('products-container');
    
    console.log('Load more button found:', !!loadMoreBtn);
    console.log('Products container found:', !!productsContainer);
    
    if (!loadMoreBtn || !productsContainer) {
        console.log('Load more button or products container not found - skipping handler');
        return;
    }
    
    console.log('Load more handler successfully attached');
    
    loadMoreBtn.addEventListener('click', function(e) {
        console.log('=== LOAD MORE BUTTON CLICKED ===');
        e.preventDefault();
        e.stopPropagation();
        
        // Prevent multiple clicks
        if (loadMoreBtn.dataset.loading === 'true') {
            console.log('Already loading, preventing duplicate request');
            return;
        }
        
        loadMoreBtn.dataset.loading = 'true';
        const originalText = loadMoreBtn.innerHTML;
        const nextPage = parseInt(loadMoreBtn.dataset.nextPage);
        
        console.log('Next page to load:', nextPage);
        console.log('Original button text:', originalText);
        
        loadMoreBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Loading...';
        loadMoreBtn.disabled = true;
        
        // Build URL with all current filters
        const url = new URL(window.location.href);
        url.searchParams.set('page', nextPage);
        
        console.log('Fetching from URL:', url.toString());
        console.log('Request headers:', {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        });
        
        fetch(url.toString(), {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            },
            credentials: 'same-origin'
        })
        .then(response => {
            console.log('Response received!');
            console.log('Status:', response.status);
            console.log('Headers:', {
                'content-type': response.headers.get('content-type')
            });
            
            if (!response.ok) {
                throw new Error(`HTTP ${response.status}: ${response.statusText}`);
            }
            
            return response.json();
        })
        .then(data => {
            console.log('=== JSON DATA RECEIVED ===');
            console.log('Full data object:', data);
            console.log('Data keys:', Object.keys(data));
            console.log('Has html:', !!data.html);
            console.log('Has hasMore:', !!data.hasMore);
            console.log('Has nextPage:', !!data.nextPage);
            if (data.html) {
                console.log('HTML length:', data.html.length);
                console.log('First 200 chars of HTML:', data.html.substring(0, 200));
            }
            
            if (!data.html) {
                throw new Error('No HTML content in response');
            }
            
            // Parse the HTML response
            const parser = new DOMParser();
            const doc = parser.parseFromString(data.html, 'text/html');
            const productCards = doc.querySelectorAll('article');
            
            console.log(`Found ${productCards.length} product cards to append`);
            
            if (productCards.length === 0) {
                console.warn('WARNING: No product cards found in HTML');
                console.warn('HTML content:', data.html);
            }
            
            // Append each product card
            let appendedCount = 0;
            productCards.forEach((card, index) => {
                const clone = card.cloneNode(true);
                productsContainer.appendChild(clone);
                appendedCount++;
            });
            
            console.log(`Successfully appended ${appendedCount} cards`);
            
            // Update product count display
            const currentCount = productsContainer.children.length;
            const productCountEl = document.getElementById('product-count');
            if (productCountEl) {
                productCountEl.textContent = currentCount;
                console.log('Updated product count display to:', currentCount);
            }
            
            // Check if there are more pages
            if (data.hasMore) {
                console.log('More pages available, next page:', data.nextPage);
                loadMoreBtn.dataset.nextPage = data.nextPage;
                loadMoreBtn.innerHTML = originalText;
                loadMoreBtn.disabled = false;
                loadMoreBtn.dataset.loading = 'false';
            } else {
                console.log('No more pages - hiding button');
                // No more products, replace button with message
                const buttonContainer = loadMoreBtn.parentElement;
                buttonContainer.innerHTML = `
                    <p class="text-sm text-gray-500 mt-3">
                        Showing all ${currentCount} products
                    </p>
                `;
            }
        })
        .catch(error => {
            console.error('=== ERROR ===');
            console.error('Error message:', error.message);
            console.error('Error stack:', error.stack);
            
            loadMoreBtn.innerHTML = originalText;
            loadMoreBtn.disabled = false;
            loadMoreBtn.dataset.loading = 'false';
            
            // Show error message
            const errorDiv = document.createElement('div');
            errorDiv.className = 'mt-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg';
            errorDiv.innerHTML = `<strong>Error:</strong> ${error.message}`;
            loadMoreBtn.parentElement.insertBefore(errorDiv, loadMoreBtn);
            
            // Remove error after 5 seconds
            setTimeout(() => {
                errorDiv.remove();
            }, 5000);
        });
    });
});
</script>
@endpush

 