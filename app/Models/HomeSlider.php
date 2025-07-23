<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Traits\HasImages;

class HomeSlider extends Model
{
    use HasFactory, HasImages;

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
     * Get the featured image URL for display
     */
    public function getFeaturedImageUrlAttribute()
    {
        $featuredImage = $this->featuredImage;
        return $featuredImage ? asset('storage/' . $featuredImage->path) : null;
    }

    /**
     * Get the thumbnail URL for display
     */
    public function getThumbnailUrlAttribute()
    {
        $featuredImage = $this->featuredImage;
        return $featuredImage ? asset('storage/' . $featuredImage->path) : null;
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
        return static::active()->featured()->ordered()->get();
    }

    /**
     * Process existing images selection and create image records
     */
    public function processExistingImages($existingImagePaths)
    {
        if (!is_array($existingImagePaths) || empty($existingImagePaths)) {
            return;
        }

        foreach ($existingImagePaths as $imagePath) {
            // Check if image already exists for this slider
            $existingImage = $this->images()->where('path', $imagePath)->first();

            if (!$existingImage) {
                // Create a new image record for this slider
                $this->images()->create([
                    'filename' => basename($imagePath),
                    'original_name' => basename($imagePath),
                    'path' => $imagePath,
                    'mime_type' => $this->getMimeType(pathinfo($imagePath, PATHINFO_EXTENSION)),
                    'size' => Storage::disk('public')->size($imagePath),
                    'alt_text' => pathinfo($imagePath, PATHINFO_FILENAME),
                    'sort_order' => $this->images()->count(),
                ]);
            }
        }
    }

    /**
     * Get MIME type from file extension
     */
    protected function getMimeType($extension)
    {
        $mimeTypes = [
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            'webp' => 'image/webp',
        ];

        return $mimeTypes[strtolower($extension)] ?? 'application/octet-stream';
    }
}
