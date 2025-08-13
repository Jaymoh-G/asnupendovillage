<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'value',
        'suffix',
        'icon',
        'description',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
        'value' => 'integer',
    ];

    /**
     * Get active statistics ordered by sort order
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get ordered statistics
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('title');
    }

    /**
     * Get all active and ordered statistics
     */
    public static function getActiveOrdered()
    {
        return static::active()->ordered()->get();
    }

    /**
     * Get the display value with suffix
     */
    public function getDisplayValueAttribute(): string
    {
        return $this->value . ($this->suffix ?: '');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($statistic) {
            if (empty($statistic->sort_order)) {
                $statistic->sort_order = static::max('sort_order') + 1;
            }
        });
    }
}
