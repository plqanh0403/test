<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubmitContact extends Model
{
    protected $fillable = [
        "name",
        "email",
        "phone",
        "company",
        "message",
        "internal_note",
    ];
}
