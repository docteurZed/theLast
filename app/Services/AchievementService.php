<?php

namespace App\Services;

use App\Http\Requests\AchievementRequest;
use App\Models\Achievment;
use App\Models\User;

class AchievementService
{
    public function __construct(protected ProfileScoreService $service) {}

    public function store(AchievementRequest $request)
    {
        $userId = $request->user()->id;
        $user = User::findOrFail($userId);

        $achievement = Achievment::create([
            ...$request->validated(),
            'user_id' => $userId,
        ]);

        $this->service->store($user);

        return $achievement;
    }

    public function update(AchievementRequest $request, int $id)
    {
        $achievement = Achievment::findOrFail($id)->update($request->validated());

        $this->service->store(User::findOrFail($request->user_id));

        return $achievement;
    }

    public function delete($id): void
    {
        Achievment::findOrFail($id)->delete();
    }
}
