@php
use App\Models\Setting;
@endphp

<!-- Top Header Bar -->
{{-- <div class="bg-gray-100 color-white py-2 hidden md:block">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center text-sm">
            <div class="text-gray-600">
                Free shipping on orders over KES 50,000
            </div>
            <div class="flex items-center space-x-4">
                <a href="{{ route('wishlist.index') }}" class="text-gray-600 hover:text-gray-800">Wishlist</a>
            </div>
        </div>
    </div>
</div> --}}

<!-- Main Header -->
<header class="sticky top-0 z-40 bg-red-600 text-white shadow-sm w-full">
    <div class="w-full">
        <!-- Flex Layout: Logo (left, spans both rows) + Content (right, 2 rows) -->
        <div class="flex gap-0 w-full">
            
            <!-- Logo - Far Left, Spans Both Rows -->
            <div class="flex-shrink-0 flex items-center bg-white py-2 pr-4">
                <a href="{{ route('home') }}" class="flex items-center h-full px-4">
                    <img style="width:100px; height:auto; object-fit:cover;" src="{{ asset('images/logo.png') }}" alt="K-ELEC" class="brand-logo">
                </a>
            </div>

            <!-- Right Content Container (flex column with 2 sections) -->
            <div class="flex-1 flex flex-col w-full">
                
                <!-- Top Row: Company Info Left + Right Buttons -->
                <div class="flex items-center justify-between py-2 pr-4 sm:pr-6 lg:px-8">
                    <!-- Company Info Left -->
                    <div class="hidden md:flex items-center">
                        <div class="flex flex-wrap items-center gap-6 text-white text-md font-medium">
                            <span class="whitespace-nowrap">KOREAN TECH, KENYANTRUST</span>
                            <span class="text-gray-200"><br></span>
                            <div class="flex items-center gap-2">
                                <a href="#" id="header-top-whatsapp-link" data-whatsapp="{{ Setting::get('social_whatsapp', '#') }}" class="text-green-300 hover:text-green-100 transition-colors">
                                    <i class="fab fa-whatsapp text-lg"></i>
                                </a>
                                <a href="#" id="header-top-phone-link" data-whatsapp="{{ Setting::get('social_whatsapp', '#') }}" class="hover:text-gray-200 whitespace-nowrap">+254716052243</a>
                            </div>
                            <span class="text-gray-200"><br></span>
                            <a href="mailto:sales@k-elec.co.ke" class="hover:text-gray-200 truncate">sales@k-elec.co.ke</a>
                        </div>
                    </div>
                    
                    <!-- Right Side: BE A VENDOR Button (Desktop) + Mobile Buttons -->
                    <div class="flex items-center space-x-4 ml-auto">
                        <!-- BE A VENDOR Button - Hidden on Mobile/Tablet, visible on Desktop -->
                        <a href="{{ route('pages.vendors') }}" 
                           class="hidden lg:block px-6 py-2 rounded-lg font-semibold text-white transition-opacity hover:opacity-90"
                           style="background-color: #0b384e;">
                            BE A VENDOR
                        </a>
                        
                        <!-- Mobile Search Button - Only on mobile -->
                        <button id="mobile-search-button" class="md:hidden flex items-center text-white hover:text-gray-200">
                            <i class="fas fa-search text-xl"></i>
                        </button>
                        
                        <!-- Mobile Menu Button - Only on mobile -->
                        <button id="mobile-menu-button" class="md:hidden flex items-center text-white hover:text-gray-200">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                    </div>
                </div>

                <!-- Bottom Row: Navigation Menu -->
                <nav class="bg-white hidden md:flex w-full py-2">
                    <div class="flex bg-gray-100 items-center w-full px-4 sm:px-6 lg:px-8" style="max-width:none;">
                        
                        <!-- TV/AUDIO with Submenu -->
                        <div class="relative group">
                            <button class="font-semibold px-4 py-2 hover:text-gray-700 text-black flex items-center space-x-1">
                                <span>TV/AUDIO</span>
                                <i class="fas fa-chevron-down text-xs"></i>
                            </button>
                            <!-- Dropdown Menu -->
                            <div class="absolute left-0 mt-0 w-48 bg-white border border-gray-200 rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                                <a href="{{ route('products.index', ['search' => 'FHD']) }}" class="block px-4 py-2 text-gray-900 hover:bg-gray-100 first:rounded-t-lg">HD - 32\"</a>
                                <a href="{{ route('products.index', ['search' => 'FHD']) }}" class="block px-4 py-2 text-gray-900 hover:bg-gray-100">FHD - 43\"</a>
                                <div class="px-4 py-2 border-t border-gray-200">
                                    <p class="text-sm font-semibold text-gray-700 mb-1">UHD</p>
                                    <a href="{{ route('products.index', ['search' => 'UHD']) }}" class="block text-sm text-gray-700 hover:text-red-600 ml-2 py-1">43\", 50\", 55\"</a>
                                </div>
                                <div class="px-4 py-2 border-t border-gray-200">
                                    <p class="text-sm font-semibold text-gray-700 mb-1">QLED</p>
                                    <a href="{{ route('products.index', ['search' => 'QLED']) }}" class="block text-sm text-gray-700 hover:text-red-600 ml-2 py-1">55\", 65\", 75\"</a>
                                </div>
                            </div>
                        </div>
                        
                        <span class="text-gray-400">|</span>
                        
                        <!-- HOME APPLIANCES with Submenu -->
                        <div class="relative group">
                            <button class="font-semibold px-4 py-2 hover:text-gray-700 text-black flex items-center space-x-1">
                                <span>HOME APPLIANCES</span>
                                <i class="fas fa-chevron-down text-xs"></i>
                            </button>
                            <!-- Dropdown Menu -->
                            <div class="absolute left-0 mt-0 w-56 bg-white border border-gray-200 rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                                <div class="px-4 py-2">
                                    <p class="text-xs font-semibold text-gray-700 mb-1">Refrigerators</p>
                                    <a href="{{ route('products.index', ['category' => 'refrigerators']) }}" class="block text-sm text-gray-700 hover:text-red-600 ml-2 py-1">90L, 532L</a>
                                </div>
                                <div class="px-4 py-2 border-t border-gray-200">
                                    <p class="text-xs font-semibold text-gray-700 mb-1">Chest Freezers</p>
                                    <a href="{{ route('products.index', ['category' => 'chest-freezers']) }}" class="block text-sm text-gray-700 hover:text-red-600 ml-2 py-1">100L, 200L</a>
                                </div>
                                <div class="px-4 py-2 border-t border-gray-200">
                                    <p class="text-xs font-semibold text-gray-700 mb-1">Mini Refrigerators</p>
                                    <a href="{{ route('products.index', ['category' => 'mini-refrigerators']) }}" class="block text-sm text-gray-700 hover:text-red-600 ml-2 py-1">181L</a>
                                </div>
                            </div>
                        </div>
                        
                        <span class="text-gray-400">|</span>
                        
                        <!-- KOREAN COSMETICS with Submenu -->
                        <div class="relative group">
                            <button class="font-semibold px-4 py-2 hover:text-gray-700 text-black flex items-center space-x-1">
                                <span>KOREAN COSMETICS</span>
                                <i class="fas fa-chevron-down text-xs"></i>
                            </button>
                            <!-- Dropdown Menu -->
                            <div class="absolute left-0 mt-0 w-48 bg-white border border-gray-200 rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                                <a href="{{ route('products.index', ['category' => 'skin-care']) }}" class="block px-4 py-2 text-gray-900 hover:bg-gray-100 first:rounded-t-lg">SKIN CARE</a>
                            </div>
                        </div>
                        
                        <span class="text-gray-400">|</span>
                        
                        <!-- BRAND SHOPS -->
                        <a href="{{ route('pages.brand-shops') }}" 
                           class="font-semibold px-4 py-2 hover:text-gray-700 text-black">
                            BRAND SHOPS
                        </a>
                        
                        <span class="text-gray-400">|</span>
                        
                        <!-- BLOG -->
                        <a href="{{ route('blog.index') }}" 
                           class="font-semibold px-4 py-2 hover:text-gray-700 text-black">
                            BLOG
                        </a>
                        
                        <span class="text-gray-400">|</span>
                        
                        <!-- SHOP NOW -->
                        <a href="{{ route('products.index') }}" 
                           class="font-semibold px-4 py-2 hover:text-gray-700 text-black">
                            SHOP NOW
                        </a>

                        <!-- VIP Offers Link -->
                        <a href="{{ route('pages.subscribe') }}" 
                        class="ml-auto font-semibold px-5 py-2 flex items-center space-x-2 
                                border-2 !border-red-600  
                                rounded-md bg-red-600 text-white 
                                transition duration-200 hover:bg-red-700">
                            <i class="fas fa-bell"></i>
                            <span>VIP Offers</span>
                        </a>

                        <!-- Search Icon Button -->
                        <button id="nav-search-button" class="ml-4 text-black hover:text-gray-700 p-2">
                            <i class="fas fa-search text-xl"></i>
                        </button>

                        <!-- Inline Search Form (Hidden by default) -->
                        <div id="nav-search-form" class="hidden ml-2 flex items-center bg-white rounded-lg overflow-hidden">
                            <form action="{{ route('products.index') }}" method="GET" class="flex">
                                <input type="text" 
                                    name="search" 
                                    value="{{ request('search') }}" 
                                    placeholder="Search product"
                                    class="px-3 py-2 text-sm text-gray-900 border-0 focus:ring-0 bg-white placeholder-gray-400 outline-none w-40">
                                <button type="submit" 
                                    class="px-3 py-2 text-gray-800 font-medium hover:bg-gray-100 border-l border-gray-300">
                                    <i class="fas fa-search"></i>
                                </button>
                            </form>
                        </div>

                        <!-- Cart with Dropdown -->
                        <!-- <div class="relative group hidden md:block ml-4"> -->
                            <!-- Cart Icon Trigger -->
                            <!-- <button class="flex items-center space-x-2 text-gray-600 hover:text-blue-600 relative">
                                <i class="fas fa-shopping-cart text-xl"></i>
                                <span class="absolute -top-2 -right-2 bg-blue-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center cart-count">0</span>
                            </button> -->
                            
                            <!-- Cart Dropdown -->
                            <!-- <div class="absolute right-0 top-full mt-2 w-96 bg-white border border-gray-200 rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                                <div class="p-4 border-b border-gray-200">
                                    <h3 class="text-lg font-semibold text-gray-900">Shopping Cart</h3>
                                </div>
                                <div class="cart-dropdown max-h-80 overflow-y-auto">
                                    <div class="p-4 text-center text-gray-500">Your cart is empty</div>
                                </div>
                                <div class="p-4 border-t border-gray-200">
                                    <div class="flex justify-between items-center mb-3">
                                        <span class="text-sm font-medium text-gray-700">Total:</span>
                                        <span class="text-lg font-bold text-gray-900 cart-dropdown-total">KES 0.00</span>
                                    </div>
                                    <a href="{{ route('cart.index') }}" class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg text-center block hover:bg-blue-700 transition-colors">
                                        View Cart
                                    </a>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </nav>
            </div>
        </div>
    </div>

    

