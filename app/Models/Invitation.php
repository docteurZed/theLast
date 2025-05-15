<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    protected $fillable = [
        'user_id',
        'event_id',
        'code',
        'is_downloaded',
        'is_sent',
        'is_verified',
    ];

    public function user ()
    {
        return $this->belongsTo(User::class);
    }

    public function event ()
    {
        return $this->belongsTo(Event::class);
    }
}
