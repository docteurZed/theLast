<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventProgram extends Model
{
    protected $fillable = [
        'event_id',
        'starts_at',
        'ends_at',
        'title',
        'description',
        'speaker',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
