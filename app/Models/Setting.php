<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'singleton_key',
        'name',
        'email',
        'phone',
        'participation_fee',
        'decompt_event_date',
        'decompt_event_time',
    ];
}
