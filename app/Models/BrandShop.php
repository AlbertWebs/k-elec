<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class BrandShop extends Model
{
    protected $fillable = [
        'name',
        'location',
        'city',
        'area',
        'image',
        'phone',
        'timings',
        'directions_url',
        'is_active',
        'order'
    ];

    protected $casts = [
        'timings' => 'array',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc')->orderBy('created_at', 'desc');
    }

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return Storage::url($this->image);
        }
        return asset('images/placeholder.png');
    }
}
