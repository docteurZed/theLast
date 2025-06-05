<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PublicationTag extends Pivot
{
    protected $fillable = ['publication_id', 'user_id'];
}
