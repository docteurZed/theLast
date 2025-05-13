<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\GuestMessageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestMessageController extends Controller
{
    public function __construct(protected GuestMessageService $service)
    {
    }

    public function index()
    {
        if (Auth::user()->role === 'guest') {
            abort(403);
        }

        return view('admin.message.index', [
            'messages' => $this->service->getAllMessages(),
        ]);
    }

    public function updateStatut($id)
    {
        if (Auth::user()->role === 'guest') {
            return response()->json(['success' => false, 'message' => 'Vous n\'avez pas les autorisations nécessaires']);
        }

        try {
            return response()->json($this->service->markAsRead($id));
        } catch (\Exception) {
            return response()->json(['success' => false, 'message' => 'Erreur lors du changement de statut.']);
        }
    }

    public function destroy($id)
    {
        if (Auth::user()->role === 'guest') {
            abort(403);
        }

        $this->service->deleteMessage($id);

        return back()->with('success', 'Message supprimé avec succès.');
    }
}
