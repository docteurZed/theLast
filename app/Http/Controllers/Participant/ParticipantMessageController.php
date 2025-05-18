<?php

namespace App\Http\Controllers\Participant;

use App\Http\Controllers\Controller;
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

        $this->service->store($request);

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
