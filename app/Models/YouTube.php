<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class YouTube extends Model
{
    use HasFactory;

    protected $table = 'youtube_videos';

    protected $fillable = [
        'title',
        'slug',
        'description',
        'video_id',
        'thumbnail',
        'duration',
        'published_at',
        'is_featured',
        'sort_order',
        'tags',
        'status',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_featured' => 'boolean',
        'sort_order' => 'integer',
        'tags' => 'array',
    ];

    /**
     * Boot method to automatically generate slug
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($youtube) {
            if (empty($youtube->slug)) {
                $youtube->slug = Str::slug($youtube->title);
            }
        });

        static::updating(function ($youtube) {
            if ($youtube->isDirty('title') && empty($youtube->slug)) {
                $youtube->slug = Str::slug($youtube->title);
            }
        });
    }

    /**
     * Get the video URL
     */
    public function getVideoUrlAttribute(): string
    {
        return "https://www.youtube.com/watch?v={$this->video_id}";
    }

    /**
     * Get the embed URL
     */
    public function getEmbedUrlAttribute(): string
    {
        return "https://www.youtube.com/embed/{$this->video_id}";
    }

    /**
     * Get the thumbnail URL
     */
    public function getThumbnailUrlAttribute(): string
    {
        if ($this->thumbnail) {
            return asset('storage/' . $this->thumbnail);
        }
        
        // Fallback to YouTube's default thumbnail
        return "https://img.youtube.com/vi/{$this->video_id}/maxresdefault.jpg";
    }

    /**
     * Scope to get featured videos
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope to get active videos
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope to get ordered videos
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('published_at', 'desc');
    }

    /**
     * Get all active and ordered videos
     */
    public static function getActiveOrdered()
    {
        return static::active()->ordered()->get();
    }

    /**
     * Get featured videos
     */
    public static function getFeatured($limit = 6)
    {
        return static::featured()->active()->ordered()->limit($limit)->get();
    }
}
