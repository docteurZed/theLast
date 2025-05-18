<?php

namespace App\Http\Controllers\Participant;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Vote;
use App\Models\VoteCategory;
use App\Services\VoteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VoteController extends Controller
{
    protected $voteService;

    public function __construct(VoteService $voteService)
    {
        $this->voteService = $voteService;
    }

    public function index()
    {
        $user = Auth::user();

        $categories = VoteCategory::all();
        $users = User::where('id', '!=', $user->id)->get();

        // Top 5 par catégorie
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
                    'vote_category_id' => $vote->vote_category_id
                ];
            })
            ->groupBy('vote_category_id')
            ->map(fn($group) => $group->take(3));

        return view('participant.vote.index', [
            'categories' => $categories,
            'users' => $users,
            'candidatesGroupedByCategory' => $candidatesGroupedByCategory,
        ]);
    }


    public function store(Request $request)
    {
        if (Auth::user()->id == $request->candidat_id) {
            abort(403);
        }

        $validated = $request->validate([
            'candidat_id' => 'required|exists:users,id',
            'vote_category_id' => 'required|exists:vote_categories,id',
        ]);

        $this->voteService->vote(
            (int) $validated['candidat_id'],
            (int) $validated['vote_category_id']
        );

        return back()->with('success', 'Vote enrégistré');
    }

    public function multipleStore(Request $request)
    {
        if (Auth::user()->id == $request->candidat_id) {
            abort(403);
        }

        $validated = $request->validate([
            'candidat_id' => 'required|exists:users,id',
            'categories' => 'required|array',
            'categories.*' => 'integer|exists:vote_categories,id',
        ]);

        foreach ($validated['categories'] as $categoryId) {
            $this->voteService->vote(
                (int) $validated['candidat_id'],
                (int) $categoryId
            );
        }

        return back()->with('success', 'Votes enregistrés avec succès');
    }

}
