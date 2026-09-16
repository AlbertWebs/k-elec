@extends('layouts.admin')

@section('title', 'Homepage Video')

@section('content')
<div class="space-y-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Homepage Video</h1>
        <p class="text-gray-600">Edit the video shown above the hero on the home page, or hide the section entirely.</p>
    </div>

    <!-- Visibility toggle -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-lg font-semibold text-gray-900">Show video section</h2>
                <p class="text-sm text-gray-600 mt-1">
                    When hidden, visitors will not see this section on the homepage at all.
                </p>
            </div>

            <form method="POST" action="{{ route('admin.homepage-video.toggle') }}">
                @csrf
                @method('PATCH')
                <button type="submit"
                        role="switch"
                        aria-checked="{{ $homepageVideo->is_active ? 'true' : 'false' }}"
                        class="relative inline-flex h-8 w-16 items-center rounded-full transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 {{ $homepageVideo->is_active ? 'bg-green-600' : 'bg-gray-300' }}">
                    <span class="sr-only">{{ $homepageVideo->is_active ? 'Hide section' : 'Show section' }}</span>
                    <span class="inline-block h-6 w-6 transform rounded-full bg-white shadow transition {{ $homepageVideo->is_active ? 'translate-x-9' : 'translate-x-1' }}"></span>
                </button>
            </form>
        </div>

        <div class="mt-4">
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $homepageVideo->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                {{ $homepageVideo->is_active ? 'Visible on homepage' : 'Hidden from homepage' }}
            </span>
            @if($homepageVideo->is_active && !$homepageVideo->hasMedia())
                <span class="ml-2 text-sm text-amber-600">Add a video below to display the section.</span>
            @endif
        </div>
    </div>

    <!-- Edit video -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-6">Video content</h2>

        <form action="{{ route('admin.homepage-video.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title (optional)</label>
                <input type="text" id="title" name="title"
                       value="{{ old('title', $homepageVideo->title) }}"
                       placeholder="e.g. Brand film"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            @if($homepageVideo->hasMedia())
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Current video</label>
                    <div class="max-w-xl rounded-lg overflow-hidden border border-gray-200 bg-black">
                        @if($homepageVideo->usesUploadedFile() || $homepageVideo->usesRemoteFile())
                            <video class="w-full" controls preload="metadata" @if($homepageVideo->poster_url) poster="{{ $homepageVideo->poster_url }}" @endif>
                                <source src="{{ $homepageVideo->file_url }}">
                                Your browser does not support the video tag.
                            </video>
                        @elseif($homepageVideo->usesEmbed())
                            <div class="relative w-full" style="padding-top: 56.25%;">
                                <iframe src="{{ $homepageVideo->embed_url }}"
                                        title="{{ $homepageVideo->title ?: 'Homepage video' }}"
                                        class="absolute inset-0 w-full h-full"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            <div>
                <label for="video" class="block text-sm font-medium text-gray-700 mb-1">Upload video file</label>
                <input type="file" id="video" name="video" accept="video/mp4,video/webm,video/ogg,video/quicktime"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <p class="text-xs text-gray-500 mt-1">MP4, WebM, OGG or MOV. Compress large files; a YouTube or Vimeo link also works below.</p>
                @error('video')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                @if($homepageVideo->video_path)
                    <label class="mt-2 inline-flex items-center text-sm text-gray-700">
                        <input type="checkbox" name="remove_video" value="1" class="rounded border-gray-300 text-red-600 mr-2">
                        Remove uploaded video
                    </label>
                @endif
            </div>

            <div>
                <label for="video_url" class="block text-sm font-medium text-gray-700 mb-1">YouTube or Vimeo URL</label>
                <input type="text" id="video_url" name="video_url"
                       value="{{ old('video_url', $homepageVideo->video_url) }}"
                       placeholder="https://www.youtube.com/watch?v=..."
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <p class="text-xs text-gray-500 mt-1">Used when no video file is uploaded. Direct MP4 links are also supported.</p>
                @error('video_url')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="poster" class="block text-sm font-medium text-gray-700 mb-1">Poster image (optional)</label>
                @if($homepageVideo->poster_url)
                    <img src="{{ $homepageVideo->poster_url }}" alt="Video poster" class="w-40 h-24 object-cover rounded-lg border mb-2">
                @endif
                <input type="file" id="poster" name="poster" accept="image/*"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <p class="text-xs text-gray-500 mt-1">Shown before an uploaded video plays. JPEG, PNG or WebP up to 2MB.</p>
                @error('poster')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                @if($homepageVideo->poster_path)
                    <label class="mt-2 inline-flex items-center text-sm text-gray-700">
                        <input type="checkbox" name="remove_poster" value="1" class="rounded border-gray-300 text-red-600 mr-2">
                        Remove poster image
                    </label>
                @endif
            </div>

            <div class="flex justify-end">
                <button type="submit"
                        class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                    Save video
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
