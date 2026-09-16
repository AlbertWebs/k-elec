<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class HomepageVideo extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'video_path',
        'video_url',
        'poster_path',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public const DEFAULT_VIDEO_URL = 'https://drive.google.com/file/d/1goNHL_j4Rt-IMOn59-_CQLVSPMOUk9hZ/preview';

    public static function current(): self
    {
        return static::query()->firstOrCreate([], [
            'is_active' => true,
            'title' => 'ABOUT K-ELEC',
            'video_url' => self::DEFAULT_VIDEO_URL,
        ]);
    }

    public function hasMedia(): bool
    {
        return filled($this->video_path) || filled($this->video_url);
    }

    public function isVisible(): bool
    {
        return $this->is_active && $this->hasMedia();
    }

    public function usesUploadedFile(): bool
    {
        return filled($this->video_path);
    }

    public function usesRemoteFile(): bool
    {
        return !$this->usesUploadedFile()
            && filled($this->video_url)
            && (bool) preg_match('/\.(mp4|webm|ogg|mov)(\?|$)/i', $this->video_url);
    }

    public function usesEmbed(): bool
    {
        return !$this->usesUploadedFile() && !$this->usesRemoteFile() && filled($this->embed_url);
    }

    public function getFileUrlAttribute(): ?string
    {
        if ($this->usesUploadedFile()) {
            return Storage::disk('public')->url($this->video_path);
        }

        if ($this->usesRemoteFile()) {
            return $this->video_url;
        }

        return null;
    }

    public function getPosterUrlAttribute(): ?string
    {
        if (!$this->poster_path) {
            return null;
        }

        return Storage::disk('public')->url($this->poster_path);
    }

    public function getEmbedUrlAttribute(): ?string
    {
        $url = trim((string) $this->video_url);

        if ($url === '') {
            return null;
        }

        if (preg_match('/(?:youtube\.com\/(?:watch\?(?:.*&)?v=|embed\/|shorts\/)|youtu\.be\/)([A-Za-z0-9_-]{11})/', $url, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[1] . '?rel=0';
        }

        if (preg_match('/vimeo\.com\/(?:video\/)?(\d+)/', $url, $matches)) {
            return 'https://player.vimeo.com/video/' . $matches[1];
        }

        if (preg_match('/drive\.google\.com\/file\/d\/([a-zA-Z0-9_-]+)/', $url, $matches)) {
            return 'https://drive.google.com/file/d/' . $matches[1] . '/preview';
        }

        if (preg_match('/drive\.google\.com\/open\?id=([a-zA-Z0-9_-]+)/', $url, $matches)) {
            return 'https://drive.google.com/file/d/' . $matches[1] . '/preview';
        }

        return $url;
    }
}
