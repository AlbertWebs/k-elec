@if(!isset($homepageVideo) || !$homepageVideo || $homepageVideo->is_active)
<section class="py-6 bg-gray-100" data-about-kelec="1">
<h2 class="mt-4 mb-8 text-2xl lg:text-3xl font-bold text-black-900 text-center">{{ $homepageVideo->title ?? 'ABOUT K-ELEC' }}</h2>
  <div class="container mx-auto px-4 sm:px-6 lg:px-8 border-2 !border-gray-100 py-2 rounded-lg" style="border: 2px solid #e5e7eb;">
    <div class="flex flex-col gap-8">
      
      
      
      <!-- Video/Image Container -->
      <div class="flex justify-center">
        <div class="w-full max-w-6xl" style="height: 600px;">
          @if(isset($homepageVideo) && $homepageVideo && ($homepageVideo->usesUploadedFile() || $homepageVideo->usesRemoteFile()))
            <video class="w-full h-full rounded-lg shadow-lg" controls preload="metadata" playsinline @if($homepageVideo->poster_url) poster="{{ $homepageVideo->poster_url }}" @endif>
                <source src="{{ $homepageVideo->file_url }}">
                Your browser does not support the video tag.
            </video>
          @else
            <iframe 
              src="{{ (isset($homepageVideo) && $homepageVideo && $homepageVideo->embed_url) ? $homepageVideo->embed_url : \App\Models\HomepageVideo::DEFAULT_VIDEO_URL }}" 
              class="w-full h-full rounded-lg shadow-lg"
              title="{{ $homepageVideo->title ?? 'ABOUT K-ELEC' }}"
              frameborder="0" 
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
              allowfullscreen>
            </iframe>
          @endif
        </div>
      </div>
      
      <!-- Text Content -->
      <div class="text-center">
        <p class="text-lg lg:text-xl text-black-900 font-semibold leading-relaxed mb-6">
          FIRST EVER KOREAN TECHNOLOGY PRODUCTION IN KENYA, THE HEART OF EAST AFRICA
        </p>
        <a href="/k-elec" class="inline-block px-8 py-3 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition-colors duration-200">
          Learn More
        </a>
      </div>

    </div>
  </div>
</section>
@endif
