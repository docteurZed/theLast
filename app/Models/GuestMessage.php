<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class GuestMessage extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'email',
        'message',
        'has_read',
    ];

    public function getRelativeCreatedAtAttribute()
    {
        return Carbon::parse($this->created_at)->translatedFormat('d F Y \à H\hi');
    }
}
