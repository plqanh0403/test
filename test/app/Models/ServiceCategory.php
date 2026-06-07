<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServiceCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'seo_title',
        'seo_description',
        'is_visible',
        'sort_order',
        'banner_image',
    ];

    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
