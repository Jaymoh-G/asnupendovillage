<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CoreValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'icon',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Get active core values ordered by sort order
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get ordered core values
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('title');
    }

    /**
     * Get all active and ordered core values
     */
    public static function getActiveOrdered()
    {
        return static::active()->ordered()->get();
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($coreValue) {
            if (empty($coreValue->sort_order)) {
                $coreValue->sort_order = static::max('sort_order') + 1;
            }
        });
    }
}
