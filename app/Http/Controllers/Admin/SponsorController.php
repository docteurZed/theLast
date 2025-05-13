<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SponsorRequest;
use App\Services\SponsorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SponsorController extends Controller
{
    public function __construct(protected SponsorService $service) {}

    public function index()
    {
        if (Auth::user()->role == 'guest') {
            abort(403);
        }

        return view('admin.sponsor.index', [
            'sponsors' => $this->service->list(),
        ]);
    }

    public function store(SponsorRequest $request)
    {
        if (Auth::user()->role == 'guest') {
            abort(403);
        }

        $this->service->create($request);
        return back()->with('success', 'Sponsor ajouté avec succès.');
    }

    public function update(SponsorRequest $request, $id)
    {
        if (Auth::user()->role == 'guest') {
            abort(403);
        }

        $this->service->update($request, $id);
        return back()->with('success', 'Sponsor mis à jour avec succès.');
    }

    public function destroy($id)
    {
        if (Auth::user()->role == 'guest') {
            abort(403);
        }

        $this->service->delete($id);
        return back()->with('success', 'Sponsor supprimé avec succès');
    }
}
