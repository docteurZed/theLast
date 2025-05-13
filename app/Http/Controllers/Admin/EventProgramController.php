<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventProgramRequest;
use App\Services\EventProgramService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventProgramController extends Controller
{
    protected $service;

    public function __construct(EventProgramService $service)
    {
        $this->service = $service;
    }

    public function index($event_id)
    {
        if (Auth::user()->role == 'guest') {
            abort(403);
        }

        return view('admin.event_program.index', [
            'programs' => $this->service->list($event_id),
            'event_id' => $event_id,
        ]);
    }

    public function store(EventProgramRequest $request)
    {
        if (Auth::user()->role == 'guest') {
            abort(403);
        }

        $this->service->create($request);
        return back()->with('success', 'Programme d\'événement ajouté avec succès.');
    }

    public function update(EventProgramRequest $request, $id)
    {
        if (Auth::user()->role == 'guest') {
            abort(403);
        }

        $this->service->update($request, $id);
        return back()->with('success', 'Programme d\'événement mis à jour avec succès.');
    }

    public function destroy($id)
    {
        if (Auth::user()->role == 'guest') {
            abort(403);
        }

        $this->service->delete($id);
        return back()->with('success', 'Programme d\'événement supprimé avec succès');
    }
}
