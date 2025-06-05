<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    protected $fillable = [
        'user_id',
        'content',
        'image'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function publication_likes()
    {
        return $this->hasMany(PublicationLike::class);
    }

    public function isLikedBy($user): bool
    {
        return $this->publication_likes()->where('user_id', $user->id)->exists();
    }

    public function publication_comments() {
        return $this->hasMany(PublicationComment::class);
    }

    public function users() {
        return $this->belongsToMany(User::class, 'publication_tags');
    }
}
