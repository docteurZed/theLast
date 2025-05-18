<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SlideRequest;
use App\Services\SlideService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SlideController extends Controller
{
    protected $service;

    public function __construct(SlideService $service)
    {
        $this->service = $service;
    }

    public function index ()
    {
        if (Auth::user()->role != 'admin') {
            abort(403);
        }

        return view('admin.slide.index', [
            'slides' => $this->service->list(),
        ]);
    }

    public function store(SlideRequest $request)
    {
        if (Auth::user()->role != 'admin') {
            abort(403);
        }

        $this->service->create($request);
        return back()->with('success', 'Slide ajoutée avec succès.');
    }

    public function update(SlideRequest $request, $id)
    {
        if (Auth::user()->role != 'admin') {
            abort(403);
        }

        $this->service->update($request, $id);
        return back()->with('success', 'Slide mise à jour avec succès.');
    }

    public function destroy($id)
    {
        if (Auth::user()->role != 'admin') {
            abort(403);
        }

        $this->service->delete($id);
        return back()->with('success', 'Slide supprimée avec succès');
    }
}
