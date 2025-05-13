<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageSectionRequest;
use App\Services\PageSectionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function __construct(protected PageSectionService $service) {}

    /**
     * Affiche les sections d'une page spécifique
     */
    public function index()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $sections = $this->service->showPageSections('contact');

        return view("admin.pages.index", [
            'sections' => $sections,
            'title' => 'A propos',
        ]);
    }

    /**
     * Met à jour ou crée une section
     */
    public function update(PageSectionRequest $request)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $this->service->updateOrCreate($request);

        return redirect()->back()->with('success', 'Section mise à jour avec succès.');
    }
}
