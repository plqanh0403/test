<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;
 
    protected $fillable = [
        'name',
        'category_id',
        'thumbnail',
        'thumbnail_alt',
        'overview',
        'details',
        'slug',
        'banner_image',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'is_visible',
        'sort_order',
    ];

    public function serviceCategory()
    {
        return $this->belongsTo(ServiceCategory::class, 'category_id');
    }
}
