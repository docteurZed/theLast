<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VoteCategory extends Model
{
    protected $fillable = ['name'];

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function candidates()
    {
        // Tous les users qui ont été votés dans cette catégorie
        return $this->belongsToMany(User::class, 'votes', 'vote_category_id', 'candidat_id')->distinct();
    }

}
