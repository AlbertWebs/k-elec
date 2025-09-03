@extends('layouts.app')

@section('content')
<div class="bg-gray-50 py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">About K-Elec Shorooms</h1>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                K-Elec Showrooms are immersive retail spaces designed for customers to test and experience modern electronics and home appliances. Staffed with experts, each showroom offers a personalized shopping journey, highlighting the brand's commitment to quality and innovation in every product.
            </p>
        </div>

      
        {{--  --}}
    <section class="py-16 bg-gray">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            
            
            <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-3 md:gap-6">
                {{-- Showroom Card --}}
                @foreach($showrooms as $showroom)
                <article class="bg-white border border-gray-200 overflow-hidden group" data-product-id="123" itemscope="" itemtype="https://schema.org/Product">
                    <div class="relative">
                        <a href="#" class="block flex justify-center items-center w-full bg-gray-100">
                            <img style="height:420px; width:100%; object-fit:cover" src="{{ Storage::url($showroom->image) }}" 
                            alt="Product Name" 
                            class="w-full aspect-square object-contain"
                            itemprop="image"
                            loading="lazy"
                            onerror="this.src='{{ Storage::url($showroom->image) }}'; console.log('Image failed to load:', this.src);"
                            onload="console.log('Image loaded successfully:', this.src);">
                        </a>
                        
                        
                        
                    </div>
                    
                    <div class="p-3 sm:p-4 flex flex-col">
                        <a href="#" class="">
                            <h3 class="text-xs sm:text-sm font-medium text-gray-900 hover:text-blue-600 transition-colors line-clamp-2 text-center" style="height:40px;" itemprop="name">{{$showroom->name}}</h3>
                        </a>
                        <h6 class="text-xs sm:text-sm text-gray-600 text-center">{{$showroom->location}}</h6>

                        <a title="{{$showroom->location}}" href="{{$showroom->location}}" class="inline-blocks border-2 border-gray-900 text-gray-900 px-1 py-1 rounded-lg font-semibold hover:bg-gray-900 hover:text-white transition-colors text-center" style="background-color">
                             Visit Showroom → 
                        </a>

                    </div>
                    
                    <meta itemprop="url" content="#">
                    <meta itemprop="availability" content="https://schema.org/InStock">
                    <meta itemprop="category" content="Sample Category">
                </article>
                @endforeach
                {{--  --}}
            </div>
            
           
        </div>
    </section>
        {{--  --}}
    </div>
</div>
@endsection 