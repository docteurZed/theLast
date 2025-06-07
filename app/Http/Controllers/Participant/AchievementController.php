<?php

namespace App\Http\Controllers\Participant;

use App\Http\Controllers\Controller;
use App\Http\Requests\AchievementRequest;
use App\Services\AchievementService;
use Illuminate\Http\Request;

class AchievementController extends Controller
{
    public function __construct(protected AchievementService $service) {}

    public function store(AchievementRequest $request)
    {
        $this->service->store($request);

        return back()->with('success', 'Réalisation ajoutée avec succès.');
    }

    public function update(AchievementRequest $request, $id)
    {
        $this->service->update($request, $id);

        return back()->with('success', 'Réalisation mise à jour.');
    }

    public function destroy($id)
    {
        $this->service->delete($id);

        return response()->json(['message' => 'Réalisation supprimée.']);
    }
}
