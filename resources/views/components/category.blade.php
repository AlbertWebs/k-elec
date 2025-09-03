<section class="py-16 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-left mb-12 mobile-heading">All Categories</h2>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-4 md:gap-6">
                @foreach($categories as $category)
                    <a href="{{ route('products.index', ['category' => $category->slug]) }}"
                    class="relative block rounded-2xl shadow-lg overflow-hidden h-64 p-4 rounded" >

                        <!-- Forced gradient background (works even if Tailwind gradient classes aren't available) -->
                        <span aria-hidden="true"
                            class="absolute inset-0 pointer-events-none"
                            style="background: linear-gradient(to bottom, #DC2626, #991B1B);">
                        </span>

                        <!-- Category Title (top center) -->
                        <div class="relative z-10 absolute top-4 left-1/2 -translate-x-1/2 
                                    text-white font-bold text-lg text-center text-4xl category-title">
                            {{ $category->name }}
                        </div>

                        <!-- Category Image (bottom 50% touching bottom) -->
                       <!-- Image at the bottom -->
                        <div class="category-image-wrapper" >
                            <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}"  class="w-full category-image"  />
                        </div>

                    </a>
                @endforeach

            </div>
        </div>
    </section>