</header>

<!-- Mobile Search Form -->
<div id="mobile-search" class="fixed inset-0 z-40 hidden bg-black bg-opacity-50">
    <div class="absolute top-0 left-0 right-0 bg-white p-4 shadow-lg">
        <div class="flex items-center space-x-3">
            <button id="mobile-search-close" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times text-xl"></i>
            </button>
            <form action="{{ route('products.index') }}" method="GET" class="flex-1 flex">
                <input type="text" name="search" value="{{ request('search') }}" class="flex-1 px-4 py-2 border border-gray-300 rounded-l-lg focus:ring-blue-500 focus:border-blue-500" placeholder="Search for electronics...">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-r-lg hover:bg-blue-700">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Mobile Drawer Menu -->
<div id="mobile-drawer" class="fixed inset-0 z-50 hidden">
    <!-- Backdrop -->
    <div id="mobile-drawer-backdrop" class="absolute inset-0 bg-black bg-opacity-50"></div>
    
    <!-- Drawer Content -->
    <div class="absolute right-0 top-0 h-full w-80 bg-white shadow-xl transform translate-x-full transition-transform duration-300">
        <!-- Header -->
        <div class="flex items-center justify-between p-4 border-b border-gray-200">
            <h2 class="text-xl font-bold text-gray-900">Menu</h2>
            <button id="mobile-drawer-close" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        
        <!-- Navigation -->
        <div class="p-4 h-full overflow-y-auto">
            <div class="space-y-4">
                <!-- Main Navigation -->
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-3">Navigation</h3>
                    <div class="space-y-2">
                        <a href="{{ route('home') }}" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-50 {{ request()->routeIs('home') ? 'bg-blue-50 text-blue-600' : 'text-gray-700' }}">
                            <i class="fas fa-home text-lg"></i>
                            <span>Home</span>
                        </a>
                        
                        <!-- TV/AUDIO Mobile Submenu -->
                        <div>
                            <button class="mobile-submenu-toggle w-full flex items-center justify-between space-x-3 p-3 rounded-lg hover:bg-gray-50 text-gray-700" data-submenu="tv-audio-mobile">
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-tv text-lg"></i>
                                    <span>TV/AUDIO</span>
                                </div>
                                <i class="fas fa-chevron-down text-xs"></i>
                            </button>
                            <div id="tv-audio-mobile" class="mobile-submenu hidden bg-gray-50 rounded-lg mt-1">
                                <a href="{{ route('products.index', ['search' => 'FHD']) }}" class="block px-6 py-2 text-sm text-gray-700 hover:text-red-600">HD - 32"</a>
                                <a href="{{ route('products.index', ['search' => 'FHD']) }}" class="block px-6 py-2 text-sm text-gray-700 hover:text-red-600">FHD - 43"</a>
                                <div class="px-4 py-2 border-t border-gray-200">
                                    <p class="text-sm font-semibold text-gray-700 mb-1">UHD</p>
                                    <a href="{{ route('products.index', ['search' => 'UHD']) }}" class="block text-sm text-gray-700 hover:text-red-600 ml-2 py-1">43", 50", 55"</a>
                                </div>
                                <div class="px-4 py-2 border-t border-gray-200">
                                    <p class="text-sm font-semibold text-gray-700 mb-1">QLED</p>
                                    <a href="{{ route('products.index', ['search' => 'QLED']) }}" class="block text-sm text-gray-700 hover:text-red-600 ml-2 py-1">55", 65", 75"</a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- HOME APPLIANCES Mobile Submenu -->
                        <div>
                            <button class="mobile-submenu-toggle w-full flex items-center justify-between space-x-3 p-3 rounded-lg hover:bg-gray-50 text-gray-700" data-submenu="appliances-mobile">
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-snowflake text-lg"></i>
                                    <span>HOME APPLIANCES</span>
                                </div>
                                <i class="fas fa-chevron-down text-xs"></i>
                            </button>
                            <div id="appliances-mobile" class="mobile-submenu hidden bg-gray-50 rounded-lg mt-1">
                                <div class="px-4 py-2">
                                    <p class="text-xs font-semibold text-gray-700 mb-1">Refrigerators</p>
                                    <a href="{{ route('products.index', ['category' => 'refrigerators']) }}" class="block text-sm text-gray-700 hover:text-red-600 ml-2 py-1">90L, 532L</a>
                                </div>
                                <div class="px-4 py-2 border-t border-gray-200">
                                    <p class="text-xs font-semibold text-gray-700 mb-1">Chest Freezers</p>
                                    <a href="{{ route('products.index', ['category' => 'chest-freezers']) }}" class="block text-sm text-gray-700 hover:text-red-600 ml-2 py-1">100L, 200L</a>
                                </div>
                                <div class="px-4 py-2 border-t border-gray-200">
                                    <p class="text-xs font-semibold text-gray-700 mb-1">Mini Refrigerators</p>
                                    <a href="{{ route('products.index', ['category' => 'mini-refrigerators']) }}" class="block text-sm text-gray-700 hover:text-red-600 ml-2 py-1">181L</a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- KOREAN COSMETICS Mobile Submenu -->
                        <div>
                            <button class="mobile-submenu-toggle w-full flex items-center justify-between space-x-3 p-3 rounded-lg hover:bg-gray-50 text-gray-700" data-submenu="cosmetics-mobile">
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-spa text-lg"></i>
                                    <span>KOREAN COSMETICS</span>
                                </div>
                                <i class="fas fa-chevron-down text-xs"></i>
                            </button>
                            <div id="cosmetics-mobile" class="mobile-submenu hidden bg-gray-50 rounded-lg mt-1">
                                <a href="{{ route('products.index', ['category' => 'skin-care']) }}" class="block px-6 py-2 text-sm text-gray-700 hover:text-red-600">Skin Care</a>
                            </div>
                        </div>
                        
                        <a href="{{ route('products.index') }}" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-50 {{ request()->routeIs('products.*') ? 'bg-blue-50 text-blue-600' : 'text-gray-700' }}">
                            <i class="fas fa-shopping-bag text-lg"></i>
                            <span>Products</span>
                        </a>
                        <a href="{{ route('pages.about') }}" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-50 text-gray-700">
                            <i class="fas fa-info-circle text-lg"></i>
                            <span>About</span>
                        </a>
                        <a href="{{ route('pages.contact') }}" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-50 text-gray-700">
                            <i class="fas fa-envelope text-lg"></i>
                            <span>Contact</span>
                        </a>
                        <a href="{{ route('pages.faq') }}" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-50 text-gray-700">
                            <i class="fas fa-question-circle text-lg"></i>
                            <span>FAQ</span>
                        </a>
                        <a href="{{ route('pages.subscribe') }}" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-50 text-gray-700">
                            <i class="fas fa-bell text-lg"></i>
                            <span>Subscribe</span>
                        </a>
                        <a href="{{ route('pages.vendors') }}" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-50 text-gray-700">
                            <i class="fas fa-handshake text-lg"></i>
                            <span>BE A VENDOR</span>
                        </a>
                    </div>
                </div>
                
                <!-- Categories -->
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-3">Categories</h3>
                    <div class="space-y-2">
                        @foreach(\App\Models\Category::active()->take(6)->get() as $category)
                            <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-50 text-gray-700">
                                <i class="{{ $category->icon }} text-lg"></i>
                                <span>{{ $category->name }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
                
                <!-- Account & Cart -->
                {{-- <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-3">Account</h3>
                    <div class="space-y-2">
                        @auth
                            <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-50 text-gray-700">
                                <i class="fas fa-user text-lg"></i>
                                <span>My Account</span>
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-50 text-gray-700">
                                <i class="fas fa-sign-in-alt text-lg"></i>
                                <span>Login</span>
                            </a>
                        @endauth
                        <a href="{{ route('cart.index') }}" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-50 text-gray-700">
                            <i class="fas fa-shopping-cart text-lg"></i>
                            <span>Cart</span>
                            <span class="ml-auto bg-blue-500 text-white text-xs rounded-full px-2 py-1 cart-count">0</span>
                        </a>
                        <a href="{{ route('wishlist.index') }}" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-50 text-gray-700">
                            <i class="fas fa-heart text-lg"></i>
                            <span>Wishlist</span>
                            <span class="ml-auto bg-red-500 text-white text-xs rounded-full px-2 py-1 wishlist-count">0</span>
                        </a>
                    </div>
                </div> --}}
                
                <!-- Contact Info -->
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-3">Contact</h3>
                    <div class="space-y-2">
                        <div class="flex items-center space-x-3 p-3 text-gray-700">
                            <a href="#" id="header-whatsapp-link" data-whatsapp="{{ Setting::get('social_whatsapp', '#') }}" class="text-green-600 hover:text-green-700 transition-colors">
                                <i class="fab fa-whatsapp text-lg"></i>
                            </a>
                            <span>{{ Setting::get('contact_phone', '+254 700 123 456') }}</span>
                        </div>
                        <div class="flex items-center space-x-3 p-3 text-gray-700">
                            <i class="fas fa-envelope text-lg"></i>
                            <span>{{ Setting::get('contact_email', 'hello@k-klec.co.ke') }}</span>
                        </div>
                        <div class="flex items-center space-x-3 p-3 text-gray-700">
                            <i class="fas fa-map-marker-alt text-lg"></i>
                            <span>{{ Setting::get('contact_address', 'Westlands, Nairobi') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Navigation Search Toggle Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchButton = document.getElementById('nav-search-button');
    const searchForm = document.getElementById('nav-search-form');
    
    if (searchButton && searchForm) {
        // Toggle search form visibility when button clicked
        searchButton.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            searchForm.classList.toggle('hidden');
            
            // Focus on input when search form opens
            if (!searchForm.classList.contains('hidden')) {
                const input = searchForm.querySelector('input[name="search"]');
                if (input) {
                    input.focus();
                }
            }
        });
        
        // Close search form when clicking outside
        document.addEventListener('click', function(e) {
            if (!searchForm.contains(e.target) && !searchButton.contains(e.target)) {
                searchForm.classList.add('hidden');
            }
        });
        
        // Prevent closing when clicking inside search form
        searchForm.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    }
    
    // Mobile Submenu Toggle
    const submenuToggles = document.querySelectorAll('.mobile-submenu-toggle');
    submenuToggles.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const submenuId = this.getAttribute('data-submenu');
            const submenu = document.getElementById(submenuId);
            
            if (submenu) {
                submenu.classList.toggle('hidden');
                
                // Rotate chevron icon
                const chevron = this.querySelector('.fa-chevron-down');
                if (chevron) {
                    chevron.style.transform = submenu.classList.contains('hidden') ? 'rotate(0)' : 'rotate(180deg)';
                    chevron.style.transition = 'transform 0.3s ease';
                }
            }
        });
    });
    
    // Handle header top WhatsApp and phone links
    const headerTopWhatsappLink = document.getElementById('header-top-whatsapp-link');
    const headerTopPhoneLink = document.getElementById('header-top-phone-link');
    
    [headerTopWhatsappLink, headerTopPhoneLink].forEach(link => {
        if (link) {
            const whatsappUrl = link.getAttribute('data-whatsapp');
            if (whatsappUrl && whatsappUrl !== '#') {
                const properLink = window.getProperWhatsAppLink(whatsappUrl, 'Hello, I would like to know more');
                link.href = properLink;
                link.target = '_blank';
                link.rel = 'noopener noreferrer';
            }
        }
    });
    
    // Handle header WhatsApp link
    const headerWhatsappLink = document.getElementById('header-whatsapp-link');
    if (headerWhatsappLink) {
        const whatsappUrl = headerWhatsappLink.getAttribute('data-whatsapp');
        if (whatsappUrl && whatsappUrl !== '#') {
            const properLink = window.getProperWhatsAppLink(whatsappUrl, 'Hello, I would like to know more');
            headerWhatsappLink.href = properLink;
            headerWhatsappLink.target = '_blank';
            headerWhatsappLink.rel = 'noopener noreferrer';
        }
    }
});
</script>