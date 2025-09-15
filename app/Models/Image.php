<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Image extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'images';
    use HasFactory;

    protected $fillable = [
        'filename',
        'original_name',
        'path',
        'mime_type',
        'size',
        'alt_text',
        'caption',
        'featured',
        'sort_order',
        'imageable_type',
        'imageable_id',
    ];

    protected $casts = [
        'featured' => 'boolean',
        'size' => 'integer',
        'sort_order' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Image $image) {
            if (empty($image->caption)) {
                $image->caption = pathinfo($image->original_name ?? $image->filename, PATHINFO_FILENAME);
            }
            if (empty($image->alt_text)) {
                $image->alt_text = pathinfo($image->original_name ?? $image->filename, PATHINFO_FILENAME);
            }
        });

        static::updating(function (Image $image) {
            if (is_null($image->caption) || $image->caption === '') {
                $image->caption = pathinfo($image->original_name ?? $image->filename, PATHINFO_FILENAME);
            }
        });
    }

    /**
     * Validation rules
     */
    public static function rules()
    {
        return [
            'filename' => 'required|string|max:255',
            'original_name' => 'required|string|max:255',
            'path' => 'required|string|max:255',
            'mime_type' => 'required|string|max:255',
            'size' => 'required|integer|min:0',
            'alt_text' => 'nullable|string|max:255',
            'caption' => 'nullable|string',
            'featured' => 'boolean',
            'sort_order' => 'integer|min:0',
            'imageable_type' => 'required|string|max:255',
            'imageable_id' => 'required|integer|min:1',
        ];
    }

    /**
     * Get the parent imageable model.
     */
    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get the full URL for the image
     */
    public function getUrlAttribute(): string
    {
        return asset('storage/' . $this->path);
    }

    /**
     * Get the relative path for the image (without domain)
     */
    public function getRelativePathAttribute(): string
    {
        return 'storage/' . $this->path;
    }

    /**
     * Get the URL without domain (for use in production)
     */
    public function getUrlWithoutDomainAttribute(): string
    {
        return '/storage/' . $this->path;
    }

    /**
     * Get the display URL (full URL for Filament)
     */
    public function getDisplayUrlAttribute(): string
    {
        // Use full URL for Filament ImageColumn
        return asset('storage/' . $this->path);
    }

    /**
     * Get the thumbnail URL for the image
     */
    public function getThumbnailUrlAttribute(): string
    {
        $pathInfo = pathinfo($this->path);
        $thumbnailPath = $pathInfo['dirname'] . '/thumbnails/' . $pathInfo['basename'];
        return asset('storage/' . $thumbnailPath);
    }

    /**
     * Get the thumbnail relative path for the image (without domain)
     */
    public function getThumbnailRelativePathAttribute(): string
    {
        $pathInfo = pathinfo($this->path);
        $thumbnailPath = $pathInfo['dirname'] . '/thumbnails/' . $pathInfo['basename'];
        return 'storage/' . $thumbnailPath;
    }

    /**
     * Scope to get featured images
     */
    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    /**
     * Scope to order by sort order
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('created_at');
    }

    /**
     * Get file size in human readable format
     */
    public function getFormattedSizeAttribute(): string
    {
        $bytes = $this->size;
        $units = ['B', 'KB', 'MB', 'GB'];

        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }

    /**
     * Check if image is an image file
     */
    public function getIsImageAttribute(): bool
    {
        return str_starts_with($this->mime_type, 'image/');
    }
}
