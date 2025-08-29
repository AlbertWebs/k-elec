<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'brand',
        'price',
        'old_price',
        'image',
        'images',
        'badge',
        'rating',
        'reviews_count',
        'stock_quantity',
        'is_featured',
        'is_active',
        'specifications'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'old_price' => 'decimal:2',
        'rating' => 'integer',
        'reviews_count' => 'integer',
        'stock_quantity' => 'integer',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'specifications' => 'array',
        'images' => 'array'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeInStock($query)
    {
        return $query->where('stock_quantity', '>', 0);
    }

    public function getFormattedPriceAttribute()
    {
        return 'KES ' . number_format($this->price, 2);
    }

    public function getFormattedOldPriceAttribute()
    {
        return $this->old_price ? 'KES ' . number_format($this->old_price, 2) : null;
    }

    public function getDiscountPercentageAttribute()
    {
        if ($this->old_price && $this->old_price > $this->price) {
            return round((($this->old_price - $this->price) / $this->old_price) * 100);
        }
        return 0;
    }

    public function getAllImagesAttribute()
    {
        $allImages = [];
        
        // Add main image first if it exists
        if ($this->image) {
            $allImages[] = $this->image;
        }
        
        // Add additional images
        $validImages = $this->getValidImages();
        if (!empty($validImages)) {
            $allImages = array_merge($allImages, $validImages);
        }
        
        return $allImages;
    }

    public function getAllImagesUrlsAttribute()
    {
        $allImages = [];
        
        // Add main image first if it exists
        if ($this->image) {
            $allImages[] = $this->main_image_url;
        }
        
        // Add additional images
        $validImages = $this->getValidImages();
        if (!empty($validImages)) {
            foreach ($validImages as $image) {
                $allImages[] = $this->getImageUrlAttribute($image);
            }
        }
        
        return $allImages;
    }

    public function getMainImageAttribute()
    {
        return $this->image ?? ($this->images[0] ?? 'https://via.placeholder.com/300x200/cccccc/ffffff?text=Product');
    }

    public function getMainImageUrlAttribute()
    {
        if (!$this->image) {
            return 'https://via.placeholder.com/300x200/cccccc/ffffff?text=Product';
        }
        
        // Check if the image path starts with a slash (public assets)
        if (str_starts_with($this->image, '/')) {
            return $this->image; // Return as-is for public assets
        }
        
        // For storage images, use asset helper
        return asset('storage/' . $this->image);
    }

    public function getImageUrlAttribute($imagePath)
    {
        if (!$imagePath) {
            return 'https://via.placeholder.com/300x200/cccccc/ffffff?text=Product';
        }
        
        // Check if the image path starts with a slash (public assets)
        if (str_starts_with($imagePath, '/')) {
            return $imagePath; // Return as-is for public assets
        }
        
        // For storage images, use asset helper
        return asset('storage/' . $imagePath);
    }

    public function getImagesUrlsAttribute()
    {
        if (!$this->images || !is_array($this->images)) {
            return [];
        }
        
        return array_map(function($image) {
            return $this->getImageUrlAttribute($image);
        }, $this->getValidImages());
    }

    public function getValidImages()
    {
        if (!$this->images || !is_array($this->images)) {
            return [];
        }
        
        // Filter out empty arrays, null values, and non-string values
        return array_filter($this->images, function($image) {
            return is_string($image) && !empty(trim($image));
        });
    }
}
