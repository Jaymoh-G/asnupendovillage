<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use App\Traits\HasImages;

class News extends Model
{
    use HasImages;

    protected $fillable = [
        'title',
        'content',
        'excerpt',
        'slug',
        'featured_image',
        'category',
        'author',
        'status',
        'published_at',
        'views_count',
        'meta_title',
        'meta_description',
        'tags',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'views_count' => 'integer',
        'tags' => 'array',
    ];

    protected static function booted()
    {
        static::creating(function ($news) {
            if (empty($news->slug)) {
                $news->slug = Str::slug($news->title);
            }
        });

        static::updating(function ($news) {
            if ($news->isDirty('title') && empty($news->slug)) {
                $news->slug = Str::slug($news->title);
            }
        });
    }

    /**
     * Get the featured image URL for display
     */
    public function getFeaturedImageUrlAttribute()
    {
        try {
            // First try to get the featured image
            $featuredImage = $this->featuredImage;
            if ($featuredImage) {
                return asset('storage/' . $featuredImage->path);
            }

            // If no featured image, get the first image
            $firstImage = $this->images()->first();
            if ($firstImage) {
                return asset('storage/' . $firstImage->path);
            }
        } catch (\Exception $e) {
            // Log error but don't break the page
            Log::error('Error getting featured image for news ' . $this->id . ': ' . $e->getMessage());
        }

        // Return null if no images exist - Filament will use the default image
        return null;
    }
}
