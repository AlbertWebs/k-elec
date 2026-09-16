<section class="bg-white py-0 lg:py-0 w-full">
  <!-- Remove the container div wrapper to make it full-width -->
  <div class="w-full px-0 sm:px-0 lg:px-0">
    <div class="grid grid-cols-1 lg:grid-cols-1 gap-3 items-stretch w-full">
      
      <!-- Left Column -->
      <!-- <div class="hidden lg:flex lg:col-span-1 flex-col h-full"> -->
        <!-- Top Image -->
        <!-- @if($bannerPosition1)
        <div class="mb-4 flex-1">
          @if($bannerPosition1->url)
            <a href="{{$bannerPosition1->url}}">
          @endif
          <img src="{{ url('/') }}/storage/{{ $bannerPosition1->image }}" alt="Top Banner"
            class="w-full h-full rounded object-cover" style="border-radius:10px;">
          @if($bannerPosition1->url)
            </a>
          @endif
        </div>
        @endif -->
        <!-- Bottom Image -->
        <!-- @if($bannerPosition2)
        <div class="mt-0 flex-1">
          @if($bannerPosition2->url)
            <a href="{{$bannerPosition2->url}}">
          @endif
          <img src="{{ url('/') }}/storage/{{ $bannerPosition2->image }}" alt="Middle Banner"
            class="w-full h-full rounded object-cover" style="border-radius:10px; border: 1px solid #e2e8f0;">
          @if($bannerPosition2->url)
            </a>
          @endif
        </div>
        @endif
      </div> -->

      <!-- Right Column -->
      <div class="lg:col-span-3 relative bg-blacks rounded hidden lg:block h-full flex w-full">
        @if ($carouselSlides->count() > 0)
          <div class="carousel-container relative overflow-hidden rounded-none w-full -mx-0 lg:-mx-0 flex-1 swiper mySwiper" style="height: 720px;">
            
            <div class="swiper-wrapper">
              @foreach ($carouselSlides as $index => $slide)
                <div class="swiper-slide" style="height: 720px;">
                  <a href="{{ $slide->button_link }}" class="block w-full h-full" target="_self">
                    <div class="bg-gradient-to-r {{ $slide->background_classes }} 
                                p-4 lg:p-8 bg-cover bg-center bg-no-repeat flex items-center justify-center h-full"
                      style="background-image: url('{{ url('/') }}/storage/{{ $slide->image }}'); background-size: cover; background-position: center;">
                      
                      <div class="text-center max-w-2xl">
                        <img src="{{ asset('images/logo.png') }}" alt="K-ELEC" 
                            class="h-16 brand-logo mx-auto mb-4" style="visibility:hidden">
                        <h2 class="text-3xl lg:text-5xl xl:text-4xl font-bold text-white mb-4"
                            style="font-size:55px; line-height:1.2; visibility:hidden">
                            {{ $slide->heading }}
                        </h2>
                        <p class="text-white text-lg lg:text-3xl font-semibold"
                          style="font-size:25px; visibility:hidden">
                          {{ $slide->description }}
                        </p>
                      </div>
                    </div>
                  </a>
                </div>
              @endforeach

            </div>

            <!-- Pagination Dots -->
            <div class="swiper-pagination !bottom-4"></div>
            <!-- Navigation Arrows -->
            <div class="swiper-button-prev text-white" style="color:#ffffff"></div>
            <div class="swiper-button-next text-white"  style="color:#ffffff"></div>
          </div>
      
        @endif
      </div>

    </div>
  </div>
</section>



<script>
document.addEventListener('DOMContentLoaded', function () {
    // Ensure all carousel links open in the same tab - remove any target attributes
    const allCarouselLinks = document.querySelectorAll('.carousel-container a[href], .swiper a[href]');
    allCarouselLinks.forEach(link => {
        link.removeAttribute('target');
        link.rel = '';
    });
});
</script>



  <!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
  var swiper = new Swiper(".mySwiper", {
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
          delay: 5000,   // 5 seconds
          disableOnInteraction: false, // keeps autoplay even after manual swipe
      },
  });
</script>




  {{-- mobile --}}

    <x-mobile-slider :carouselSlides="$carouselSlides" />
  {{--  --}}
