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

    public function store (Request $request)
    {
        if($request->receiver_id == Auth::user()->id) {
            abort(403);
        }

        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'content' => 'required|string',
            'is_anonymous' => 'nullable',
        ], [
            'receiver_id.required' => 'Le récepteur du message est obligatoire.',
            'receiver_id.exists' => 'Le récepteur du message n\'existe pas dans notre base.',
            'content.required' => 'Le contenu du message est obligatoire.',
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


        return back()->with('success', 'Message envoyé avec succès.');
    }

    public function updateStatut($id)
    {
        try {
            return response()->json($this->service->markAsRead($id));
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Erreur lors du changement de statut. ' . $e->getMessage()]);
        }
    }
}
