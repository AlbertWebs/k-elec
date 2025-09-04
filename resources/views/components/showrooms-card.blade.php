

    <section class="py-6 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-left mb-12 mobile-heading">Our Showrooms</h2>
            {{-- if showroom is empty --}}
            @if($showrooms->isEmpty())
                <div class="text-center py-12">
                    {{-- <h3 class="text-lg font-semibold text-gray-900">No Showrooms Available</h3>
                    <p class="mt-2 text-gray-600">Please check back later for updates.</p> --}}
                    {{--  --}}
                    <iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3988.812856070968!2d36.827999999999996!3d-1.2863333!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMcKwMTcnMTAuOCJTIDM2wrA0OSc0MC44IkU!5e0!3m2!1sen!2ske!4v1756992484286!5m2!1sen!2ske" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    {{--  --}}
                </div>
            @else

            <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-3 md:gap-6">
                {{-- Showroom Card --}}
                @foreach($showrooms as $showroom)
                <article class="bg-white border border-gray-200 overflow-hidden group" 
                        data-product-id="123" 
                        itemscope 
                        itemtype="https://schema.org/Product">

                    <div class="relative">
                        <a href="{{ $showroom->location_url }}" 
                        class="block flex justify-center items-center w-full bg-gray-100 relative">

                            <!-- Image -->
                            <img src="{{ url('/') }}/{{ Storage::url($showroom->image) }}" 
                                alt="{{ $showroom->name }}" 
                                class="w-full aspect-square object-cover showroom-img"
                                itemprop="image"
                                loading="lazy"
                                onerror="this.src='{{ url('/') }}/{{ Storage::url($showroom->image) }}'; console.log('Image failed to load:', this.src);"
                                onload="console.log('Image loaded successfully:', this.src);">

                            <!-- Dark strip at the top -->
                            <div class="absolute top-0 left-0 right-0 bg-black bg-opacity-60 py-2 px-3 bg-opacity-70">
                                <h3 class="text-white text-sm sm:text-base font-semibold text-center truncate">
                                    {{ $showroom->name }}
                                </h3>
                            </div>
                        </a>
                    </div>
                    
                    <div class="p-3 sm:p-4 flex flex-col">
                        <h6 class="text-xs sm:text-sm text-gray-600 text-center">{{ $showroom->location }}</h6>

                        <a title="{{ $showroom->location }}" 
                        href="{{ $showroom->location_url }}" 
                        class="inline-block border-2 border-gray-900 text-gray-900 px-2 py-1 mt-2 rounded-lg font-semibold hover:bg-gray-900 hover:text-white transition-colors text-center mobile-btn">
                            Visit Showroom →
                        </a>
                    </div>
                    
                    <meta itemprop="url" content="#">
                    <meta itemprop="availability" content="https://schema.org/InStock">
                    <meta itemprop="category" content="Showroom">
                </article>
                @endforeach
            </div>
            
            <div class="text-center mt-8">
                <a href="{{ route('showrooms.index') }}" 
                class="inline-block border-2 border-gray-900 text-gray-900 px-8 py-3 rounded-lg font-semibold hover:bg-gray-900 hover:text-white transition-colors mobile-btn">
                <i class="fas fa-map-marker"></i> &nbsp; More Show Rooms →
                </a>
            </div>
            @endif
        </div>
    </section>
