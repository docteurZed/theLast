<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'user_id',
        'amount',
        'method',
        'reference_code',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($payment) {
            $payment->reference_code = 'PAY-' . uniqid();
        });
    }

    public function getRelativeCreatedAtAttribute()
    {
        return Carbon::parse($this->created_at)->translatedFormat('d F Y \à H\hi');
    }

    public function user ()
    {
        return $this->belongsTo(User::class);
    }
}
