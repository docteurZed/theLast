<?php

namespace App\Http\Controllers\Participant;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\VoteCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GaleryController extends Controller
{
    public function index ()
    {
        return view('participant.galery.index', [
            'users' => User::where('id', '!=', Auth::user()->id)
                                ->where('is_active', true)
                                ->where('role', '!=', 'admin')
                                ->orderBy('name')
                                ->get(),
            'categories' => VoteCategory::all(),
        ]);
    }
}
