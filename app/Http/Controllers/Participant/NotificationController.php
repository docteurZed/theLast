<?php

namespace App\Http\Controllers\Participant;

use App\Http\Controllers\Controller;
use App\Services\ParticipantMessageService;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function __construct(protected ParticipantMessageService $service) {}

    public function index ()
    {
        return view('participant.notification.index', [
            'discussions' => $this->service->listDiscussion(),
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
        ]);
    }
}
