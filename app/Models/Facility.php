<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\HasImages;
use Illuminate\Support\Str;

class Facility extends Model
{
    use HasImages;

    protected $fillable = [
        'name',
        'description',
        'program_id',
        'image',
        'status',
        'capacity',
        'slug',
    ];

    protected $casts = [
        'status' => 'string',
    ];

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    public function getImageUrlAttribute(): ?string
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return null;
    }

    public function getFeaturedImageUrlAttribute(): ?string
    {
        return $this->getImageUrlAttribute();
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('name');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($facility) {
            if (empty($facility->slug)) {
                $facility->slug = Str::slug($facility->name);
            }
        });

        static::updating(function ($facility) {
            if ($facility->isDirty('name') && empty($facility->slug)) {
                $facility->slug = Str::slug($facility->name);
            }
        });
    }
}
