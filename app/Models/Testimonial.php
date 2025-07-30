<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\HasImages;

class Testimonial extends Model
{
    use HasImages;

    protected $fillable = [
        'name',
        'program_id',
        'content',
        'image',
        'is_featured',
        'sort_order',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Get the program this testimonial belongs to
     */
    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    /**
     * Scope to get featured testimonials
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope to get latest testimonials
     */
    public function scopeLatestTestimonials($query, $limit = 4)
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
}
