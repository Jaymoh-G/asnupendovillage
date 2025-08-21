<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use App\Traits\HasImages;

class News extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'news';
    use HasImages;

    protected $fillable = [
        'title',
        'content',
        'excerpt',
        'slug',
        'featured_image',
        'category',
        'author',
        'status',
        'published_at',
        'views_count',
        'meta_title',
        'meta_description',
        'tags',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'views_count' => 'integer',
        'tags' => 'array',
    ];

    protected static function booted()
    {
        static::creating(function ($news) {
            if (empty($news->slug)) {
                $news->slug = Str::slug($news->title);
            }
        });

        static::updating(function ($news) {
            if ($news->isDirty('title')) {
                $news->slug = Str::slug($news->title);
            }
        });
    }

    /**
     * Scope to get published news articles
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /**
     * Scope to get latest news articles
     */
    public function scopeLatestNews($query, $limit = 6)
    {
        return $query->orderBy('published_at', 'desc')
            ->orderBy('created_at', 'desc')
            ->limit($limit);
    }
}
