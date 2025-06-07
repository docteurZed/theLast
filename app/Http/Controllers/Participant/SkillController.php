<?php

namespace App\Http\Controllers\Participant;

use App\Http\Controllers\Controller;
use App\Http\Requests\SkillRequest;
use App\Services\SkillService;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function __construct(protected SkillService $service) {}

    public function store(SkillRequest $request)
    {
        $this->service->store($request);

        return back()->with('success', 'Compétence ajoutée avec succès.');
    }

    public function update(SkillRequest $request, $id)
    {
        $this->service->update($request, $id);

        return back()->with('success', 'Compétence mise à jour.');
    }

    public function destroy($id)
    {
        $this->service->delete($id);

        return response()->json(['message' => 'Compétence supprimée.']);
    }
}
