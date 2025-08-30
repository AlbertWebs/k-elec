@php
use App\Models\Setting;
use App\Helpers\SocialMediaHelper;
@endphp

<!-- Footer Top Bar -->
<div class="bg-gray-800 py-8">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                            <div class="flex items-center space-x-3">
                    <i class="fas fa-truck text-white text-xl"></i>
                    <div>
                        <h4 class="text-white font-semibold">SHIPPING</h4>
                        <p class="text-gray-300 text-sm">Free on orders over KES 50,000</p>
                    </div>
                </div>
            
            <div class="flex items-center space-x-3">
                <i class="fas fa-lock text-white text-xl"></i>
                <div>
                    <h4 class="text-white font-semibold">SECURE PAYMENTS</h4>
                    <p class="text-gray-300 text-sm">Up to 6 months installments</p>
                </div>
            </div>
            
            <div class="flex items-center space-x-3">
                <i class="fas fa-undo text-white text-xl"></i>
                <div>
                    <h4 class="text-white font-semibold">15-DAYS RETURNS</h4>
                    <p class="text-gray-300 text-sm">Shop with fully confidence</p>
                </div>
            </div>
            
            <div class="flex items-center space-x-3">
                <i class="fas fa-headset text-white text-xl"></i>
                <div>
                    <h4 class="text-white font-semibold">24X7 FULLY SUPPORT</h4>
                    <p class="text-gray-300 text-sm">Get friendly support</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Footer -->
<footer class="bg-gray-900 text-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Company Info -->
            <div>
                <h3 class="text-2xl font-bold text-red-600 mb-4">K-Elec</h3>
                <p class="text-gray-400 mb-4">{{ Setting::get('contact_address', 'Westlands, Nairobi') }}, {{ Setting::get('contact_city', 'Kenya') }}</p>
                <p class="text-gray-400 mb-2">{{ Setting::get('contact_phone', '+254 700 123 456') }}</p>
                <p class="text-gray-400 mb-6">{{ Setting::get('contact_email', 'hello@k-klec.co.ke') }}</p>
                
                <!-- Social Media -->
                <div class="flex space-x-4">
                    @php
                        $socialUrls = SocialMediaHelper::getSocialMediaUrls();
                    @endphp
                    
                    @if(isset($socialUrls['facebook']))
                        <a href="{{ $socialUrls['facebook'] }}" target="_blank" class="text-gray-400 hover:text-white"><i class="fab fa-facebook-f"></i></a>
                    @endif
                    
                    @if(isset($socialUrls['twitter']))
                        <a href="{{ $socialUrls['twitter'] }}" target="_blank" class="text-gray-400 hover:text-white"><i class="fab fa-twitter"></i></a>
                    @endif
                    
                    @if(isset($socialUrls['instagram']))
                        <a href="{{ $socialUrls['instagram'] }}" target="_blank" class="text-gray-400 hover:text-white"><i class="fab fa-instagram"></i></a>
                    @endif
                    
                    @if(isset($socialUrls['linkedin']))
                        <a href="{{ $socialUrls['linkedin'] }}" target="_blank" class="text-gray-400 hover:text-white"><i class="fab fa-linkedin-in"></i></a>
                    @endif
                </div>
            </div>
            
            <!-- Support Links -->
            <div>
                <h4 class="text-lg font-semibold mb-4">SUPPORTS</h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('pages.contact') }}" class="text-gray-400 hover:text-white">Contact Us</a></li>
                    <li><a href="{{ route('pages.about') }}" class="text-gray-400 hover:text-white">About Page</a></li>
                    <li><a href="{{ route('pages.technical-support') }}" class="text-gray-400 hover:text-white">Technical Support</a></li>
                    <li><a href="{{ route('pages.shipping-returns') }}" class="text-gray-400 hover:text-white">Shipping & Returns</a></li>
                    <li><a href="{{ route('pages.faq') }}" class="text-gray-400 hover:text-white">FAQ's Page</a></li>
                    <li><a href="{{ route('pages.privacy') }}" class="text-gray-400 hover:text-white">Privacy</a></li>
                </ul>
            </div>
            
            <!-- Shop Links -->
            <div>
                <h4 class="text-lg font-semibold mb-4">PRODUCTS</h4>
                <ul class="space-y-2">
                     <?php $categories = \App\Models\Category::active()->ordered()->get(); ?>
                    @foreach($categories->take(6) as $category)
                    <li><a href="{{ route('products.index', ['category' => $category->slug]) }}" class="text-gray-400 hover:text-white">{{ $category->name }}</a></li>
                    @endforeach
                </ul>
            </div>
            
            <!-- Subscribe & Payments -->
            <div>
                <h4 class="text-lg font-semibold mb-4">SUBSCRIBE</h4>
                <p class="text-gray-400 mb-4">Receive updates, hot deals, discounts sent straight to your inbox daily.</p>
                
                <!-- Email Subscription -->
                <div class="flex mb-6">
                    <input type="email" placeholder="Email Address" class="flex-1 px-3 py-2 bg-gray-800 border border-gray-700 rounded-l text-white placeholder-gray-400 focus:outline-none focus:border-gray-600">
                    <button class="bg-red-600 px-4 py-2 rounded-r hover:bg-red-700">
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </div>

                <div class="flex space-x-3">
                        <a href="{{ Setting::get('social_facebook', '#') }}" class="w-9 h-9 bg-blue-600 rounded-lg flex items-center justify-center text-white hover:bg-blue-700 transition-colors">
                            <i class="fab fa-facebook-f text-sm"></i>
                        </a>
                        <a href="{{ Setting::get('social_twitter', '#') }}" class="w-9 h-9 bg-blue-400 rounded-lg flex items-center justify-center text-white hover:bg-blue-500 transition-colors">
                            <i class="fab fa-twitter text-sm"></i>
                        </a>
                        <a href="{{ Setting::get('social_instagram', '#') }}" class="w-9 h-9 bg-pink-600 rounded-lg flex items-center justify-center text-white hover:bg-pink-700 transition-colors">
                            <i class="fab fa-instagram text-sm"></i>
                        </a>
                        <a href="{{ Setting::get('social_linkedin', '#') }}" class="w-9 h-9 bg-blue-800 rounded-lg flex items-center justify-center text-white hover:bg-blue-900 transition-colors">
                            <i class="fab fa-linkedin-in text-sm"></i>
                        </a>
                         <a href="{{ Setting::get('social_youtube', '#') }}" class="w-9 h-9 bg-red-600 rounded-lg flex items-center justify-center text-white hover:bg-red-700 transition-colors">
                            <i class="fab fa-youtube text-sm"></i>
                        </a>
                         <a href="{{ Setting::get('social_whatsapp', '#') }}" class="w-9 h-9 bg-green-600 rounded-lg flex items-center justify-center text-white hover:bg-green-700 transition-colors">
                            <i class="fab fa-whatsapp text-sm"></i>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
    
    <!-- Copyright -->
    <div class="bg-gray-800 py-4">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <p class="text-center text-gray-400 text-sm">© {{date('Y')}} K-Elec. Design & Develop By <a href="https://drenla.com" target="_blank" class="text-white hover:text-red-400 transition-colors">Drenla Hub</a>.</p>
        </div>
    </div>
</footer> 