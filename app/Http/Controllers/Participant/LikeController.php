<?php

namespace App\Http\Controllers\Participant;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Notifications\UserActivityNotification;
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

            $like = Like::create([
                'liker_id' => $likerId,
                'liked_id' => $id,
            ]);

            $user = Auth::user();

            if($user->id != $like->liked->id) {
                $like->liked->notify(new UserActivityNotification(
                    type: 'like',
                    message: ucfirst($user->first_name) . ' ' . ucfirst($user->name) . " a aimé votre profil.",
                    url: url(route('participant.galery.index')),
                    emailSubject: 'Quelqu’un a aimé votre profil.',
                    emailIntro: ucfirst($user->first_name) . ' ' . ucfirst($user->name) . " vient de liker votre profil."
                ));
            }

            return response()->json(['success' => true, 'message' => 'Like envoyé avec succès.']);

        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur serveur : ' . $e->getMessage()
            ]);
        }
    }
}
