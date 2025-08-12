<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\HasImages;
use Illuminate\Support\Str;

class Testimonial extends Model
{
    use HasImages;

    protected $fillable = [
        'name',
        'slug',
        'program_id',
        'content',
        'image',
        'pdf_file',
        'is_featured',
        'sort_order',
        'tags',
    ];

    protected $casts = [
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

        static::creating(function ($testimonial) {
            if (empty($testimonial->slug)) {
                $testimonial->slug = Str::slug($testimonial->name);
            }
        });

        static::updating(function ($testimonial) {
            if ($testimonial->isDirty('name') && empty($testimonial->slug)) {
                $testimonial->slug = Str::slug($testimonial->name);
            }
        });
    }

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

    /**
     * Get the PDF URL for download
     */
    public function getPdfUrlAttribute(): ?string
    {
        if ($this->pdf_file) {
            return asset('storage/' . $this->pdf_file);
        }
        return null;
    }
}
