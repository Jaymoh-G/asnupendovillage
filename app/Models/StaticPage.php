<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaticPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_name',
        'title',
        'content',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'featured_image',
        'images',
        'section1_title',
        'section1_content',
        'section1_images',
        'section2_title',
        'section2_content',
        'section2_images',
        'section3_title',
        'section3_content',
        'section3_images',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
        'images' => 'array',
        'section1_images' => 'array',
        'section2_images' => 'array',
        'section3_images' => 'array',
    ];

    /**
     * Get the page by its name
     */
    public static function getByPageName(string $pageName): ?self
    {
        return static::where('page_name', $pageName)
            ->where('is_active', true)
            ->first();
    }

    /**
     * Get all active pages
     */
    public static function getActivePages()
    {
        return static::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('title')
            ->get();
    }

    /**
     * Get the effective title (custom title or default)
     */
    public function getEffectiveTitleAttribute(): string
    {
        return $this->title ?: ucfirst(str_replace('-', ' ', $this->page_name));
    }

    /**
     * Get the effective meta title
     */
    public function getEffectiveMetaTitleAttribute(): string
    {
        return $this->meta_title ?: $this->getEffectiveTitleAttribute();
    }

    /**
     * Get the featured image URL
     */
    public function getFeaturedImageUrlAttribute(): ?string
    {
        if (!$this->featured_image) {
            return null;
        }

        return asset('storage/' . $this->featured_image);
    }

    /**
     * Get all image URLs
     */
    public function getImageUrlsAttribute(): array
    {
        if (!$this->images || !is_array($this->images)) {
            return [];
        }

        return array_map(function ($image) {
            return asset('storage/' . $image);
        }, $this->images);
    }

    /**
     * Get the first image URL (for fallback)
     */
    public function getFirstImageUrlAttribute(): ?string
    {
        $imageUrls = $this->image_urls;
        return !empty($imageUrls) ? $imageUrls[0] : null;
    }

    /**
     * Check if the page has multiple images
     */
    public function hasMultipleImages(): bool
    {
        return $this->images && is_array($this->images) && count($this->images) > 1;
    }

    /**
     * Get the count of images
     */
    public function getImageCountAttribute(): int
    {
        return $this->images && is_array($this->images) ? count($this->images) : 0;
    }

    /**
     * Get section 1 image URLs
     */
    public function getSection1ImageUrlsAttribute(): array
    {
        if (!$this->section1_images || !is_array($this->section1_images)) {
            return [];
        }

        return array_map(function ($image) {
            return asset('storage/' . $image);
        }, $this->section1_images);
    }

    /**
     * Get section 2 image URLs
     */
    public function getSection2ImageUrlsAttribute(): array
    {
        if (!$this->section2_images || !is_array($this->section2_images)) {
            return [];
        }

        return array_map(function ($image) {
            return asset('storage/' . $image);
        }, $this->section2_images);
    }

    /**
     * Get section 3 image URLs
     */
    public function getSection3ImageUrlsAttribute(): array
    {
        if (!$this->section3_images || !is_array($this->section3_images)) {
            return [];
        }

        return array_map(function ($image) {
            return asset('storage/' . $image);
        }, $this->section3_images);
    }

    /**
     * Check if section 1 has images
     */
    public function hasSection1Images(): bool
    {
        return $this->section1_images && is_array($this->section1_images) && count($this->section1_images) > 0;
    }

    /**
     * Check if section 2 has images
     */
    public function hasSection2Images(): bool
    {
        return $this->section2_images && is_array($this->section2_images) && count($this->section2_images) > 0;
    }

    /**
     * Check if section 3 has images
     */
    public function hasSection3Images(): bool
    {
        return $this->section3_images && is_array($this->section3_images) && count($this->section3_images) > 0;
    }

    /**
     * Scope for active pages
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for ordering
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('title');
    }
}
