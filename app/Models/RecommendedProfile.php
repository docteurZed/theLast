<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecommendedProfile extends Model
{
    protected $fillable = ['user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
