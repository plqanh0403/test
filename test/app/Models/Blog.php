<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'slug',
        'type',
        'title',
        'is_visible',
        'content',
        'excerpt',
        'thumbnail',
        'thumbnail',
        'thumbnail_alt',
        'seo_title',
        'seo_description',
        'sort_order',
        'published_at'
    ];  

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
