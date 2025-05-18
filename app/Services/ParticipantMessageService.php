<?php

namespace App\Services;

use App\Models\ParticipantMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParticipantMessageService
{
    public function list ()
    {
        return ParticipantMessage::where('receiver_id', Auth::user()->id)->orderBy('is_read')->get();
    }

    public function store (Request $request)
    {
        $anonymous = false;

        if($request->is_anonymous)
        {
            $anonymous = true;
        }
        return ParticipantMessage::create([
            'sender_id' => Auth::user()->id,
            'receiver_id' => $request->receiver_id,
            'content' => $request->content,
            'is_anonymous' => $anonymous,
        ]);
    }

    public function markAsRead(int $id): array
    {
        $message = ParticipantMessage::findOrFail($id);

        if(!$message->is_read) {
            $message->is_read = true;
            $message->save();
        }

        return ['success' => true, 'message' => 'Message marqué comme lu.'];
    }
}
