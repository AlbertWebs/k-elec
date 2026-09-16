@extends('layouts.app')

@section('title', 'K-Elec - Quality Korean Electronics & Technology Store in Kenya')
@section('description', 'Shop the latest electronics and technology products in Kenya. Find smartphones, laptops, cameras, and more at K-Elec. Fast delivery and excellent customer service.')
@section('keywords', 'electronics Kenya, smartphones Nairobi, laptops Kenya, cameras Kenya, technology store, K-Elec, online electronics shop')
@section('og_title', 'K-Elec - quality Korean electronics & Technology Store in Kenya')
@section('og_description', 'Shop the latest electronics and technology products in Kenya. Find smartphones, laptops, cameras, and more at K-Elec.')
@section('og_type', 'website')
@section('og_image', asset('images/logo.png'))



@section('structured_data')
@php
    $socialUrls = \App\Helpers\SocialMediaHelper::getSameAsArray();
    $sameAsJson = '';
    if (!empty($socialUrls)) {
        $sameAsJson = '"' . implode('","', $socialUrls) . '"';
    } else {
        $sameAsJson = '"https://example.com"';
    }
@endphp
{!! '<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Organization",
    "name": "K-Elec",
    "url": "' . url('/') . '",
    "logo": "' . asset('images/logo.png') . '",
    "description": "Your trusted source for quality Korean electronics and technology in Kenya",
    "address": {
        "@type": "PostalAddress",
        "addressCountry": "KE",
        "addressLocality": "Nairobi"
    },
    "contactPoint": {
        "@type": "ContactPoint",
        "contactType": "customer service"
    },
    "sameAs": [
        ' . $sameAsJson . '
    ]
}
</script>' !!}

{!! '<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "WebSite",
    "name": "K-Elec",
    "url": "' . url('/') . '",
    "potentialAction": {
        "@type": "SearchAction",
        "target": "' . url('/products') . '?search={search_term_string}",
        "query-input": "required name=search_term_string"
    }
}
</script>' !!}
@endsection

@section('content')
    
 
   

   
    
    
    <!-- Homepage Video (above hero) -->
    @include('components.homepage-video')

    <!-- Hero Section -->
    @include('components.hero')
    <!-- About Us Section -->
    @include('components.about-us')
    <!-- Key Features Section -->
    @include('components.key-features')
    <!-- Trending Categories -->
    <section class="py-6 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-left mb-12 mobile-heading">All Categories</h2>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-4 md:gap-6">
                @php
                    $allowedCategories = [
                        'Television & Audio',
                        'Refrigerators',
                        'Air Conditioners',
                        'Kitchen Appliances',
                        'Washing Machines',
                        'Mini- Refrigerators'
                    ];
                    $filteredCategories = $categories->whereIn('name', $allowedCategories);
                @endphp
                @foreach($filteredCategories as $category)
                    <a href="{{ route('products.index', ['category' => $category->slug]) }}"
                    class="relative block rounded-2xl shadow-lg overflow-hidden h-48 p-4 rounded cat-wrapper">

                        <!-- Forced gradient background (works even if Tailwind gradient classes aren't available) -->
                        <span aria-hidden="true"
                            class="absolute inset-0 pointer-events-none"
                            style="background: linear-gradient(to bottom, #DC2626, #991B1B);">
                        </span>

                        <!-- Category Title (top center) -->
                        <div class="relative z-10 absolute top-4 left-1/2 -translate-x-1/2 
                                    text-white font-bold text-lg text-center text-4xl category-title" >
                            {{ $category->name }}
                        </div>

                        <!-- Category Image (bottom 50% touching bottom) -->
                       <!-- Image at the bottom -->
                       <div class="absolute bottom-0 left-1/2 -translate-x-1/2 flex justify-center w-full">
                        <img src="{{ asset('storage/' . $category->image) }}" 
                            alt="{{ $category->name }}"  
                            class="category-image" />
                        </div>

                    </a>
                @endforeach

            </div>
        </div>
    </section>
    
     <!-- Trending Products -->
    <section class="py-6 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Latest Offers --}}
            <div class="flex justify-between items-center mb-12">
                <h2 class="text-3xl font-bold text-left mobile-heading">Latest Offers</h2>
                <a href="{{ route('products.index') }}" class="inline-block border-2 border-blue-600 text-blue-600 px-8 py-1 rounded-lg font-semibold hover:bg-gray-900 hover:text-white transition-colors mobile-btn">
                    View All
                </a>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-3 md:gap-6">
                @foreach($featuredProducts as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>
            
            <div class="text-center mt-8">
                <a href="{{ route('products.index') }}" class="inline-block border-2 border-gray-900 text-gray-900 px-8 py-3 rounded-lg font-semibold hover:bg-gray-900 hover:text-white transition-colors mobile-btn">
                    Explore More →
                </a>
            </div>
        </div>
    </section>
    
    <!-- Retailers & Partners Slider -->
    @include('components.retailers-slider')

    <!-- Big Sale Banner -->
    {{-- <x-banner 
        title="Big Sale Up To 70% Off"
        subtitle="Exclusive Offers For Limited Time"
        buttonText="Explore Your Order"
        buttonLink="{{ route('products.index') }}"
        backgroundColor="bg-gray-900"
    /> --}}

    

   

 <!-- Locations -->
 @include('components.brandshops-card', ['shops' => $shops])

    <!-- Subscriptions -->
    <section class="py-12 bg-red-600">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl mx-auto text-center">
                <h2 class="text-3xl font-bold text-white mb-4">Stay Updated</h2>
                <p class="text-red-100 mb-8">
                    Subscribe to our newsletter and be the first to know about new products, exclusive offers, and special promotions.
                </p>

                @if(session('success'))
                    <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                <form id="subscription-form" method="POST" data-action="{{ route('subscriptions.store') }}" class="flex flex-col gap-4">
                    @csrf

                    <input type="email" id="subscription-email" name="email" required 
                        class="w-full px-4 py-3 rounded-lg focus:ring-2 focus:ring-white focus:border-0"
                        placeholder="Enter your email address">

                    <input type="tel" id="subscription-phone" name="phone" required 
                        class="w-full px-4 py-3 rounded-lg focus:ring-2 focus:ring-white focus:border-0"
                        placeholder="Enter your phone number">

                    <button type="submit" 
                            class="inline-block bg-white text-red-600 px-6 sm:px-8 py-2.5 sm:py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors text-sm sm:text-base">
                        Subscribe
                    </button>
                </form>

                <div id="subscription-message" class="hidden mt-4"></div>
            </div>
        </div>
    </section>
   

@endsection