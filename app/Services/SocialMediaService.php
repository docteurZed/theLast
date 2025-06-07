<?php

namespace App\Services;

use App\Models\SocialLink;
use App\Models\User;
use Illuminate\Http\Request;

class SocialMediaService
{
    public function __construct(protected ProfileScoreService $service) {}

    public function store(array $data)
    {
        $link = SocialLink::updateOrCreate(
            [
                'user_id' => $data['user_id'],
                'platform' => $data['platform'],
            ],
            [
                'url' => $data['url'],
            ]
        );

        $user = User::findOrFail($data['user_id']);
        $this->service->store($user);

        return $link;
    }
}
