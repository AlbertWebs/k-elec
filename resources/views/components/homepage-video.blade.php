@if(isset($homepageVideo) && $homepageVideo && $homepageVideo->isVisible())
<section class="homepage-video-section bg-white pt-6 lg:pt-12 pb-0" data-homepage-video="1" aria-label="{{ $homepageVideo->title ?: 'Featured video' }}">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="homepage-video-frame">
            @if($homepageVideo->usesUploadedFile() || $homepageVideo->usesRemoteFile())
                <video class="homepage-video-player" controls preload="metadata" playsinline @if($homepageVideo->poster_url) poster="{{ $homepageVideo->poster_url }}" @endif>
                    <source src="{{ $homepageVideo->file_url }}">
                    Your browser does not support the video tag.
                </video>
            @elseif($homepageVideo->usesEmbed())
                <iframe src="{{ $homepageVideo->embed_url }}"
                        title="{{ $homepageVideo->title ?: 'Featured video' }}"
                        class="homepage-video-player"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen
                        loading="lazy"></iframe>
            @endif
        </div>
    </div>
</section>
@endif
