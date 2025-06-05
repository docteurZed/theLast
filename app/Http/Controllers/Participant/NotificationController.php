<?php

namespace App\Http\Controllers\Participant;

use App\Http\Controllers\Controller;
use App\Models\FcmToken;
use App\Models\User;
use App\Services\ParticipantMessageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class NotificationController extends Controller
{
    public function __construct(protected ParticipantMessageService $service) {}

    public function index ()
    {
        return view('participant.notification.index', [
            'discussions' => $this->service->listDiscussion(),
            'users' => User::where('role', '!=', 'admin')
                            ->where('id', '!=', Auth::user()->id)
                            ->where('is_active', true)
                            ->orderBy('name')
                            ->get(),
        ]);
    }

    public function show(string $threadKey)
    {
        $data = $this->service->listMessage($threadKey);

        foreach ($data['messages'] as $msg) {
            if (!$msg->is_sender && !$msg->is_read) {
                $this->service->markAsRead($msg->id);
            }
        }


        return view('participant.notification.show', [
            'messages' => $data['messages'],
            'receiverId' => $data['receiver_id'],
            'thread_key' => $data['thread_key'],
            'sender' => $data['sender']
        ]);
    }

    public function notifPage()
    {
        return view('participant.notification.notif');
    }

    public function storeToken(Request $request)
    {
        $request->validate(['token' => 'required|string']);

        FcmToken::updateOrCreate(
            ['user_id' => Auth::user()->id, 'token' => $request->token],
            ['updated_at' => now()]
        );

        return response()->json(['message' => 'Token enregistré.']);
    }

    public function sendNotification(Request $request)
    {
        $user = Auth::user(); // ou tout autre utilisateur cible
        $token = $user->fcm_token;

        if (!$token) {
            return response()->json(['message' => 'Aucun token FCM disponible.'], 400);
        }

        $response = Http::withToken(env('FCM_SERVER_KEY'))->post('https://fcm.googleapis.com/fcm/send', [
            'to' => $token,
            'notification' => [
                'title' => 'Nouveau message',
                'body' => 'Vous avez un nouveau message.',
                'icon' => '/icons/icon-192x192.png'
            ],
            'priority' => 'high'
        ]);

        return response()->json(['fcm_response' => $response->json()]);
    }
}
