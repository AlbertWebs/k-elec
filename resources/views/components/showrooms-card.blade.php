<section class="py-16 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-left mb-12 mobile-heading">Our Showrooms</h2>

            <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-3 md:gap-6">
                {{-- Showroom Card --}}
                @foreach($showrooms as $showroom)
                <article class="bg-white border border-gray-200 overflow-hidden group" data-product-id="123" itemscope="" itemtype="https://schema.org/Product">
                    <div class="relative">
                        <a href="{{$showroom->location_url}}" class="block flex justify-center items-center w-full bg-gray-100">
                            <img  src="{{url('/')}}/{{ Storage::url($showroom->image) }}" 
                            alt="Product Name" 
                            class="w-full aspect-square object-contain showroom-img"
                            itemprop="image"
                            loading="lazy"
                            onerror="this.src='{{url('/')}}/{{ Storage::url($showroom->image) }}'; console.log('Image failed to load:', this.src);"
                            onload="console.log('Image loaded successfully:', this.src);">
                        </a>
                        
                        
                        
                    </div>
                    
                    <div class="p-3 sm:p-4 flex flex-col">
                        <a href="#" class="">
                            <h3 class="text-xs sm:text-sm font-medium text-gray-900 hover:text-blue-600 transition-colors line-clamp-2 text-center" style="height:40px;" itemprop="name">{{$showroom->name}}</h3>
                        </a>
                        <h6 class="text-xs sm:text-sm text-gray-600 text-center">{{$showroom->location}}</h6>

                        <a title="{{$showroom->location}}" href="{{$showroom->location_url}}" class="inline-blocks border-2 border-gray-900 text-gray-900 px-1 py-1 rounded-lg font-semibold hover:bg-gray-900 hover:text-white transition-colors text-center mobile-btn">
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
            
            <div class="text-center mt-8">
                <a href="{{ route('showrooms.index') }}" class="inline-block border-2 border-gray-900 text-gray-900 px-8 py-3 rounded-lg font-semibold hover:bg-gray-900 hover:text-white transition-colors mobile-btn">
                   <i class="fas fa-map-marker"></i> &nbsp; More Show Rooms →
                </a>
            </div>
        </div>
    </section>