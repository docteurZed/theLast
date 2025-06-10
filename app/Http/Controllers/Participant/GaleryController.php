<?php

namespace App\Http\Controllers\Participant;

use App\Http\Controllers\Controller;
use App\Models\RecommendedProfile;
use App\Models\User;
use App\Models\VoteCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GaleryController extends Controller
{
    public function index ()
    {
        return view('participant.galery.index', [
            'recommendedUsers' => RecommendedProfile::where('user_id', '!=', Auth::user()->id)
                                                ->latest()
                                                ->take(10)
                                                ->orderByDesc('created_at')
                                                ->get()
        ]);
    }

    public function list ()
    {
        return view('participant.galery.list', [
            'users' => User::where('id', '!=', Auth::user()->id)
                                ->where('is_active', true)
                                ->where('role', '!=', 'admin')
                                ->orderBy('name')
                                ->get(),
            'categories' => VoteCategory::all(),
        ]);
    }

    public function show ($id)
    {
        return view('participant.galery.detail', [
            'user' => User::findOrFail($id),
            'categories' => VoteCategory::all(['id', 'name'])
        ]);
    }
}
