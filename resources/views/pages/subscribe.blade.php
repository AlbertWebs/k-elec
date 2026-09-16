@extends('layouts.app')

@section('title', 'Subscribe to K-Elec - Get Exclusive Offers & Updates')
@section('description', 'Subscribe to K-Elec newsletter and stay updated with the latest products, exclusive offers, and special promotions. Be the first to know about new arrivals.')
@section('keywords', 'subscribe, newsletter, K-Elec offers, electronics deals, promotions')
@section('og_title', 'Subscribe to K-Elec - Exclusive Offers & Updates')
@section('og_description', 'Get exclusive offers, updates, and promotions delivered to your inbox. Subscribe to K-Elec today!')
@section('og_type', 'website')

@section('content')
<div class="bg-gray-50">
    <!-- Hero Section -->
    <section class="bg-red-600 text-white py-12 sm:py-16 lg:py-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto text-center">
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-3 sm:mb-4">
                    Stay Connected with K-Elec
                </h1>
                <p class="text-base sm:text-lg lg:text-xl text-red-100 mb-6 sm:mb-8">
                    Never miss out on exclusive deals, product launches, and special promotions. Join thousands of satisfied customers who receive the best offers first.
                </p>
                <div class="flex flex-col sm:flex-row items-center justify-center space-y-2 sm:space-y-0 sm:space-x-2 text-xs sm:text-sm text-red-100">
                    <i class="fas fa-check-circle"></i>
                    <span>100% Spam-Free • Unsubscribe Anytime</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-12 sm:py-16 lg:py-24">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 sm:gap-12 items-center">
                <!-- Left Column - Form -->
                <div class="order-2 lg:order-1">
                    <div class="bg-white rounded-2xl shadow-lg p-6 sm:p-8 lg:p-10">
                        <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">
                            Join Our Community
                        </h2>
                        <p class="text-sm sm:text-base text-gray-600 mb-6 sm:mb-8">
                            Get instant access to exclusive offers, new product launches, and insider tips on the latest technology.
                        </p>

                        @if(session('success'))
                            <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg flex items-start">
                                <i class="fas fa-check-circle mr-3 mt-0.5 flex-shrink-0"></i>
                                <div>
                                    <p class="font-semibold">Success!</p>
                                    <p class="text-sm">{{ session('success') }}</p>
                                </div>
                            </div>
                        @endif

                        <form id="subscription-form" 
                              method="POST" 
                              data-action="{{ route('subscriptions.store') }}"
                              class="space-y-5">
                            @csrf
                            
                            <!-- Email Input -->
                            <div>
                                <label for="subscription-email" class="block text-xs sm:text-sm font-semibold text-gray-700 mb-2">
                                    Email Address *
                                </label>
                                <div class="relative">
                                    <i class="fas fa-envelope absolute left-3 top-3.5 text-gray-400"></i>
                                    <input 
                                        type="email" 
                                        id="subscription-email" 
                                        name="email" 
                                        required 
                                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors @error('email') border-red-500 @enderror"
                                        placeholder="your@email.com">
                                </div>
                                @error('email')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Phone Input -->
                            <div>
                                <label for="subscription-phone" class="block text-xs sm:text-sm font-semibold text-gray-700 mb-2">
                                    Phone Number *
                                </label>
                                <div class="relative">
                                    <i class="fas fa-phone absolute left-3 top-3.5 text-gray-400"></i>
                                    <input 
                                        type="tel" 
                                        id="subscription-phone" 
                                        name="phone" 
                                        required 
                                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors @error('phone') border-red-500 @enderror"
                                        placeholder="+254 700 123 456">
                                </div>
                                @error('phone')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Subscribe Button -->
                            <button 
                                type="submit" 
                                class="w-full bg-red-600 text-white py-2.5 sm:py-3 px-4 sm:px-6 rounded-lg font-semibold hover:bg-gray-600 transition-colors duration-200 flex items-center justify-center space-x-2 text-sm sm:text-base">
                                <i class="fas fa-bell"></i>
                                <span>Subscribe Now</span>
                            </button>

                            <!-- Terms -->
                            <p class="text-xs text-gray-600 text-center leading-relaxed">
                                By subscribing, you agree to receive marketing emails from K-Elec. 
                                <a href="{{ route('pages.privacy') }}" class="text-red-600 hover:text-red-700 font-semibold">Privacy Policy</a>
                            </p>
                        </form>

                        <!-- Message Container -->
                        <div id="subscription-message" class="hidden mt-6"></div>
                    </div>
                </div>

                <!-- Right Column - Benefits -->
                <div class="order-1 lg:order-2">
                    <div class="mb-8 sm:mb-12">
                        <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-6 sm:mb-8">
                            Why Subscribe to K-Elec?
                        </h3>

                        <!-- Benefit Cards -->
                        <div class="space-y-3 sm:space-y-5">
                            <!-- Benefit 1 -->
                            <div class="flex items-start space-x-3 sm:space-x-4 p-3 sm:p-4 rounded-lg bg-white border border-gray-200 hover:shadow-md transition-shadow">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center h-10 w-10 sm:h-12 sm:w-12 rounded-md bg-red-100">
                                        <i class="fas fa-tag text-red-600 text-base sm:text-lg"></i>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="text-base sm:text-lg font-semibold text-gray-900">Exclusive Deals</h4>
                                    <p class="text-gray-600 text-xs sm:text-sm mt-1">
                                        Get subscriber-only discounts and early access to our biggest sales.
                                    </p>
                                </div>
                            </div>

                            <!-- Benefit 2 -->
                            <div class="flex items-start space-x-3 sm:space-x-4 p-3 sm:p-4 rounded-lg bg-white border border-gray-200 hover:shadow-md transition-shadow">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center h-10 w-10 sm:h-12 sm:w-12 rounded-md bg-red-100">
                                        <i class="fas fa-star text-red-600 text-base sm:text-lg"></i>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="text-base sm:text-lg font-semibold text-gray-900">New Arrivals First</h4>
                                    <p class="text-gray-600 text-xs sm:text-sm mt-1">
                                        Be the first to know about latest products and launches before anyone else.
                                    </p>
                                </div>
                            </div>

                            <!-- Benefit 3 -->
                            <div class="flex items-start space-x-3 sm:space-x-4 p-3 sm:p-4 rounded-lg bg-white border border-gray-200 hover:shadow-md transition-shadow">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center h-10 w-10 sm:h-12 sm:w-12 rounded-md bg-red-100">
                                        <i class="fas fa-gift text-red-600 text-base sm:text-lg"></i>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="text-base sm:text-lg font-semibold text-gray-900">Special Promotions</h4>
                                    <p class="text-gray-600 text-xs sm:text-sm mt-1">
                                        Receive exclusive coupons and promotional codes via email regularly.
                                    </p>
                                </div>
                            </div>

                            <!-- Benefit 4 -->
                            <div class="flex items-start space-x-3 sm:space-x-4 p-3 sm:p-4 rounded-lg bg-white border border-gray-200 hover:shadow-md transition-shadow">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center h-10 w-10 sm:h-12 sm:w-12 rounded-md bg-red-100">
                                        <i class="fas fa-info-circle text-red-600 text-base sm:text-lg"></i>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="text-base sm:text-lg font-semibold text-gray-900">Product Tips & Guides</h4>
                                    <p class="text-gray-600 text-xs sm:text-sm mt-1">
                                        Learn how to get the most out of your electronics with our expert tips.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8 text-center">
                <!-- Stat 1 -->
                <div>
                    <div class="text-3xl sm:text-4xl font-bold text-red-600 mb-2">10,000+</div>
                    <p class="text-sm sm:text-base text-gray-600">Active Subscribers</p>
                </div>

                <!-- Stat 2 -->
                <div>
                    <div class="text-3xl sm:text-4xl font-bold text-red-600 mb-2">50%</div>
                    <p class="text-sm sm:text-base text-gray-600">Average Savings</p>
                </div>

                <!-- Stat 3 -->
                <div>
                    <div class="text-3xl sm:text-4xl font-bold text-red-600 mb-2">24/7</div>
                    <p class="text-sm sm:text-base text-gray-600">Customer Support</p>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-12 sm:py-16 lg:py-20 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto">
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 text-center mb-8 sm:mb-12">
                    Frequently Asked Questions
                </h2>

                <div class="space-y-3 sm:space-y-4">
                    <!-- FAQ 1 -->
                    <details class="bg-white rounded-lg shadow-sm p-4 sm:p-6 hover:shadow-md transition-shadow">
                        <summary class="flex items-center cursor-pointer font-semibold text-sm sm:text-base text-gray-900">
                            <i class="fas fa-chevron-down text-red-600 mr-2 sm:mr-3 flex-shrink-0"></i>
                            <span>How often will I receive emails?</span>
                        </summary>
                        <p class="text-gray-600 text-xs sm:text-sm mt-4 ml-6">
                            We send emails about 2-3 times per week with the latest deals, new products, and special offers. You can adjust your preferences at any time.
                        </p>
                    </details>

                    <!-- FAQ 2 -->
                    <details class="bg-white rounded-lg shadow-sm p-4 sm:p-6 hover:shadow-md transition-shadow">
                        <summary class="flex items-center cursor-pointer font-semibold text-sm sm:text-base text-gray-900">
                            <i class="fas fa-chevron-down text-red-600 mr-2 sm:mr-3 flex-shrink-0"></i>
                            <span>Can I unsubscribe anytime?</span>
                        </summary>
                        <p class="text-gray-600 text-xs sm:text-sm mt-4 ml-6">
                            Absolutely! You can unsubscribe at any time by clicking the unsubscribe link at the bottom of any email we send you.
                        </p>
                    </details>

                    <!-- FAQ 3 -->
                    <details class="bg-white rounded-lg shadow-sm p-4 sm:p-6 hover:shadow-md transition-shadow">
                        <summary class="flex items-center cursor-pointer font-semibold text-sm sm:text-base text-gray-900">
                            <i class="fas fa-chevron-down text-red-600 mr-2 sm:mr-3 flex-shrink-0"></i>
                            <span>Is my information safe?</span>
                        </summary>
                        <p class="text-gray-600 text-xs sm:text-sm mt-4 ml-6">
                            Yes, we take data security very seriously. Your email and phone number are encrypted and will never be shared with third parties. See our <a href="{{ route('pages.privacy') }}" class="text-red-600 hover:text-red-700 font-semibold">Privacy Policy</a> for more details.
                        </p>
                    </details>

                    <!-- FAQ 4 -->
                    <details class="bg-white rounded-lg shadow-sm p-4 sm:p-6 hover:shadow-md transition-shadow">
                        <summary class="flex items-center cursor-pointer font-semibold text-sm sm:text-base text-gray-900">
                            <i class="fas fa-chevron-down text-red-600 mr-2 sm:mr-3 flex-shrink-0"></i>
                            <span>Will I get SMS notifications?</span>
                        </summary>
                        <p class="text-gray-600 text-xs sm:text-sm mt-4 ml-6">
                            We may send important updates and exclusive flash sale notifications via SMS. You can opt-out of SMS at any time by replying STOP.
                        </p>
                    </details>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="bg-red-600 text-white py-12 sm:py-16 lg:py-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold mb-3 sm:mb-4">
                    Don't Miss Out on Great Deals!
                </h2>
                <p class="text-red-100 text-sm sm:text-base lg:text-lg mb-6 sm:mb-8">
                    Subscribe now and get instant notifications about the latest products and exclusive offers.
                </p>
                <a href="#subscription-form" class="inline-block bg-white text-red-600 px-6 sm:px-8 py-2.5 sm:py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors text-sm sm:text-base">
                    Subscribe Now
                </a>
            </div>
        </div>
    </section>
</div>

<script>
    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });

    // FAQ toggle styling
    document.querySelectorAll('details').forEach(detail => {
        detail.addEventListener('toggle', function() {
            if (this.open) {
                this.classList.add('shadow-md');
            } else {
                this.classList.remove('shadow-md');
            }
        });
    });
</script>

@endsection
