<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasImages;
use Illuminate\Support\Str;

class Team extends Model
{
    use HasImages;

    protected $fillable = [
        'name',
        'slug',
        'position',
        'bio',
        'email',
        'phone',
        'image',
        'facebook',
        'twitter',
        'linkedin',
        'instagram',
        'is_featured',
        'sort_order',
        'status',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'sort_order' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($team) {
            if (empty($team->slug)) {
                $team->slug = Str::slug($team->name);
            }
        });

        static::updating(function ($team) {
            if ($team->isDirty('name') && empty($team->slug)) {
                $team->slug = Str::slug($team->name);
            }
        });
    }

    /**
     * Scope to get active team members
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope to get featured team members
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope to get latest team members
     */
    public function scopeLatestTeamMembers($query, $limit = 6)
    {
        return $query->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->limit($limit);
    }

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

    public function programs()
    {
        return $this->belongsToMany(Program::class);
    }
}
