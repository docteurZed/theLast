<?php

namespace App\Services;

use App\Http\Requests\SkillRequest;
use App\Models\Skill;
use App\Models\User;

class SkillService
{
    public function __construct(protected ProfileScoreService $service) {}

    public function store(SkillRequest $request)
    {
        $skill = Skill::create([
            ...$request->validated(),
            'user_id' => $request->user()->id,
        ]);

        $user = User::findOrFail($request->user()->id);
        $this->service->store($user);

        return $skill;
    }

    public function update(SkillRequest $request, int $id)
    {
        $skill = Skill::findOrFail($id)->update($request->validated());

        $this->service->store(User::findOrFail($request->user_id));

        return $skill;
    }

    public function delete($id): void
    {
        Skill::findOrFail($id)->delete();
    }
}
