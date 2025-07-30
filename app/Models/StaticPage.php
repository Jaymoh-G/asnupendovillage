<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaticPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_name',
        'title',
        'content',
        'excerpt',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'featured_image',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Get the page by its name
     */
    public static function getByPageName(string $pageName): ?self
    {
        return static::where('page_name', $pageName)
            ->where('is_active', true)
            ->first();
    }

    /**
     * Get all active pages
     */
    public static function getActivePages()
    {
        return static::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('title')
            ->get();
    }

    /**
     * Get the effective title (custom title or default)
     */
    public function getEffectiveTitleAttribute(): string
    {
        return $this->title ?: ucfirst(str_replace('-', ' ', $this->page_name));
    }

    /**
     * Get the effective meta title
     */
    public function getEffectiveMetaTitleAttribute(): string
    {
        return $this->meta_title ?: $this->getEffectiveTitleAttribute();
    }

    /**
     * Get the featured image URL
     */
    public function getFeaturedImageUrlAttribute(): ?string
    {
        if (!$this->featured_image) {
            return null;
        }

        return asset('storage/' . $this->featured_image);
    }

    /**
     * Scope for active pages
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for ordering
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('title');
    }
}
