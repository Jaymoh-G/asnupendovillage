<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\HasImages;
use Illuminate\Support\Str;

class Facility extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'facilities';
    use HasImages;

    protected $fillable = [
        'name',
        'slug',
        'content',
        'meta_description',
    ];





    /**
     * Get the image URL for display (fallback to HasImages trait)
     */
    public function getImageUrlAttribute(): ?string
    {
        // First try to get image from HasImages trait
        $featuredImageUrl = $this->featured_image_url;
        if ($featuredImageUrl) {
            return $featuredImageUrl;
        }

        // Fallback to the old image field
        if ($this->image) {
            return asset('storage/' . $this->image);
        }

        return null;
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('name');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($facility) {
            if (empty($facility->slug)) {
                $facility->slug = Str::slug($facility->name);
            }
        });

        static::updating(function ($facility) {
            if ($facility->isDirty('name') && empty($facility->slug)) {
                $facility->slug = Str::slug($facility->name);
            }
        });
    }
}
