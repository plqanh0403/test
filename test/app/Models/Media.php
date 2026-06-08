<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = [
        'name',
        'original_name',
        'path',
        'url',
        'mime_type',
        'size',
        'type',
        'folder',
        'uploaded_by'
    ];
}
