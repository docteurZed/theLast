<?php

namespace App\Http\Controllers\Participant;

use App\Http\Controllers\Controller;
use App\Http\Requests\EducationRequest;
use App\Models\Education;
use App\Services\EducationService;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function __construct(protected EducationService $service) {}

    public function store(EducationRequest $request)
    {
        $this->service->store($request);

        return back()->with('success', 'Formation ajoutée avec succès.');
    }

    public function update(EducationRequest $request, $id)
    {
        $this->service->update($request, $id);

        return back()->with('success', 'Formation mise à jour.');
    }

    public function destroy($id)
    {
        $this->service->delete($id);

        return response()->json(['message' => 'Formation supprimée.']);
    }
}
