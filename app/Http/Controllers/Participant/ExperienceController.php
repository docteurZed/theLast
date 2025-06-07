<?php

namespace App\Http\Controllers\Participant;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExperienceRequest;
use App\Services\ExperienceService;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function __construct(protected ExperienceService $service) {}

    public function store(ExperienceRequest $request)
    {
        $this->service->store($request);

        return back()->with('success', 'Expérience ajoutée avec succès.');
    }

    public function update(ExperienceRequest $request, $id)
    {
        $this->service->update($request, $id);

        return back()->with('success', 'Expérience mise à jour.');
    }

    public function destroy($id)
    {
        $this->service->delete($id);

        return response()->json(['message' => 'Expérience supprimée.']);
    }
}
