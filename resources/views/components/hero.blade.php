<section class="bg-white py-0 lg:py-12">
  <div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-3 items-stretch">
      
      <!-- Left Column -->
      <div class="hidden lg:flex lg:col-span-1 flex-col h-full">
        <!-- Top Image -->
        <div class="mb-4 flex-1">
          <img src="{{ url('/') }}/storage/{{ $bannerPosition1->image }}" alt="Top Banner"
            class="w-full h-full rounded object-cover" style="border-radius:10px;">
        </div>
        <!-- Bottom Image -->
        <div class="mt-0 flex-1">
          <img src="{{ url('/') }}/storage/{{ $bannerPosition2->image }}" alt="Middle Banner"
            class="w-full h-full rounded object-cover" style="border-radius:10px; border: 1px solid #e2e8f0;">
        </div>
      </div>

      <!-- Right Column -->
      <div class="lg:col-span-3 relative bg-blacks rounded hidden lg:block h-full flex">
        @if ($carouselSlides->count() > 0)
          <div class="carousel-container relative overflow-hidden rounded-none lg:rounded-lg -mx-4 lg:mx-0 flex-1">
            @foreach ($carouselSlides as $index => $slide)
              <div class="carousel-slide {{ $index === 0 ? 'active' : '' }} 
                          bg-gradient-to-r {{ $slide->background_classes }} 
                          p-4 lg:p-8 bg-cover bg-center bg-no-repeat flex items-center justify-center h-full"
                style="background-image: url('{{url('/')}}/storage/{{$slide->image}}'); ">
                
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
            @endforeach
          </div>
        @endif
      </div>

    </div>
  </div>
</section>


  <script>
document.addEventListener('DOMContentLoaded', function () {
    const slides = document.querySelectorAll('.carousel-slide');
    const nextBtn = document.querySelector('.carousel-next');
    const prevBtn = document.querySelector('.carousel-prev');
    const dots = document.querySelectorAll('.carousel-dot');
    let current = 0;
    let autoPlayInterval;

    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.classList.remove('active', 'prev');
            if(i < index) slide.classList.add('prev');
        });
        slides[index].classList.add('active');
        updateDots(index);
        current = index;
    }

    function nextSlide() {
        let nextIndex = (current + 1) % slides.length;
        showSlide(nextIndex);
    }

    function prevSlide() {
        let prevIndex = (current - 1 + slides.length) % slides.length;
        showSlide(prevIndex);
    }

    function updateDots(index) {
        dots.forEach((dot, i) => {
            dot.classList.remove('bg-opacity-80');
            dot.classList.add('bg-opacity-50');
            if(i === index) {
                dot.classList.remove('bg-opacity-50');
                dot.classList.add('bg-opacity-80');
            }
        });
    }

    // Event Listeners
    nextBtn?.addEventListener('click', nextSlide);
    prevBtn?.addEventListener('click', prevSlide);
    dots.forEach(dot => {
        dot.addEventListener('click', () => showSlide(parseInt(dot.dataset.slide)));
    });

    // Auto-play every 5 seconds
    autoPlayInterval = setInterval(nextSlide, 5000);

    // Pause on hover
    const carouselContainer = document.querySelector('.carousel-container');
    carouselContainer.addEventListener('mouseenter', () => clearInterval(autoPlayInterval));
    carouselContainer.addEventListener('mouseleave', () => autoPlayInterval = setInterval(nextSlide, 5000));
});
</script>



  <!-- Swiper CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

  <!-- Swiper JS -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

  <script>
      var swiper = new Swiper(".mySwiper", {
          loop: true,
          slidesPerView: 1, // mobile-first: one slide per screen
          pagination: {
              el: ".swiper-pagination",
              clickable: true,
          },
          navigation: {
              nextEl: ".swiper-button-next",
              prevEl: ".swiper-button-prev",
          },
      });
  </script>



  {{-- mobile --}}

    <x-mobile-slider :carouselSlides="$carouselSlides" />
  {{--  --}}
