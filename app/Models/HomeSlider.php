<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class HomeSlider extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'button_text',
        'button_url',
        'status',
        'sort_order',
        'is_featured',
        'meta_title',
        'meta_description',
        'image', // Add simple image field like facilities
    ];

    protected $casts = [
        'status' => 'string',
        'sort_order' => 'integer',
        'is_featured' => 'boolean',
    ];

    /**
     * Boot method to automatically generate slug
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($slider) {
            if (empty($slider->slug)) {
                $slider->slug = Str::slug($slider->title);
            }
        });

        static::updating(function ($slider) {
            if ($slider->isDirty('title') && empty($slider->slug)) {
                $slider->slug = Str::slug($slider->title);
            }
        });
    }

    /**
     * Scope to get active sliders
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope to get featured sliders
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope to get sliders ordered by sort order
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('created_at', 'desc');
    }

    /**
     * Get the image URL for display (like facilities)
     */
    public function getImageUrlAttribute(): ?string
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return null;
    }

    /**
     * Get the featured image URL for display
     */
    public function getFeaturedImageUrlAttribute()
    {
        return $this->getImageUrlAttribute() ?: asset('assets/img/hero/hero_bg_1_1.jpg');
    }

    /**
     * Get the thumbnail URL for display
     */
    public function getThumbnailUrlAttribute()
    {
        return $this->getFeaturedImageUrlAttribute();
    }

    /**
     * Get active sliders for frontend display
     */
    public static function getActiveSliders()
    {
        return static::active()->ordered()->get();
    }

    /**
     * Get featured sliders for frontend display
     */
    public static function getFeaturedSliders()
    {
        return static::featured()->ordered()->get();
    }
}
