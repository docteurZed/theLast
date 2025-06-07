<?php

namespace App\Services;

use App\Models\ProfileScore;
use App\Models\Publication;
use App\Models\RecommendedProfile;
use App\Models\User;
use App\Notifications\UserActivityNotification;

class ProfileScoreService
{
    public function store (User $user)
    {
        $userId = $user->id;
        $score = $this->calculateProfileCompleteness($user);

        $profileScore = ProfileScore::updateOrCreate([
            'user_id' => $userId
        ], [
            'score' => $score
        ]);

        if($profileScore->score > 75) {
            if(!RecommendedProfile::where('user_id', $userId)->exists ()) {
                RecommendedProfile::create(['user_id' => $userId]);

                $publication = Publication::create([
                    'user_id' => User::where('role', 'admin')->first()->id,
                    'content' => "Breaking news : {$user->first_name} {$user->name} a mis son profil à jour ! Des nouveautés, du style, de la substance... Bref, ça sent le talent. Allez faire un tour."
                ]);

                $publication->users()->attach($userId);

                $user->notify(new UserActivityNotification(
                    type: 'publication',
                    message: "Votre profil a été mentionné.",
                    url: url(route('participant.publication.index')),
                    emailSubject: 'Votre profil a été mentionné dans une publication.',
                    emailIntro: "Votre profil a été mentionné dans une publication."
                ));
            }
        }

        return;
    }

    public function calculateProfileCompleteness(User $user): int
    {
        $score = 0;

        if ($user->first_name && $user->name && $user->phone && $user->email) {
            $score += 20;
        }

        if ($user->profile_photo_path) $score += 5;
        if ($user->banner_image) $score += 5;
        if ($user->social_links()->count() == 1) {
            $score += 5;
        } elseif ($user->social_links()->count() > 1) {
            $score += 10;
        }
        if ($user->experiences()->count() > 0) $score += 15;
        if ($user->educations()->count() > 0) $score += 15;
        if ($user->achievements()->count() > 0) $score += 15;
        if ($user->skills()->count() == 1) {
            $score += 10;
        } elseif ($user->skills()->count() > 1) {
            $score += 15;
        }

        return $score;
    }
}
