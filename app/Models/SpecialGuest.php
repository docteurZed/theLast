<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpecialGuest extends Model
{
    protected $fillable = [
        'title',
        'role',
        'name',
        'domain',
        'image',
        'description',
    ];
}
