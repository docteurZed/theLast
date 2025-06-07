<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileScore extends Model
{
    protected $fillable = ['user_id', 'score'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
