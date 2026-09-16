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

.carousel-containers {
    height: 720px !important; /* Set explicit height to 720px */
    width: 100% !important;
    max-height: -webkit-fill-available; /* Fix for iPhone Safari */
}

.carousel-containers .swiper-slide {
    height: 720px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
}

/* Responsive heights */
@media (max-width: 1024px) {
    .carousel-containers,
    .carousel-containers .swiper-slide {
        height: 640px !important;
    }
}

@media (max-width: 768px) {
    .carousel-containers,
    .carousel-containers .swiper-slide {
        height: 480px !important;
    }
}

@media (max-width: 640px) {
    .carousel-containers,
    .carousel-containers .swiper-slide {
        height: 380px !important;
    }
}
</style>

<!-- Carousel -->
<div class="carousel-container carousel-containers relative overflow-hidden rounded-none lg:rounded-lg lg:mx-0 lg:hidden border border-black"> 
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            @foreach ($carouselSlides as $slide)
                <div class="swiper-slide flex items-center justify-center bg-black">
                    <a href="{{ $slide->button_link }}" class="block w-full h-full flex items-center justify-center">
                        <img src="{{ url('/') }}/storage/{{ $slide->image }}" 
                             alt="Slide Image"
                             class="max-h-[80vh] w-auto object-contain rounded-lg mx-auto">
                             
                        <div class="absolute inset-0 flex flex-col items-center justify-center text-center px-4 py-8">
                            <img src="{{ asset('images/logo.png') }}" 
                                 alt="K-ELEC" 
                                 class="h-16 brand-logo mx-auto"
                                 style="visibility:hidden">
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <!-- Pagination (dots) -->
        <div class="swiper-pagination !bottom-2"></div>
    </div>
</div>






<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    // Ensure all mobile slider links open in same tab
    const mobileSliderLinks = document.querySelectorAll('.carousel-containers a[href]');
    mobileSliderLinks.forEach(link => {
        link.removeAttribute('target');
        link.rel = '';
    });

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
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
    });
});
</script>
