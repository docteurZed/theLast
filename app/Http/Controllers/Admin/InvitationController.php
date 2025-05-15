<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\InvitationRequest;
use App\Models\Event;
use App\Models\Invitation;
use App\Models\User;
use App\Notifications\InvitationNotification;
use App\Services\InvitationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvitationController extends Controller
{
    protected $service;

    public function __construct(InvitationService $service)
    {
        $this->service = $service;
    }

    public function index ()
    {
        if (Auth::user()->role == 'guest') {
            abort(403);
        }

        return view('admin.invitation.index', [
            'invitations' => $this->service->list(),
            'events' => Event::all(),
            'users' => User::all(),
        ]);
    }

    public function show ($id)
    {
        if (Auth::user()->role == 'guest') {
            abort(403);
        }

        return view('admin.invitation.show', [
            'invitation' => $this->service->show($id),
        ]);
    }

    public function template ()
    {
        if (Auth::user()->role == 'guest') {
            abort(403);
        }

        return view('admin.invitation.template');
    }


    public function store(InvitationRequest $request)
    {
        if (Auth::user()->role == 'guest') {
            abort(403);
        }

        $users = User::all();

        foreach ($users as $user) {
            $this->service->storeOrUpdate($request->event_id, $user->id);
        }

        return back()->with('success', 'Invitations générées avec succès.');
    }

    public function send(InvitationRequest $request)
    {
        if (Auth::user()->role == 'guest') {
            abort(403);
        }

        $invitations = Invitation::where('event_id', $request->event_id)->get();

        if($invitations->isNotEmpty()) {
            return back()->with('warning', 'Aucune invitation générées pour cet événement.');
        }

        foreach ($invitations as $invitation) {
            $invitation->user->notify(new InvitationNotification($invitation));
        }

        return back()->with('success', 'Invitations envoyées avec succès.');
    }

    public function sendDetail($id)
    {
        if (Auth::user()->role == 'guest') {
            abort(403);
        }

        $invitation = Invitation::findOrFail($id);

        $invitation->user->notify(new InvitationNotification($invitation));

        return back()->with('success', 'Invitation envoyées avec succès.');
    }

    public function destroy(int $id)
    {
        if (Auth::user()->role == 'guest') {
            abort(403);
        }

        $this->service->delete($id);

        return back()->with('success', 'Invitation supprimée avec succès.');
    }
}
