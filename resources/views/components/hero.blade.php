  <section class="bg-white py-0 lg:py-12">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8">
          <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

              {{--  --}}
              <div class="hidden lg:block lg:col-span-1 flex-col h-full">
                  <!-- Top Image -->
                  <div class="mb-4">
                      <img src="{{ url('/') }}/storage/{{ $bannerPosition1->image }}" alt="Top Banner"
                          class="w-full rounded-lg object-cover">
                  </div>

                  <!-- Bottom Image -->
                  <div class="mb-0">
                      <img src="{{ url('/') }}/storage/{{ $bannerPosition2->image }}" alt="Middle Banner"
                          class="w-full rounded-lg object-cover">
                  </div>


              </div>

              {{--  --}}
              <!-- Main Banner Carousel -->
              <div class="lg:col-span-3 relative bg-blacks rounded hidden lg:block h-full">
                  @if ($carouselSlides->count() > 0)
                      <div class="carousel-container relative overflow-hidden rounded-none lg:rounded-lg -mx-4 lg:mx-0">
                          <div
                              class="carousel-container relative overflow-hidden rounded-none lg:rounded-lg -mx-4 lg:mx-0">
                              @foreach ($carouselSlides as $index => $slide)
                                  <div class="carousel-slide {{ $index === 0 ? 'active' : '' }} bg-gradient-to-r {{ $slide->background_classes }} p-4 lg:p-8 bg-cover bg-center bg-no-repeat"
                                      style="background-image: url('{{ Storage::url($slide->image) }}'); 
                                                background-size: cover; 
                                                background-position: center;">
                                      <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 lg:gap-8 items-center">
                                          <div style="padding-top:160px">
                                              <span
                                                  class="{{ $slide->text_color_class }} font-semibold text-sm lg:text-base">{{ $slide->title }}</span>
                                              <h2 class="text-3xl lg:text-5xl xl:text-4xl font-bold text-white mt-2 mb-4"
                                                  style="font-size:55px;">{{ $slide->heading }}</h2>
                                              <p class="text-white mb-6 lg:text-3xl text-md lg:text-base"
                                                  style="font-size:25px; font-weight:600">{{ $slide->description }}</p>
                                              {{-- <h4 style="font-size:25px" class="text-lg font-bold text-white">Kes. 83,000</h4> --}}

                                              <br><br>
                                              @if ($slide->button_text)
                                                  <a href="{{ $slide->button_link ?? route('products.index') }}"
                                                      class="inline-block bg-black text-white px-4 py-2 lg:px-6 lg:py-3 rounded-lg font-semibold hover:bg-gray-800 text-sm lg:text-base">
                                                      {{ $slide->button_text }} →
                                                  </a>
                                              @endif
                                          </div>
                                      </div>
                                  </div>
                              @endforeach
                          </div>


                          <!-- Carousel Navigation -->
                          {{-- <button class="carousel-btn carousel-prev absolute left-2 lg:left-4 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-80 hover:bg-opacity-100 text-gray-800 p-2 rounded-full shadow-lg transition-all duration-200">
                                <svg class="w-5 h-5 lg:w-6 lg:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                            </button> --}}
                          <button
                              class="carousel-btn carousel-next absolute right-2 lg:right-4 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-80 hover:bg-opacity-100 text-gray-800 p-2 rounded-full shadow-lg transition-all duration-200">
                              <svg class="w-5 h-5 lg:w-6 lg:h-6" fill="none" stroke="currentColor"
                                  viewBox="0 0 24 24">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 5l7 7-7 7"></path>
                              </svg>
                          </button>
                      </div>

                      <!-- Carousel Indicators -->
                      <div
                          class="absolute bottom-2 lg:bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-1 lg:space-x-2 z-20">
                          @foreach ($carouselSlides as $index => $slide)
                              <button
                                  class="carousel-dot w-6 h-1 lg:w-8 lg:h-1 bg-gray-800 {{ $index === 0 ? 'bg-opacity-80' : 'bg-opacity-50' }} hover:bg-opacity-100 rounded-full transition-all duration-200"
                                  data-slide="{{ $index }}"></button>
                          @endforeach
                      </div>
                  @else
                      <!-- Fallback when no slides are available -->
                      <div
                          class="bg-gradient-to-r from-blue-100 to-blue-200 p-4 lg:p-8 rounded-none lg:rounded-lg -mx-4 lg:mx-0">
                          <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 lg:gap-8 items-center">
                              <div>
                                  <span class="text-blue-600 font-semibold text-sm lg:text-base">Welcome</span>
                                  <h2 class="text-2xl lg:text-3xl xl:text-4xl font-bold text-gray-900 mt-2 mb-4">K-Elec
                                  </h2>
                                  <p class="text-gray-600 mb-6 text-sm lg:text-base">Your trusted source for quality
                                      Korean electronics and technology</p>
                                  <a href="{{ route('products.index') }}"
                                      class="inline-block bg-black text-white px-4 py-2 lg:px-6 lg:py-3 rounded-lg font-semibold hover:bg-gray-800 text-sm lg:text-base">
                                      Shop Now →
                                  </a>
                              </div>
                              <div class="hidden lg:flex justify-center lg:justify-end">
                                  <img src="{{ asset('assets/images/1-DloPm3Vx.png') }}" alt="Electronics Product"
                                      class="max-w-xs lg:max-w-sm object-cover rounded-lg shadow-lg">
                              </div>
                          </div>
                      </div>
                  @endif
              </div>
          </div>
      </div>
  </section>



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
