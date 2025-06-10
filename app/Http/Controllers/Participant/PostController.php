<?php

namespace App\Http\Controllers\Participant;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\PublicationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    protected PublicationService $service;

    public function __construct(PublicationService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return view('participant.post.index', [
            'publications' => $this->service->list(),
            'users' => User::where('role', '!=', 'admin')
                            ->where('id', '!=', Auth::user()->id)
                            ->orderBy('name')
                            ->get(['first_name', 'name', 'id']),
        ]);
    }
}
