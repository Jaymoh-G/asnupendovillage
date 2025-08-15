<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Traits\HasImages;

class Program extends Model
{
    use HasImages;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'meta_title',
        'meta_description',
        'featured',
        'sort_order',
    ];

    protected $casts = [
        'featured' => 'boolean',
        'sort_order' => 'integer',
    ];

    protected static function booted()
    {
        static::creating(function ($program) {
            if (empty($program->slug)) {
                $program->slug = Str::slug($program->title);
            }
        });
        static::updating(function ($program) {
            if ($program->isDirty('title') && empty($program->slug)) {
                $program->slug = Str::slug($program->title);
            }
        });
    }

    public function getImageUrlAttribute()
    {
        // First try to get image from HasImages trait
        $featuredImageUrl = $this->featured_image_url;
        if ($featuredImageUrl) {
            return $featuredImageUrl;
        }

        // Fallback to the old method
        $image = $this->images()->first();
        return $image ? asset('storage/' . $image->path) : null;
    }

    /**
     * Scope to get latest featured programs
     */
    public function scopeLatestFeatured($query, $limit = 6)
    {
        return $query->where('featured', true)
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->limit($limit);
    }

    /**
     * Scope to get programs ordered by sort order
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('title');
    }

    /**
     * Scope to get active programs
     */
    public function scopeActive($query)
    {
        return $query->where('featured', true);
    }

    /**
     * Scope to get all programs in order
     */
    public function scopeAllOrdered($query)
    {
        return $query->ordered();
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class);
    }

    public function facilities()
    {
        return $this->hasMany(Facility::class);
    }

    public function downloads()
    {
        return $this->hasMany(Download::class);
    }
}
