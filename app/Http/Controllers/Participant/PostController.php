<?php

namespace App\Http\Controllers\Participant;

use App\Http\Controllers\Controller;
use App\Services\PublicationService;
use Illuminate\Http\Request;

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
        ]);
    }
}
