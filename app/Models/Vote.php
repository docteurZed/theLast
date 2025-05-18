<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $fillable = ['voter_id', 'candidat_id', 'vote_category_id'];

    public function voter()
    {
        return $this->belongsTo(User::class, 'voter_id');
    }

    public function candidate()
    {
        return $this->belongsTo(User::class, 'candidat_id');
    }

    public function category()
    {
        return $this->belongsTo(VoteCategory::class, 'vote_category_id');
    }
}
