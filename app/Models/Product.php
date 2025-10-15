<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'product_code',
        'description',
        'short_description',
        'tags',
        'additional_info',
        'price',
        'sales_price',
        'stock',
        'status',
        'category_id',
        'main_image',
        'gallery_images'
    ];

    protected $casts = [
        'gallery_images' => 'array',
        'additional_info' => 'array',
        'price' => 'decimal:2',
        'sales_price' => 'decimal:2'
    ];

    protected $appends = [
        'main_image_url',
        'gallery_image_urls',
        'final_price',
        'discount_percentage',
        'stock_status'
    ];

    // Auto-generate slug when creating/updating
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = static::generateUniqueSlug($product->name);
            }
        });
        
        static::updating(function ($product) {
            if ($product->isDirty('name') && empty($product->slug)) {
                $product->slug = static::generateUniqueSlug($product->name);
            }
        });
    }

    // Generate unique slug
    public static function generateUniqueSlug($name)
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $counter = 1;

        while (static::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    // Relationship with category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Helper methods (keep all existing methods)
    public function isInStock()
    {
        return $this->stock > 0;
    }

    public function isLowStock($threshold = 10)
    {
        return $this->stock > 0 && $this->stock <= $threshold;
    }

    public function getStockStatusAttribute()
    {
        if ($this->stock === 0) {
            return 'out-of-stock';
        } elseif ($this->stock <= 10) {
            return 'low-stock';
        } else {
            return 'in-stock';
        }
    }

    public function getMainImageUrlAttribute()
    {
        return $this->main_image ? asset('storage/' . $this->main_image) : null;
    }

    public function getGalleryImageUrlsAttribute()
    {
        if (!$this->gallery_images) {
            return [];
        }

        return array_map(function($image) {
            return asset('storage/' . $image);
        }, $this->gallery_images);
    }

    public function hasDiscount()
    {
        return $this->sales_price && $this->sales_price < $this->price;
    }

    public function getDiscountPercentageAttribute()
    {
        if (!$this->hasDiscount()) {
            return 0;
        }

        return round((($this->price - $this->sales_price) / $this->price) * 100);
    }

    public function getDiscountAmountAttribute()
    {
        if (!$this->hasDiscount()) {
            return 0;
        }

        return $this->price - $this->sales_price;
    }

    public function getFinalPriceAttribute()
    {
        return $this->hasDiscount() ? $this->sales_price : $this->price;
    }

    public function getTagsArrayAttribute()
    {
        return $this->tags ? explode(',', $this->tags) : [];
    }

    public function getFormattedTagsAttribute()
    {
        return $this->tags ? str_replace(',', ', ', $this->tags) : '';
    }
}