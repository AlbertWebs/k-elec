<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogSetting extends Model
{
    protected $fillable = [
        'show_sidebar',
        'show_recent_posts',
        'show_categories',
        'recent_posts_count',
    ];

    protected $casts = [
        'show_sidebar' => 'boolean',
        'show_recent_posts' => 'boolean',
        'show_categories' => 'boolean',
    ];

    public static function getSetting($key, $default = null)
    {
        $settings = self::first();
        if (!$settings) {
            return $default;
        }
        return $settings->$key ?? $default;
    }
}
