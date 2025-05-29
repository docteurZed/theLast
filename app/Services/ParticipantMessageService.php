<?php

namespace App\Services;

use App\Models\ParticipantMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ParticipantMessageService
{
    public function listDiscussion()
    {
        $userId = Auth::user()->id;

        // Sous-requête : dernier ID par thread_key
        $sub = ParticipantMessage::select(DB::raw('MAX(id) as id'))
            ->where(function($q) use ($userId) {
                $q->where('sender_id', $userId)
                ->orWhere('receiver_id', $userId);
            })
            ->groupBy('thread_key');

        $latestMessages = ParticipantMessage::whereIn('id', $sub)
            ->with(['sender', 'receiver'])
            ->latest()
            ->get();

        return $latestMessages->map(function($message) use ($userId) {
            $interlocutor = $message->sender_id === $userId ? $message->receiver : $message->sender;

            // Nouvelle logique : vérifier si l'interlocuteur a déjà envoyé un message anonyme dans ce thread
            $interlocutorWasAnonymous = ParticipantMessage::where('thread_key', $message->thread_key)
                ->where('sender_id', $interlocutor->id)
                ->where('is_anonymous', true)
                ->exists();

            $interlocutorDisplayName = $interlocutorWasAnonymous
                ? 'Anonyme - ' . substr(md5($interlocutor->id), 0, 6)
                : $interlocutor->name;

            // Calcul des messages non lus
            $unreadCount = ParticipantMessage::where('thread_key', $message->thread_key)
                ->where('receiver_id', $userId)
                ->where('is_read', false)
                ->count();

            return (object)[
                'thread_key'     => $message->thread_key,
                'interlocutor'   => $interlocutorDisplayName,
                'last_message'   => Str::limit($message->content, 40),
                'elapsed'        => Carbon::parse($message->created_at)->diffForHumans(),
                'is_read'        => $message->is_read,
                'unread_count'   => $unreadCount,
                'all_read'       => $unreadCount === 0,
                'is_self_anonymous' => $message->sender_id === $userId
                                        ? $message->is_anonymous
                                        : false,
            ];
        });
    }

    public function listMessage(string $threadKey): array
    {
        $userId = Auth::user()->id;

        $messages = ParticipantMessage::where('thread_key', $threadKey)
            ->orderBy('created_at')
            ->with(['sender', 'receiver'])
            ->get();

        // Trouver l'autre utilisateur dans la conversation
        $otherUserId = $messages
            ->first(fn($msg) => $msg->sender_id !== $userId)?->sender_id
            ?? $messages->first(fn($msg) => $msg->receiver_id !== $userId)?->receiver_id;

        // Vérifie si l'autre utilisateur a été anonyme à un moment dans le thread
        $interlocutorWasAnonymous = ParticipantMessage::where('thread_key', $threadKey)
            ->where('sender_id', $otherUserId)
            ->where('is_anonymous', true)
            ->exists();

        return [
            'messages' => $messages->map(function ($msg) use ($userId, $interlocutorWasAnonymous, $otherUserId) {
                $isSender = $msg->sender_id === $userId;

                $senderName = $isSender
                    ? optional($msg->sender)->name
                    : ($interlocutorWasAnonymous
                        ? 'Anonyme - ' . substr(md5($otherUserId), 0, 6)
                        : optional($msg->sender)->name);

                return (object)[
                    'id' => $msg->id,
                    'content' => $msg->content,
                    'created_at' => $msg->created_at,
                    'is_read' => $msg->is_read,
                    'is_anonymous' => $msg->is_anonymous,
                    'sender_id' => $msg->sender_id,
                    'sender_name' => $senderName,
                    'is_sender' => $isSender,
                ];
            }),
            'receiver_id' => $otherUserId,
            'thread_key' => $threadKey
        ];
    }

    public function store (Request $request)
    {
        $senderId = Auth::user()->id;
        $receiverId = $request->receiver_id;
        $isAnonymous = $request->boolean('is_anonymous');



        $threadKey = $request->has('thread_key')
                    ? $request->thread_key
                    : ParticipantMessage::generateThreadKey($senderId, $receiverId, $isAnonymous);

        return ParticipantMessage::create([
            'sender_id' => $senderId,
            'receiver_id' => $receiverId,
            'content' => $request->content,
            'is_anonymous' => $isAnonymous,
            'thread_key' => $threadKey
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
