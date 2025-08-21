<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Career extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'careers';
    protected $fillable = [
        'title',
        'description',
        'content',
        'pdf_file',
        'type',
        'status',
        'application_deadline',
        'contact_email',
        'slug',
    ];

    protected $casts = [
        'application_deadline' => 'date',
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

    /**
     * Get the PDF file URL
     */
    public function getPdfUrlAttribute(): ?string
    {
        if ($this->pdf_file) {
            return asset('storage/' . $this->pdf_file);
        }
        return null;
    }
}
