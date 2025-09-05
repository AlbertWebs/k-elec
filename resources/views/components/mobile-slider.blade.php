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
<div class="carousel-container relative overflow-hidden rounded-none lg:rounded-lg lg:mx-0 lg:hidden" style="height:350px;"> 
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            @foreach ($carouselSlides as $slide)
                <div class="swiper-slide flex items-center justify-center"
                     style="width:100% !important; height:350px; background-color:#000;">
                    
                    <img src="{{url('/')}}/storage/{{$slide->image}}" 
                         alt="Slide Image"
                         class="w-full h-full object-contain rounded-lg">
                         
                    <div class="absolute inset-0 flex flex-col items-center justify-center text-center px-4 py-8">
                        <img style="height:auto; object-fit:cover; margin:0 auto; visibility:hidden" 
                             src="{{ asset('images/logo.png') }}" 
                             alt="K-ELEC" class="h-16 brand-logo">
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
