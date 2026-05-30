<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubmitContact extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "email",
        "phone",
        "company",
        "message",
        "internal_note",
    ];
}
