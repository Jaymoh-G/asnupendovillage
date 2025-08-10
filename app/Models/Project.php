<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\HasImages;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasImages;

    protected $fillable = [
        'name',
        'slug',
        'content',
        'meta_description',
        'program_id',
        'status',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($project) {
            if (empty($project->slug)) {
                $project->slug = Str::slug($project->name);
            }
        });

        static::updating(function ($project) {
            if ($project->isDirty('name') && empty($project->slug)) {
                $project->slug = Str::slug($project->name);
            }
        });
    }

    /**
     * Scope to get active projects
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope to get latest projects
     */
    public function scopeLatestProjects($query, $limit = 3)
    {
        return $query->orderBy('created_at', 'desc')->limit($limit);
    }

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
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
}
