<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParticipantMessage extends Model
{
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'content',
        'is_anonymous',
        'is_read',
        'thread_key',
    ];

    public static function generateThreadKey($userA, $userB, $isAAnonymous)
    {
        $userIds = [$userA, $userB];
        sort($userIds);

        $isFirstAnon = ($userIds[0] == $userA) ? $isAAnonymous : false;
        $isSecondAnon = ($userIds[1] == $userA) ? $isAAnonymous : false;

        return "user:{$userIds[0]}-anon:" . ($isFirstAnon ? 'true' : 'false') .
            "|user:{$userIds[1]}-anon:" . ($isSecondAnon ? 'true' : 'false');
    }

    public function sender ()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver ()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
