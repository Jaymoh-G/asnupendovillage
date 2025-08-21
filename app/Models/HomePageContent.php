<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomePageContent extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'home_page_contents';
    use HasFactory;

    protected $fillable = [
        'section_name',
        'title',
        'subtitle',
        'description',
        'button_text',
        'button_url',
        'video_url',
        'image',
        'is_active',
        'sort_order',
        'meta_data', // JSON field for additional data like statistics, checklist items
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
        'meta_data' => 'array',
    ];

    protected $attributes = [
        'meta_data' => '{}',
    ];

    /**
     * Ensure meta_data is never null
     */
    public function setMetaDataAttribute($value)
    {
        $this->attributes['meta_data'] = $value ? json_encode($value) : '{}';
    }

    /**
     * Get content by section name
     */
    public static function getBySection(string $sectionName): ?self
    {
        return static::where('section_name', $sectionName)
            ->where('is_active', true)
            ->first();
    }

    /**
     * Get all active sections
     */
    public static function getActiveSections()
    {
        return static::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('section_name')
            ->get();
    }

    /**
     * Get the image URL
     */
    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image) {
            return null;
        }

        return asset('storage/' . $this->image);
    }

    /**
     * Get statistics from meta_data
     */
    public function getStatisticsAttribute(): array
    {
        return $this->meta_data['statistics'] ?? [];
    }

    /**
     * Get checklist items from meta_data
     */
    public function getChecklistItemsAttribute(): array
    {
        return $this->meta_data['checklist_items'] ?? [];
    }

    /**
     * Get story person name from meta_data
     */
    public function getStoryPersonNameAttribute(): ?string
    {
        return $this->meta_data['story_person_name'] ?? null;
    }

    /**
     * Get story person quote from meta_data
     */
    public function getStoryPersonQuoteAttribute(): ?string
    {
        return $this->meta_data['story_person_quote'] ?? null;
    }

    /**
     * Get story years of experience from meta_data
     */
    public function getStoryYearsExperienceAttribute(): ?int
    {
        return $this->meta_data['story_years_experience'] ?? 16;
    }

    /**
     * Get story person image from meta_data
     */
    public function getStoryPersonImageAttribute(): ?string
    {
        if (!isset($this->meta_data['story_person_image'])) {
            return null;
        }

        return asset('storage/' . $this->meta_data['story_person_image']);
    }

    /**
     * Scope for active sections
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
        return $query->orderBy('sort_order')->orderBy('section_name');
    }
}
