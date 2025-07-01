<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Str;
use App\Traits\HasImages;

class Event extends Model
{
    use HasFactory, HasImages;

    protected $fillable = [
        'title',
        'description',
        'excerpt',
        'slug',
        'location',
        'organizer',
        'contact_email',
        'contact_phone',
        'status',
        'type',
        'start_date',
        'end_date',
        'is_featured',
        'tags',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'is_featured' => 'boolean',
        'tags' => 'array',
    ];

    /**
     * Boot method to automatically generate slug
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($event) {
            if (empty($event->slug)) {
                $event->slug = Str::slug($event->title);
            }
        });

        static::updating(function ($event) {
            if ($event->isDirty('title') && empty($event->slug)) {
                $event->slug = Str::slug($event->title);
            }
        });
    }

    /**
     * Scope to get published events
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /**
     * Scope to get featured events
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope to get upcoming events
     */
    public function scopeUpcoming($query)
    {
        return $query->where('start_date', '>', now());
    }

    /**
     * Scope to get past events
     */
    public function scopePast($query)
    {
        return $query->where('end_date', '<', now());
    }

    /**
     * Check if registration is still open
     */
    public function isRegistrationOpen(): bool
    {
        return $this->start_date > now();
    }

    /**
     * Get the route key for the model
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
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
            \Illuminate\Support\Facades\Log::error('Error getting featured image for event ' . $this->id . ': ' . $e->getMessage());
        }

        // Return null if no images exist - Filament will show broken image icon
        return null;
    }
}
