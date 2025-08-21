<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Str;
use App\Traits\HasImages;

class Album extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'albums';
    use HasFactory, HasImages;

    protected $fillable = [
        'name',
        'description',
        'cover_image',
        'slug',
        'status',
        'gallery_id',
        'sort_order',
    ];

    protected $casts = [
        'status' => 'string',
        'sort_order' => 'integer',
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
     * Get the gallery this album belongs to
     */
    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }

    /**
     * Get the cover image
     */
    public function coverImage()
    {
        return $this->hasOne(Image::class, 'id', 'cover_image');
    }

    /**
     * Get the cover image URL for display
     */
    public function getCoverImageUrlAttribute(): ?string
    {
        try {
            // If cover_image field has a value, return the asset URL
            if ($this->cover_image) {
                return asset('storage/' . $this->cover_image);
            }

            // If no cover image, get the first image from the album
            $firstImage = $this->images()->first();
            if ($firstImage) {
                return asset('storage/' . $firstImage->path);
            }
        } catch (\Exception $e) {
            // Log error but don't break the page
            \Illuminate\Support\Facades\Log::error('Error getting cover image for album ' . $this->id . ': ' . $e->getMessage());
        }

        // Return null if no images exist - Filament will use the default image
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
     * Scope to order by sort order
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    /**
     * Get the route key for the model
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
