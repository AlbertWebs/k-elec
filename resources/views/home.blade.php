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
    
    <style>
        .carousel-slide {
        opacity: 0;
        transform: translateX(100%);
        transition: all 1s ease-in-out;
        position: absolute;
        inset: 0; /* replaces top/left/width/height */
        }

        .carousel-slide.active {
        opacity: 1;
        transform: translateX(0);
        z-index: 10;
        }

        .carousel-container {
        position: relative;
        width: 100%;
        height: 100%;
        }
    </style>
   

   
    
    
    <!-- Hero Section -->
    <section class="bg-white py-0 lg:py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <!-- Categories Sidebar -->
                {{-- <div class="hidden lg:block lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <h3 class="text-lg font-semibold mb-4">Top Categories</h3>
                        <div class="space-y-3">
                            @foreach($categories->take(6) as $category)
                                <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="flex items-center space-x-3 p-3 hover:bg-gray-50 rounded-lg">
                                    <i class="{{ $category->icon }} text-gray-600"></i>
                                    <span class="text-gray-700">{{ $category->name }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                 --}}
                 {{--  --}}
                <div class="hidden lg:block lg:col-span-1">
                    <!-- Top Image -->
                    <div class="mb-4">
                        <img src="{{ url('/') }}/storage/{{ $bannerPosition1->image }}" alt="Top Banner" class="w-full rounded-lg object-cover">
                    </div>

                   <!-- Bottom Image -->
                    <div class="mb-0">
                        <img src="{{ url('/') }}/storage/{{ $bannerPosition2->image }}" alt="Middle Banner" class="w-full rounded-lg object-cover">
                    </div>

               
                </div>

                 {{--  --}}
                <!-- Main Banner Carousel -->
                <div class="lg:col-span-3 relative bg-blacks rounded hidden lg:block">
                    @if($carouselSlides->count() > 0)
                        <div class="carousel-container relative overflow-hidden rounded-none lg:rounded-lg -mx-4 lg:mx-0" style="min-height:560px;">
                           <div class="carousel-container relative overflow-hidden rounded-none lg:rounded-lg -mx-4 lg:mx-0" style="min-height:560px;">
                                @foreach($carouselSlides as $index => $slide)
                                    <div class="carousel-slide {{ $index === 0 ? 'active' : '' }} bg-gradient-to-r {{ $slide->background_classes }} p-4 lg:p-8 bg-cover bg-center bg-no-repeat"
                                        style="background-image: url('{{ Storage::url($slide->image) }}'); 
                                                background-size: cover; 
                                                background-position: center;">
                                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 lg:gap-8 items-center">
                                            <div style="padding-top:160px">
                                                <span class="{{ $slide->text_color_class }} font-semibold text-sm lg:text-base">{{ $slide->title }}</span>
                                                <h2 class="text-3xl lg:text-5xl xl:text-4xl font-bold text-white mt-2 mb-4" style="font-size:55px;">{{ $slide->heading }}</h2>
                                                <p class="text-white mb-6 lg:text-3xl text-md lg:text-base" style="font-size:25px; font-weight:600">{{ $slide->description }}</p>
                                                <h4 style="font-size:25px" class="text-lg font-bold text-white">Kes. 83,000</h4>

                                                <br><br>
                                                @if($slide->button_text)
                                                    <a href="{{ $slide->button_link ?? route('products.index') }}" class="inline-block bg-black text-white px-4 py-2 lg:px-6 lg:py-3 rounded-lg font-semibold hover:bg-gray-800 text-sm lg:text-base">
                                                        {{ $slide->button_text }} →
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>


                            <!-- Carousel Navigation -->
                            {{-- <button class="carousel-btn carousel-prev absolute left-2 lg:left-4 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-80 hover:bg-opacity-100 text-gray-800 p-2 rounded-full shadow-lg transition-all duration-200">
                                <svg class="w-5 h-5 lg:w-6 lg:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                            </button> --}}
                            <button class="carousel-btn carousel-next absolute right-2 lg:right-4 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-80 hover:bg-opacity-100 text-gray-800 p-2 rounded-full shadow-lg transition-all duration-200">
                                <svg class="w-5 h-5 lg:w-6 lg:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </button>
                        </div>
                        
                        <!-- Carousel Indicators -->
                        <div class="absolute bottom-2 lg:bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-1 lg:space-x-2 z-20">
                            @foreach($carouselSlides as $index => $slide)
                                <button class="carousel-dot w-6 h-1 lg:w-8 lg:h-1 bg-gray-800 {{ $index === 0 ? 'bg-opacity-80' : 'bg-opacity-50' }} hover:bg-opacity-100 rounded-full transition-all duration-200" data-slide="{{ $index }}"></button>
                            @endforeach
                        </div>
                    @else
                        <!-- Fallback when no slides are available -->
                        <div class="bg-gradient-to-r from-blue-100 to-blue-200 p-4 lg:p-8 rounded-none lg:rounded-lg -mx-4 lg:mx-0">
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 lg:gap-8 items-center">
                                <div>
                                    <span class="text-blue-600 font-semibold text-sm lg:text-base">Welcome</span>
                                    <h2 class="text-2xl lg:text-3xl xl:text-4xl font-bold text-gray-900 mt-2 mb-4">K-Elec</h2>
                                    <p class="text-gray-600 mb-6 text-sm lg:text-base">Your trusted source for quality Korean electronics and technology</p>
                                    <a href="{{ route('products.index') }}" class="inline-block bg-black text-white px-4 py-2 lg:px-6 lg:py-3 rounded-lg font-semibold hover:bg-gray-800 text-sm lg:text-base">
                                        Shop Now →
                                    </a>
                                </div>
                                <div class="hidden lg:flex justify-center lg:justify-end">
                                    <img src="{{ asset('assets/images/1-DloPm3Vx.png') }}" alt="Electronics Product" class="max-w-xs lg:max-w-sm object-cover rounded-lg shadow-lg">
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Trending Products -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-left mb-12">Recommended for you</h2>
            
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
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-left mb-12">Latest Offers</h2>
            
            <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-3 md:gap-6">
                @foreach($featuredProducts as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>
            
            <div class="text-center mt-8">
                <a href="{{ route('products.index') }}" class="inline-block border-2 border-gray-900 text-gray-900 px-8 py-3 rounded-lg font-semibold hover:bg-gray-900 hover:text-white transition-colors">
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
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-left mb-12">All Categories</h2>
            
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-4 md:gap-6">
                @foreach($categories as $category)
                    <a href="{{ route('products.index', ['category' => $category->slug]) }}"
                    class="relative block rounded-2xl shadow-lg overflow-hidden h-64 p-4 rounded" style="min-height:420px">

                        <!-- Forced gradient background (works even if Tailwind gradient classes aren't available) -->
                        <span aria-hidden="true"
                            class="absolute inset-0 pointer-events-none"
                            style="background: linear-gradient(to bottom, #DC2626, #991B1B);">
                        </span>

                        <!-- Category Title (top center) -->
                        <div class="relative z-10 absolute top-4 left-1/2 -translate-x-1/2 
                                    text-white font-bold text-lg text-center text-4xl" style="font-size: 30px; top:30px; font-weight:800">
                            {{ $category->name }}
                        </div>

                        <!-- Category Image (bottom 50% touching bottom) -->
                       <!-- Image at the bottom -->
                        <div class="absolute bottom-0 left-0 right-0" style="position:absolute; bottom:0; width:85%; margin:0 auto; height:300px; object-fit: cover">
                            <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}"  class="w-full" style="height:100%; width:100%; object-fit: cover !important; bottom:-10px !important;" />
                        </div>

                    </a>
                @endforeach

            </div>
        </div>
    </section>


   

@endsection