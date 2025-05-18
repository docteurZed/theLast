<?php

namespace App\Http\Controllers\Participant;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index ()
    {
        return view('participant.profile.index');
    }

    public function update(UserRequest $request, $id)
    {
        $this->userService->update($id, $request);

        return back()->with('success', 'Informations mises à jour avec succès.');
    }
}
