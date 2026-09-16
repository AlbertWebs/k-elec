<section class="py-12 bg-gradient-to-r from-gray-50 to-white">
  <div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <h2 class="text-3xl font-bold text-center mb-12 text-gray-900">Authorized Retailers & Partners</h2>

    <div class="relative group">
      <!-- Slider Wrapper with scroll -->
      <div id="retailersWrapper" class="relative overflow-hidden">
        <!-- Scrollable track -->
        <div id="retailersTrack" class="flex gap-6 items-center">
          <!-- Jumia -->
          <a href="https://www.jumia.co.ke/kelec-kenya-limited" class="retailer-slide flex-shrink-0 w-1/2 md:w-1/2 lg:w-1/4 px-2">
            <div class="text-center">
              <div class="bg-white rounded-lg shadow-md p-4 h-28 sm:h-32 lg:h-36 flex items-center justify-center hover:shadow-lg transition-shadow cursor-pointer">
                  <img src="https://ng.jumia.is/cms/0-0-0-sandbox/thumbnails/jforce_220x220.png"
                    alt="Jumia"
                    class="w-28 h-28 object-cover">
              </div>
              <p class="mt-2 font-semibold text-gray-900 text-sm">Jumia</p>
            </div>
          </a>

          <!-- Kilimall -->
          <a href="https://www.kilimall.co.ke/store/K-ELEC" class="retailer-slide flex-shrink-0 w-1/2 md:w-1/2 lg:w-1/4 px-2">
            <div class="text-center">
              <div class="bg-white rounded-lg shadow-md p-4 h-28 sm:h-32 lg:h-36 flex items-center justify-center hover:shadow-lg transition-shadow cursor-pointer">
                  <img src="https://assets-cdn.salesmartly.com/pro/setting/chat/icon/216382/20241017/1729144195302/K.png"
                    alt="Kilimall"
                    class="w-28 h-28 object-cover">
              </div>
              <p class="mt-2 font-semibold text-gray-900 text-sm">Kilimall</p>
            </div>
          </a>

          <!-- Carrefour (Coming Soon) -->
          <div class="retailer-slide flex-shrink-0 w-1/2 md:w-1/2 lg:w-1/4 px-2 relative">
            <div class="text-center">
              <div class="bg-white rounded-lg shadow-md p-4 h-28 sm:h-32 lg:h-36 flex items-center justify-center hover:shadow-lg transition-shadow cursor-pointer">
                  <img src="https://cdnprod.mafretailproxy.com/assets/images/Media_Search_leading_3b9e5ca618.svg"
                    alt="Carrefour"
                    class="w-28 h-28 object-cover">
              </div>
              <p class="mt-2 font-semibold text-gray-900 text-sm">Carrefour</p>
            </div>
            <span class="absolute -top-1 -right-2 bg-yellow-500 text-white text-xs font-bold px-2 py-1 rounded-bl-lg rounded-tr-lg">Coming Soon</span>
          </div>

          <!-- Naivas (Coming Soon) -->
          <div class="retailer-slide flex-shrink-0 w-1/2 md:w-1/2 lg:w-1/4 px-2 relative">
            <div class="text-center">
              <div class="bg-white rounded-lg shadow-md p-4 h-28 sm:h-32 lg:h-36 flex items-center justify-center hover:shadow-lg transition-shadow cursor-pointer">
                  <img src="https://fc-euc1-00-pics-bkt-00.s3.eu-central-1.amazonaws.com/fc18f2f481390c2f467c93d887453ee793e2b848efc47f84a64d61b55a59e142/f_appLevelPicFull/img_fhqph6fhfs_7f561608f59bcfb91594d2313e84dd916dbd436bc410f56243260b49ee1e3ccb.png"
                    alt="Naivas"
                    class="w-28 h-28 object-cover">
              </div>
              <p class="mt-2 font-semibold text-gray-900 text-sm">Naivas</p>
            </div>
            <span class="absolute -top-1 -right-2 bg-yellow-500 text-white text-xs font-bold px-2 py-1 rounded-bl-lg rounded-tr-lg">Coming Soon</span>
          </div>

          <!-- Quickmart (Coming Soon) -->
          <div class="retailer-slide flex-shrink-0 w-1/2 md:w-1/2 lg:w-1/4 px-2 relative">
            <div class="text-center">
              <div class="bg-white rounded-lg shadow-md p-4 h-28 sm:h-32 lg:h-36 flex items-center justify-center hover:shadow-lg transition-shadow cursor-pointer">
                  <img src="https://www.quickmart.co.ke/image/apple-touch-icon/1/"
                    alt="Quickmart"
                    class="w-28 h-28 object-cover">
              </div>
              <p class="mt-2 font-semibold text-gray-900 text-sm">Quickmart</p>
            </div>
            <span class="absolute -top-1 -right-2 bg-yellow-500 text-white text-xs font-bold px-2 py-1 rounded-bl-lg rounded-tr-lg">Coming Soon</span>
          </div>
        </div>
      </div>

      <!-- Left Arrow Button -->
      <button id="retailersArrowLeft" class="absolute left-2 top-1/2 -translate-y-1/2 z-20 bg-red-600 text-white p-2 rounded-full shadow-lg hover:bg-red-700 transition-colors" title="Scroll Left">
        <i class="fas fa-chevron-left text-lg"></i>
      </button>

      <!-- Right Arrow Button -->
      <button id="retailersArrowRight" class="absolute right-2 top-1/2 -translate-y-1/2 z-20 bg-red-600 text-white p-2 rounded-full shadow-lg hover:bg-red-700 transition-colors" title="Scroll Right">
        <i class="fas fa-chevron-right text-lg"></i>
      </button>
    </div>
  </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const wrapper = document.getElementById('retailersWrapper');
  const track = document.getElementById('retailersTrack');
  const arrowLeft = document.getElementById('retailersArrowLeft');
  const arrowRight = document.getElementById('retailersArrowRight');
  let slides = Array.from(track.querySelectorAll('.retailer-slide'));
  let autoPlayInterval = null;

  // Clone slides to allow smooth scrolling when number of slides <= visible columns
  if (slides.length > 0) {
    const original = slides.slice();
    original.forEach(s => track.appendChild(s.cloneNode(true)));
    slides = Array.from(track.querySelectorAll('.retailer-slide'));
  }

  function getVisibleCount() {
    const w = window.innerWidth;
    if (w >= 1024) return 4; // lg
    if (w >= 768) return 2;  // md
    return 2;                // sm and xs use 2 for better visibility
  }

  function getStepSize() {
    if (!slides.length) return 0;
    const slideRect = slides[0].getBoundingClientRect();
    const gap = parseFloat(getComputedStyle(track).gap) || 0;
    return slideRect.width + gap;
  }

  function scrollStep() {
    if (!slides.length) return;
    const step = getStepSize();
    const maxScroll = track.scrollWidth - wrapper.clientWidth;
    let next = Math.round(wrapper.scrollLeft + step);
    if (next > maxScroll - 1) {
      // smoothly reset to start
      wrapper.scrollTo({ left: 0, behavior: 'smooth' });
    } else {
      wrapper.scrollTo({ left: next, behavior: 'smooth' });
    }
  }

  function scrollLeft() {
    if (!slides.length) return;
    const step = getStepSize();
    let next = Math.max(0, wrapper.scrollLeft - step);
    wrapper.scrollTo({ left: next, behavior: 'smooth' });
    stopAutoPlay();
    setTimeout(startAutoPlay, 500);
  }

  function scrollRight() {
    if (!slides.length) return;
    const step = getStepSize();
    const maxScroll = track.scrollWidth - wrapper.clientWidth;
    let next = Math.min(maxScroll, wrapper.scrollLeft + step);
    wrapper.scrollTo({ left: next, behavior: 'smooth' });
    stopAutoPlay();
    setTimeout(startAutoPlay, 500);
  }

  function startAutoPlay() {
    stopAutoPlay();
    autoPlayInterval = setInterval(scrollStep, 4000);
  }

  function stopAutoPlay() {
    if (autoPlayInterval) clearInterval(autoPlayInterval);
    autoPlayInterval = null;
  }

  // Arrow button click handlers
  arrowLeft.addEventListener('click', scrollLeft);
  arrowRight.addEventListener('click', scrollRight);

  // Pause on hover
  wrapper.addEventListener('mouseenter', stopAutoPlay);
  wrapper.addEventListener('mouseleave', startAutoPlay);

  // Restart on resize to recalculate widths
  window.addEventListener('resize', () => {
    // small debounce
    stopAutoPlay();
    setTimeout(startAutoPlay, 250);
  });

  // make wrapper scrollable programmatically
  wrapper.style.scrollBehavior = 'smooth';

  startAutoPlay();
});
</script>
