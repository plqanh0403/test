<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Recruitment extends Model
{
    use HasFactory;

    protected $fillable = [
        'position',
        'description',
        'requirements',
        'benefits',
        'location',
        'work_type',
        'application_deadline',
        'status',
        'is_visible',
        'seo_title',
        'seo_description',
        'is_visible'
    ];
}
