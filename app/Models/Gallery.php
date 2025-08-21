<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Gallery extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'galleries';
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'slug',
        'cover_image',
        'status',
        'sort_order',
    ];

    protected $casts = [
        'status' => 'string',
        'sort_order' => 'integer',
    ];

    /**
     * Boot method to automatically generate slug
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($gallery) {
            if (empty($gallery->slug)) {
                $gallery->slug = Str::slug($gallery->name);
            }
        });

        static::updating(function ($gallery) {
            if ($gallery->isDirty('name') && empty($gallery->slug)) {
                $gallery->slug = Str::slug($gallery->name);
            }
        });
    }

    /**
     * Get all albums in the gallery
     */
    public function albums()
    {
        return $this->hasMany(Album::class)->orderBy('sort_order');
    }

    /**
     * Get active albums
     */
    public function activeAlbums()
    {
        return $this->albums()->active();
    }

    /**
     * Get the total number of images in the gallery
     */
    public function getTotalImagesCountAttribute(): int
    {
        return Image::whereHas('imageable', function ($query) {
            $query->whereHas('gallery');
        })->orWhere('imageable_type', Gallery::class)
            ->where('imageable_id', $this->id)
            ->count();
    }

    /**
     * Get or create the main gallery instance
     */
    public static function getMainGallery()
    {
        return static::firstOrCreate(
            ['id' => 1],
            [
                'name' => 'Main Gallery',
                'description' => 'The main gallery containing all albums and images',
                'slug' => 'main-gallery',
                'status' => 'active',
                'sort_order' => 0,
            ]
        );
    }
}
