<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AboutUs extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'address',
        'thumbnail',
        'thumbnail_alt',
        'light_logo',
        'dark_logo',
        'favicon',
        'slogan',
        'facebook',
        'youtube',
        'linkedin',
        'tiktok',
        'description',
        'footer_text',
        'hr_email',
        'hr_phone',
        'google_map',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'og_image',
        'og_title',
        'og_description',
        'canonical_url',
        'google_site_verification',
        'google_analytics',
        'meta_pixel',
    ];
}
