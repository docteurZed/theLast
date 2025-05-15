<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name',
        'starts_at',
        'location',
        'location_latitude',
        'location_longitude',
        'dress_code',
        'primary_color_name',
        'primary_color_hex',
        'secondary_color_name',
        'secondary_color_hex',
        'primary_image',
        'secondary_image',
    ];

    public function programs()
    {
        return $this->hasMany(EventProgram::class);
    }

    public function invitations ()
    {
        return $this->hasMany(Invitation::class);
    }
}
