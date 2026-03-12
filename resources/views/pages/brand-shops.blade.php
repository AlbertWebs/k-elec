@extends('layouts.app')

@section('title', 'Brand Shops - K-Elec Store Locations in Kenya')
@section('description', 'Visit K-Elec brand shops across Kenya. Find our store locations, hours, and contact information.')
@section('og_title', 'K-Elec Brand Shops - Store Locations')
@section('og_description', 'Visit our brand shops across Kenya to experience our products in person.')

@section('content')
<div class="bg-gray-50">
    <!-- Hero Section -->
    <section class="bg-red-600 text-white py-12 lg:py-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto text-center">
                <h1 class="text-4xl lg:text-5xl font-bold mb-4">
                    Brand Shops
                </h1>
                <p class="text-xl text-red-100 mb-8">
                    Visit our brand shops across Kenya to experience our products in person with expert guidance
                </p>
                <div class="flex items-center justify-center space-x-2 text-red-100">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>Multiple Locations • Expert Staff • Premium Experience</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Shops Grid -->
    <section class="py-16 lg:py-24">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            @if($shops->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                    @foreach($shops as $shop)
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
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
                                     class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                            </div>

                            <!-- Shop Details -->
                            <div class="p-6 space-y-4">
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
                                           class="inline-flex items-center space-x-2 w-full justify-center bg-red-600 text-white py-3 rounded-lg font-semibold hover:bg-gray-600 transition-colors">
                                            <i class="fas fa-directions"></i>
                                            <span>Get Directions</span>
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <div class="mb-4">
                        <i class="fas fa-store text-6xl text-gray-300"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">No Shops Available</h3>
                    <p class="text-gray-600">We're currently expanding our shop locations. Check back soon!</p>
                </div>
            @endif
        </div>
    </section>

    <!-- CTA Section -->
    @if($shops->count() > 0)
        <section class="bg-red-600 text-white py-16">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-3xl mx-auto text-center">
                    <h2 class="text-3xl lg:text-4xl font-bold mb-4">
                        Visit Your Nearest K-Elec Shop Today
                    </h2>
                    <p class="text-red-100 text-lg mb-8">
                        Experience our products with expert guidance and premium customer service
                    </p>
                    <a href="{{ route('products.index') }}" class="inline-block bg-white text-red-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                        Shop Online →
                    </a>
                </div>
            </div>
        </section>
    @endif
</div>
@endsection
