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
    
 
   

   
    
    
    <!-- Hero Section -->
    @include('components.hero')

    <!-- Trending Products -->
    <section class="py-6 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-12">
                <h2 class="text-3xl font-bold text-left mobile-heading">Recommended for you</h2>
                <a href="{{ route('products.index') }}" class="inline-block border-2 border-blue-600 text-blue-600 px-8 py-1 rounded-lg font-semibold hover:bg-gray-900 hover:text-white transition-colors mobile-btn">
                    View All
                </a>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-3 md:gap-6">
                @foreach($trendingProducts as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>
            
            {{-- <div class="text-center mt-8">
                <a href="{{ route('products.index') }}" class="inline-block border-2 border-gray-900 text-gray-900 px-8 py-3 rounded-lg font-semibold hover:bg-gray-900 hover:text-white transition-colors">
                    Explore More →
                </a>
            </div> --}}
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


    <!-- Big Sale Banner -->
    {{-- <x-banner 
        title="Big Sale Up To 70% Off"
        subtitle="Exclusive Offers For Limited Time"
        buttonText="Explore Your Order"
        buttonLink="{{ route('products.index') }}"
        backgroundColor="bg-gray-900"
    /> --}}

    <!-- Trending Categories -->
    <section class="py-6 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-left mb-12 mobile-heading">All Categories</h2>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-4 md:gap-6">
                @foreach($categories as $category)
                    <a href="{{ route('products.index', ['category' => $category->slug]) }}"
                    class="relative block rounded-2xl shadow-lg overflow-hidden h-64 p-4 rounded cat-wrapper">

                        <!-- Forced gradient background (works even if Tailwind gradient classes aren't available) -->
                        <span aria-hidden="true"
                            class="absolute inset-0 pointer-events-none cat-wrapper"
                            style="background: linear-gradient(to bottom, #DC2626, #991B1B);">
                        </span>

                        <!-- Category Title (top center) -->
                        <div class="relative z-10 absolute top-4 left-1/2 -translate-x-1/2 
                                    text-white font-bold text-lg text-center text-4xl category-title" >
                            {{ $category->name }}
                        </div>

                        <!-- Category Image (bottom 50% touching bottom) -->
                       <!-- Image at the bottom -->
                        <div class="absolute bottom-0 left-0 right-0" >
                            <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}"  class="w-full category-image"  />
                        </div>

                    </a>
                @endforeach

            </div>
        </div>
    </section>

   

 <!-- Locations -->
 @include('components.showrooms-card')
   

@endsection