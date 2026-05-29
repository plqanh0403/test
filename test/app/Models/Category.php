<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        "name",
        "slug",
        "seo_title",
        "seo_description",
        "is_visible",
        "sort_order",
    ];

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }
}
