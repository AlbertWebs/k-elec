<!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<style>
/* Make all dots red */
.swiper-pagination-bullet {
    background: red !important;
}

/* Optional: active dot slightly darker red */
.swiper-pagination-bullet-active {
    background: #b91c1c !important; /* Tailwind's red-700 */
}

</style>

<!-- Carousel -->
<div class="carousel-container relative overflow-hidden rounded-none lg:rounded-lg lg:mx-0 lg:hidden">
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            @foreach ($carouselSlides as $slide)
                <div class="swiper-slide p-4 lg:p-8 bg-cover bg-center bg-no-repeat"
                    style="background-image: url('{{url('/')}}/{{ Storage::url($slide->image) }}'); min-height:350px; background-size: cover contain; background-position: center;">
                    <div class="flex flex-col items-center justify-center text-center px-4 py-8 mt-[130px]" style="margin-top:130px">
                        {{-- <h2 class="text-3xl lg:text-5xl xl:text-4xl font-bold {{ $slide->text_color_class }} mt-2 mb-4">
                            {{ $slide->heading }}
                        </h2> --}}
                        {{-- <p class="text-white mb-6 lg:text-lg text-md font-semibold">
                            {{ $slide->description }}
                        </p> --}}
                        {{-- @if ($slide->button_text)
                            <a href="{{ $slide->button_link ?? route('products.index') }}"
                               class="inline-block bg-black text-white px-4 py-2 lg:px-6 lg:py-3 rounded-lg font-semibold hover:bg-gray-800 text-sm lg:text-base">
                               {{ $slide->button_text }} →
                            </a>
                        @endif --}}
                    </div>
                </div>
            @endforeach
        </div>

       
       
    </div>
     <!-- Pagination (dots) -->
        <div class="swiper-pagination"></div>
</div>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    new Swiper(".mySwiper", {
        loop: true,
        slidesPerView: 1,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
});
</script>
