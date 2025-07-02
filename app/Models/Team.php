<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasImages;

class Team extends Model
{
    use HasImages;

    protected $fillable = [
        'name',
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
     * Get the image URL
     */
    public function getImageUrlAttribute(): ?string
    {
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
