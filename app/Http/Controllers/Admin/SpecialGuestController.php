<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SpecialGuestRequest;
use App\Models\SpecialGuest;
use App\Services\SpecialGuestService;
use Illuminate\Support\Facades\Auth;

class SpecialGuestController extends Controller
{
    public function __construct(protected SpecialGuestService $service) {}

    public function index()
    {
        if (Auth::user()->role == 'guest') {
            abort(403);
        }

        return view('admin.special_guest.index', [
            'guests' => $this->service->list(),
        ]);
    }

    public function store(SpecialGuestRequest $request)
    {
        if (Auth::user()->role == 'guest') {
            abort(403);
        }

        $this->service->create($request);
        return back()->with('success', 'Invité ajouté avec succès.');
    }

    public function update(SpecialGuestRequest $request, $id)
    {
        if (Auth::user()->role == 'guest') {
            abort(403);
        }

        $this->service->update($request, $id);
        return back()->with('success', 'Invité mis à jour avec succès.');
    }

    public function destroy($id)
    {
        if (Auth::user()->role == 'guest') {
            abort(403);
        }

        $this->service->delete($id);
        return back()->with('success', 'Invité supprimé avec succès');
    }
}

