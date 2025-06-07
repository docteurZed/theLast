<?php

namespace App\Services;

use App\Models\Experience;
use App\Http\Requests\ExperienceRequest;
use App\Models\User;

class ExperienceService
{
    public function __construct(protected ProfileScoreService $service) {}

    public function store(ExperienceRequest $request)
    {
        $experience = Experience::create([
            ...$request->validated(),
            'user_id' => $request->user()->id,
        ]);

        $user = User::findOrFail($request->user()->id);
        $this->service->store($user);

        return $experience;
    }

    public function update(ExperienceRequest $request, int $id)
    {
        $experience = Experience::findOrFail($id)->update($request->validated());

        $this->service->store(User::findOrFail($request->user_id));

        return $experience;
    }

    public function delete($id): void
    {
        Experience::findOrFail($id)->delete();
    }
}
