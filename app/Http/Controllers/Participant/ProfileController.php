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

    public function updateProfilePhoto(Request $request, $id)
    {
        $request->validate(['profile_photo' => 'required|image|mimes:png,jpg,jpeg']);

        $this->userService->updateProfilePhoto($id, $request);

        return back()->with('success', 'Photo de profil mise à jour avec succès.');
    }

    public function updateBannerImage(Request $request, $id)
    {
        $request->validate(['banner_image' => 'required|image|mimes:png,jpg,jpeg']);

        $this->userService->updateBannerImage($id, $request);

        return back()->with('success', 'Image de bannière mise à jour avec succès.');
    }
}
