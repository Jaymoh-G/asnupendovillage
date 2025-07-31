<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Career extends Model
{
    protected $fillable = [
        'title',
        'description',
        'location',
        'type',
        'status',
        'application_deadline',
        'contact_email',
        'slug',
    ];

    protected static function boot()
    {
        parent::boot();
        static::saving(function ($career) {
            if (empty($career->slug) || $career->isDirty('title')) {
                $career->slug = Str::slug($career->title);
            }
        });
    }

    /**
     * Scope to get active careers
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'open');
    }
}
