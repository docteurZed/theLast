<?php

namespace App\Http\Controllers;

use App\Http\Requests\VoteCategoryRequest;
use App\Models\Vote;
use App\Services\VoteCategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteCategoryController extends Controller
{
    protected $service;

    public function __construct(VoteCategoryService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        if (Auth::user()->role == 'guest') {
            abort(403);
        }

        $categories = $this->service->list();

        $candidatesGroupedByCategory = Vote::with('candidate')
            ->selectRaw('candidat_id, vote_category_id, COUNT(*) as votes_count')
            ->groupBy('candidat_id', 'vote_category_id')
            ->orderByDesc('votes_count')
            ->get()
            ->map(function ($vote) {
                $candidate = $vote->candidate;
                return [
                    'id' => $candidate->id,
                    'first_name' => $candidate->first_name,
                    'name' => $candidate->name,
                    'votes_count' => $vote->votes_count,
                    'vote_category_id' => $vote->vote_category_id,
                ];
            })
            ->groupBy('vote_category_id')
            ->map(fn($group) => $group->take(5));

        return view('admin.vote.index', [
            'categories' => $categories,
            'topCandidates' => $candidatesGroupedByCategory,
        ]);
    }

    public function store(VoteCategoryRequest $request)
    {
        if (Auth::user()->role == 'guest') {
            abort(403);
        }

        $this->service->create($request);
        return back()->with('success', 'Catégorie ajoutée avec succès.');
    }

    public function update(VoteCategoryRequest $request, $id)
    {
        if (Auth::user()->role == 'guest') {
            abort(403);
        }

        $this->service->update($request, $id);
        return back()->with('success', 'Catégorie mise à jour avec succès.');
    }

    public function destroy($id)
    {
        if (Auth::user()->role == 'guest') {
            abort(403);
        }

        $this->service->delete($id);
        return back()->with('success', 'Catégorie supprimée avec succès');
    }
}
