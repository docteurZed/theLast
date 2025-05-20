<?php

namespace App\Services;

use App\Models\Vote;
use Illuminate\Support\Facades\Auth;

class VoteService
{
    public function vote(int $candidatId, int $categoryId)
    {
        $userId = Auth::user()->id;

        // Vérifie si un vote existe déjà
        $vote = Vote::where('voter_id', $userId)
                    ->where('vote_category_id', $categoryId)
                    ->first();

        if ($vote) {
            // Met à jour le vote existant
            $vote->update(['candidat_id' => $candidatId]);

            return [
                'success' => true,
                'message' => 'Ton vote a été mis à jour.',
            ];
        }

        // Crée un nouveau vote
        return Vote::create([
            'voter_id' => $userId,
            'candidat_id' => $candidatId,
            'vote_category_id' => $categoryId,
        ]);
    }
}
