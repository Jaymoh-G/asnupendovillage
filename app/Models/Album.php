<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Str;
use App\Traits\HasImages;

class Album extends Model
{
    use HasFactory, HasImages;

    protected $fillable = [
        'name',
        'description',
        'cover_image',
        'slug',
        'status',
    ];

    protected $casts = [
        'status' => 'string',
    ];

    /**
     * Boot method to automatically generate slug
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($album) {
            if (empty($album->slug)) {
                $album->slug = Str::slug($album->name);
            }
        });

        static::updating(function ($album) {
            if ($album->isDirty('name') && empty($album->slug)) {
                $album->slug = Str::slug($album->name);
            }
        });
    }

    /**
     * Get the cover image
     */
    public function coverImage()
    {
        return $this->hasOne(Image::class, 'id', 'cover_image');
    }

    /**
     * Get the cover image URL
     */
    public function getCoverImageUrlAttribute(): ?string
    {
        if ($this->cover_image && $this->coverImage) {
            return $this->coverImage->url;
        }
        return null;
    }

    /**
     * Scope to get active albums
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Get the route key for the model
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
