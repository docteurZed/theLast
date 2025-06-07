<?php

namespace App\Http\Controllers\Participant;

use App\Http\Controllers\Controller;
use App\Http\Requests\SocialMediaRequest;
use App\Services\SocialMediaService;
use Illuminate\Http\Request;

class SocialMediaController extends Controller
{
    public function __construct(protected SocialMediaService $service) {}

    public function store(SocialMediaRequest $request)
    {
        $userId = $request->user()->id;
        $links = $request->input('links', []);

        foreach ($links as $platform => $url) {
            if (!empty($url)) {
                $this->service->store([
                    'user_id' => $userId,
                    'platform' => $platform,
                    'url' => $url,
                ]);
            }
        }

        return back()->with('success', 'Liens enregistrés avec succès');
    }
}
