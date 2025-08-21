<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PageBanner extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'page_banners';
    use HasFactory;

    protected $fillable = [
        'page_name',
        'title',
        'description',
        'banner_image_path',
        'banner_image_alt',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the banner image URL
     */
    public function getBannerImageUrlAttribute()
    {
        if ($this->banner_image_path && Storage::disk('public')->exists($this->banner_image_path)) {
            return asset('storage/' . $this->banner_image_path);
        }
        return null;
    }

    /**
     * Get banner for a specific page
     */
    public static function getBannerForPage($pageName)
    {
        return static::where('page_name', $pageName)
            ->where('is_active', true)
            ->first();
    }

    /**
     * Get default banner image if no custom banner is set
     */
    public function getDefaultBannerUrl()
    {
        return asset('assets/img/bg/breadcumb-bg.jpg');
    }

    /**
     * Get the effective banner URL (custom or default)
     */
    public function getEffectiveBannerUrlAttribute()
    {
        return $this->banner_image_url ?? $this->getDefaultBannerUrl();
    }
}
