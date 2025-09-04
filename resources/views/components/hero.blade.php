  <section class="bg-white py-0 lg:py-12">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8" >
          <div class="grid grid-cols-1 lg:grid-cols-4 gap-3">

              {{--  --}}
              <div class="hidden lg:block lg:col-span-1 flex-col gap-2 h-full">
                  <!-- Top Image -->
                  <div class="mb-4">
                      <img src="{{ url('/') }}/storage/{{ $bannerPosition1->image }}" alt="Top Banner"
                          class="w-full rounded object-cover">
                  </div>

                  


                  <!-- Bottom Image -->
                  <div class="mt-0" style="bottom:0 ! important">
                      <img src="{{ url('/') }}/storage/{{ $bannerPosition2->image }}" alt="Middle Banner"
                          class="w-full  rounded object-cover">
                  </div>


              </div>

              {{--  --}}
              <!-- Main Banner Carousel -->
              <div class="lg:col-span-3 relative bg-blacks rounded hidden lg:block h-full">
                @if ($carouselSlides->count() > 0)
                    <div class="carousel-container relative overflow-hidden rounded-none lg:rounded-lg -mx-4 lg:mx-0">
                        @foreach ($carouselSlides as $index => $slide)
                            <div class="carousel-slide {{ $index === 0 ? 'active' : '' }} 
                                        bg-gradient-to-r {{ $slide->background_classes }} 
                                        p-4 lg:p-8 bg-cover bg-center bg-no-repeat flex items-center justify-center"
                                style="background-image: url('{{url('/')}}/storage/{{$slide->image}}'); height:100%;">
                                
                                <div class="text-center max-w-2xl">
                                    {{-- <span class="{{ $slide->text_color_class }} font-semibold text-sm lg:text-base">{{ $slide->title }}</span> --}}
                                    <img style="width:180px; height:auto; object-fit:cover; margin:0 auto;" src="{{ asset('images/logo-white.png') }}" alt="K-ELEC" class="h-16 brand-logo">
                                    
                                    <h2 class="text-3xl lg:text-5xl xl:text-4xl font-bold text-white mt-2 mb-4"
                                        style="font-size:55px; line-height:1.2;">
                                        {{ $slide->heading }}
                                    </h2>
                                    
                                    <p class="text-white mb-6 text-md lg:text-3xl font-semibold" style="font-size:25px;">
                                        {{ $slide->description }}
                                    </p>
                                    
                                    @if ($slide->button_text)
                                        <a href="{{ $slide->button_link ?? route('products.index') }}"
                                        class="inline-block bg-black text-white px-4 py-2 lg:px-6 lg:py-3 rounded-lg font-semibold hover:bg-gray-800 text-sm lg:text-base">
                                            {{ $slide->button_text }} →
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Carousel Navigation & Indicators remain unchanged -->
                @else
                    <!-- Fallback content -->
                    <div class="bg-gradient-to-r from-blue-100 to-blue-200 p-4 lg:p-8 rounded-none lg:rounded-lg -mx-4 lg:mx-0 flex items-center justify-center">
                        <div class="text-center max-w-2xl">
                            <span class="text-blue-600 font-semibold text-sm lg:text-base">Welcome</span>
                            <h2 class="text-2xl lg:text-3xl xl:text-4xl font-bold text-gray-900 mt-2 mb-4">K-Elec</h2>
                            <p class="text-gray-600 mb-6 text-sm lg:text-base">Your trusted source for quality Korean electronics and technology</p>
                            <a href="{{ route('products.index') }}"
                            class="inline-block bg-black text-white px-4 py-2 lg:px-6 lg:py-3 rounded-lg font-semibold hover:bg-gray-800 text-sm lg:text-base">
                            Shop Now →
                            </a>
                        </div>
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
