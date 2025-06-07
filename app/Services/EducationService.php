<?php

namespace App\Services;

use App\Models\Education;
use App\Http\Requests\EducationRequest;
use App\Models\User;

class EducationService
{
    public function __construct(protected ProfileScoreService $service) {}

    public function store(EducationRequest $request)
    {
        $education = Education::create([
            ...$request->validated(),
            'user_id' => $request->user()->id,
        ]);

        $user = User::findOrFail($request->user()->id);
        $this->service->store($user);

        return $education;
    }

    public function update(EducationRequest $request, int $id)
    {
        $education = Education::findOrFail($id)->update($request->validated());

        $this->service->store(User::findOrFail($request->user_id));

        return $education;
    }

    public function delete($id): void
    {
        Education::findOrFail($id)->delete();
    }
}
