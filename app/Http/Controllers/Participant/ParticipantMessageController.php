<?php

namespace App\Http\Controllers\Participant;

use App\Http\Controllers\Controller;
use App\Notifications\UserActivityNotification;
use App\Services\ParticipantMessageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParticipantMessageController extends Controller
{
    public function __construct(protected ParticipantMessageService $service) {}

    public function store(Request $request)
    {
        if ($request->receiver_id == Auth::user()->id) {
            abort(403);
        }

        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'content' => 'required|string',
            'is_anonymous' => 'nullable',
        ]);

        $message = $this->service->store($request);
        $message->load('receiver');

        $message->receiver->notify(new UserActivityNotification(
            type: 'message',
            message: "Un de vos collègue vous a envoyé un message privé.",
            url: url(route('participant.notification.index')),
            emailSubject: 'Nouveau message reçu',
            emailIntro: "Vous avez reçu un message d'un de vos collègue."
        ));

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Message envoyé',
                'data' => $message,
            ]);
        }

        return back()->with('success', 'Message envoyé avec succès.');
    }
}
