<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomepageVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomepageVideoController extends Controller
{
    public function edit()
    {
        $homepageVideo = HomepageVideo::current();

        return view('admin.homepage-video.edit', compact('homepageVideo'));
    }

    public function update(Request $request)
    {
        $homepageVideo = HomepageVideo::current();

        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'video_url' => 'nullable|string|max:500',
            'video' => 'nullable|file|mimes:mp4,webm,ogg,mov|max:51200',
            'poster' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = [
            'title' => $validated['title'] ?: HomepageVideo::DEFAULT_TITLE,
            'description' => $validated['description'] ?: HomepageVideo::DEFAULT_DESCRIPTION,
            'video_url' => $this->normalizeUrl($validated['video_url'] ?? null) ?: HomepageVideo::DEFAULT_VIDEO_URL,
        ];

        if ($request->boolean('remove_video') && $homepageVideo->video_path) {
            Storage::disk('public')->delete($homepageVideo->video_path);
            $data['video_path'] = null;
        }

        if ($request->boolean('remove_poster') && $homepageVideo->poster_path) {
            Storage::disk('public')->delete($homepageVideo->poster_path);
            $data['poster_path'] = null;
        }

        if ($request->hasFile('video')) {
            if ($homepageVideo->video_path) {
                Storage::disk('public')->delete($homepageVideo->video_path);
            }

            $data['video_path'] = $request->file('video')->store('homepage-videos', 'public');
        }

        if ($request->hasFile('poster')) {
            if ($homepageVideo->poster_path) {
                Storage::disk('public')->delete($homepageVideo->poster_path);
            }

            $data['poster_path'] = $request->file('poster')->store('homepage-videos', 'public');
        }

        $homepageVideo->update($data);

        return redirect()
            ->route('admin.homepage-video.edit')
            ->with('success', 'Homepage video updated successfully.');
    }

    public function toggle()
    {
        $homepageVideo = HomepageVideo::current();
        $homepageVideo->update(['is_active' => !$homepageVideo->is_active]);

        $status = $homepageVideo->is_active ? 'visible' : 'hidden';

        return redirect()
            ->route('admin.homepage-video.edit')
            ->with('success', "Homepage video section is now {$status}.");
    }

    private function normalizeUrl(?string $url): ?string
    {
        $url = trim((string) $url);

        if ($url === '') {
            return null;
        }

        if (!preg_match('/^https?:\/\//i', $url)) {
            $url = 'https://' . $url;
        }

        return $url;
    }
}
