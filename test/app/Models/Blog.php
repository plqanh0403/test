<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Cache;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'slug',
        'type',
        'title',
        'seo_title',
        'seo_description',
        'status',
        'is_visible',
        'content',
        'excerpt',
        'thumbnail',
        'thumbnail_alt',
        'sort_order',
        'published_at',
    ];

    protected static function booted()
    {
        static::saved(function ($blog) {

            // Count
            Cache::forget('services_count');
            Cache::forget('activities_count');

            // List
            Cache::forget('tech_blogs');
            Cache::forget('activity_blogs');

            // Detail
            Cache::forget("blog_{$blog->slug}");

            // Related
            Cache::forget("related_blogs_{$blog->id}");
        });

        static::deleted(function ($blog) {

            // Count
            Cache::forget('services_count');
            Cache::forget('activities_count');

            // List
            Cache::forget('tech_blogs');
            Cache::forget('activity_blogs');

            // Detail
            Cache::forget("blog_{$blog->slug}");

            // Related
            Cache::forget("related_blogs_{$blog->id}");
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
