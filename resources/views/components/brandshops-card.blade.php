<section class="py-6 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-left mb-12 mobile-heading">Our Brand Shops</h2>
        
        @if($shops->isEmpty())
            <div class="text-center py-12">
                <div class="mb-4">
                    <i class="fas fa-store text-6xl text-gray-300"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">No Brand Shops Available</h3>
                <p class="text-gray-600">We're currently expanding our shop locations. Check back soon!</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                @foreach($shops as $shop)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 group" style="transition: transform 0.3s ease, box-shadow 0.3s ease;" onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 12px 24px rgba(220, 38, 38, 0.45)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 15px rgba(0, 0, 0, 0.1)'">
                        <!-- Header with Location -->
                        <div class="bg-red-600 text-white p-4">
                            <div class="flex items-start space-x-3">
                                <i class="fas fa-map-marker-alt text-lg flex-shrink-0 mt-1"></i>
                                <div>
                                    <h3 class="font-semibold text-lg">{{ $shop->location }}</h3>
                                </div>
                            </div>
                        </div>

                        <!-- Shop Image -->
                        <div class="relative h-64 bg-gray-100 overflow-hidden">
                            <img src="{{ Storage::url($shop->image) }}" 
                                 alt="{{ $shop->name }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        </div>

                        <!-- Shop Details -->
                        <div class="p-6 space-y-4">
                            <!-- Shop Name -->
                            <h4 class="text-lg font-semibold text-gray-900">{{ $shop->name }}</h4>

                            <!-- Phone -->
                            @if($shop->phone)
                                <div class="flex items-start space-x-3">
                                    <i class="fas fa-phone text-red-600 flex-shrink-0 mt-1"></i>
                                    <div>
                                        <p class="text-sm text-gray-600">Phone</p>
                                        <a href="tel:{{ $shop->phone }}" class="text-gray-900 font-medium hover:text-red-600 transition-colors">
                                            {{ $shop->phone }}
                                        </a>
                                    </div>
                                </div>
                            @endif

                            <!-- Store Hours -->
                            @if($shop->timings && count($shop->timings) > 0)
                                <div class="flex items-start space-x-3">
                                    <i class="fas fa-clock text-red-600 flex-shrink-0 mt-1"></i>
                                    <div class="flex-1">
                                        <p class="text-sm text-gray-600 font-medium mb-2">Hours</p>
                                        <div class="space-y-1">
                                            @foreach($shop->timings as $day => $time)
                                                @if($time)
                                                    <div class="flex justify-between text-sm">
                                                        <span class="text-gray-700">{{ substr($day, 0, 3) }}</span>
                                                        <span class="text-gray-600">{{ $time }}</span>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Get Directions Button -->
                            @if($shop->directions_url)
                                <div class="pt-2 border-t border-gray-200">
                                    <a href="{{ $shop->directions_url }}" 
                                       target="_blank" 
                                       class="inline-flex items-center justify-center space-x-2 w-full bg-red-600 text-white py-3 rounded-lg font-semibold hover:bg-red-700 transition-colors">
                                        <i class="fas fa-directions"></i>
                                        <span>Get Directions</span>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- View All Shops Button -->
            <div class="text-center mt-12">
                <a href="{{ route('pages.brand-shops') }}" 
                   class="inline-block border-2 border-red-600 text-red-600 px-8 py-3 rounded-lg font-semibold hover:bg-red-600 hover:text-white transition-colors">
                    <i class="fas fa-store mr-2"></i>View All Brand Shops →
                </a>
            </div>
        @endif
    </div>
</section>
