<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use App\Services\EventService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function __construct(protected EventService $service) {}

    public function index()
    {
        if (Auth::user()->role == 'guest') {
            abort(403);
        }

        return view('admin.event.index', [
            'events' => $this->service->list(),
        ]);
    }

    public function store(EventRequest $request)
    {
        if (Auth::user()->role == 'guest') {
            abort(403);
        }

        $this->service->create($request);
        return back()->with('success', 'Événement ajouté avec succès.');
    }

    public function update(EventRequest $request, $id)
    {
        if (Auth::user()->role == 'guest') {
            abort(403);
        }

        $this->service->update($request, $id);
        return back()->with('success', 'Événement mis à jour avec succès.');
    }

    public function destroy($id)
    {
        if (Auth::user()->role == 'guest') {
            abort(403);
        }

        $this->service->delete($id);
        return back()->with('success', 'Événement supprimé avec succès.');
    }
}
