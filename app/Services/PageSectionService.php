<?php

namespace App\Services;

use App\Models\PageSection;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

class PageSectionService
{
    /**
     * Met à jour ou crée une section sur une page donnée
     */
    public function updateOrCreate(Request $request): PageSection
    {
        return PageSection::updateOrCreate(
            [
                'page' => $request->input('page'),
                'section' => $request->input('section'),
            ],
            $request->only(['name', 'title', 'description'])
        );
    }

    /**
     * Retourne toutes les sections groupées par page
     */
    public function showPageSections($page): Collection
    {
        return PageSection::where('page', $page)->orderBy('id')->get()->keyBy('section');
    }
}
