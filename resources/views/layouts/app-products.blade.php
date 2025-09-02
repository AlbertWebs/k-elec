<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- SEO Meta Tags -->
    <title>@yield('title', config('app.name', 'K-Elec') . ' - Quality Korean electronics & Technology in Kenya')</title>
    <meta name="description" content="@yield('description', 'K-Elec - Your trusted source for quality Korean electronics and technology in Kenya. Shop smartphones, laptops, cameras, and more with excellent customer service.')">
    <meta name="keywords" content="@yield('keywords', 'electronics, technology, smartphones, laptops, cameras, Kenya, K-Elec, online shopping')">
    <meta name="author" content="K-Elec">
    <meta name="robots" content="index, follow">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="@yield('og_title', config('app.name', 'K-Elec'))">
    <meta property="og:description" content="@yield('og_description', 'Your trusted source for quality Korean electronics and technology in Kenya')">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="{{ request()->url() }}">
    <meta property="og:image" content="@yield('og_image', asset('images/logo.png'))">
    <meta property="og:site_name" content="K-Elec">
    <meta property="og:locale" content="{{ str_replace('_', '-', app()->getLocale()) }}">
    
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('twitter_title', config('app.name', 'K-Elec'))">
    <meta name="twitter:description" content="@yield('twitter_description', 'Your trusted source for quality Korean electronics and technology in Kenya')">
    <meta name="twitter:image" content="@yield('twitter_image', asset('images/logo.png'))">
    
    <!-- Canonical URL -->
    <link rel="canonical" href="{{ request()->url() }}">
    
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('favicon/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('favicon/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('favicon/site.webmanifest')}}">
    
    <!-- Preconnect for Performance -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="dns-prefetch" href="https://fonts.bunny.net">
    <link rel="dns-prefetch" href="https://cdnjs.cloudflare.com">
    
    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700" rel="stylesheet" />
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Structured Data -->
    @yield('structured_data')
</head>
<body class="bg-gray-50">
    @include('components.header-products')
    {{--  --}}
    <!-- Navigation Menu -->
    <nav class="bg-transparent hidden md:block mx-auto">
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="flex bg-gray-100 items-center w-[70%] mx-auto" style="max-width:1470px;">
                
                <!-- All Categories -->
                <a style="min-width:300px; text-align:center" href="{{ route('products.index') }}" 
                    class="bg-black text-white px-6 py-3 flex items-center space-x-9 font-semibold hover:bg-gray-800 ">
                    <span class="mx-auto">All Categories</span>
                    <svg xmlns="http://www.w3.org/2000/svg" 
                        class="h-4 w-4 text-white" fill="none" 
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                            d="M9 5l7 7-7 7" />
                    </svg>
                </a>

                <?php $categories = \App\Models\Category::active()->ordered()->get(); ?>
                @foreach($categories->take(6) as $category)
                <!-- Other Links -->
                <a href="{{ route('products.index', ['category' => $category->slug]) }}" 
                    class="font-semibold px-4 py-3 hover:text-gray-700 text-black !text-black" style="color:#000000">
                    {{ $category->name }}
                </a>
                @endforeach

               
            </div>
        </div>

    </nav>
    {{--  --}}
    <main>
        @yield('content')
    </main>
    
    @include('components.footer')
</body>
</html>
