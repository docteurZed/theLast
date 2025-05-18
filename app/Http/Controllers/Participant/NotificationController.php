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
            'messages' => $this->service->list(),
        ]);
    }
}
