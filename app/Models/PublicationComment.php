<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PublicationComment extends Model
{
    protected $fillable = ['user_id', 'publication_id', 'content'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function publication() {
        return $this->belongsTo(Publication::class);
    }
}
