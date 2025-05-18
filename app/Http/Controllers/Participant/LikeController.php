<?php

namespace App\Http\Controllers\Participant;

use App\Http\Controllers\Controller;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{

    public function like($id)
    {
        try {
            $likerId = Auth::id();

            if ($likerId == $id) {
                return response()->json(['success' => false, 'message' => 'Tu ne peux pas te liker toi-même.']);
            }

            $alreadyLiked = Like::where('liker_id', $likerId)
                                ->where('liked_id', $id)
                                ->first();

            if ($alreadyLiked) {
                $alreadyLiked->delete();
                return response()->json(['success' => true, 'message' => 'Like retiré.']);
            }

            Like::create([
                'liker_id' => $likerId,
                'liked_id' => $id,
            ]);

            return response()->json(['success' => true, 'message' => 'Like envoyé avec succès.']);

        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur serveur : ' . $e->getMessage()
            ]);
        }

    }

}
