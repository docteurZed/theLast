<?php

namespace App\Http\Controllers\Participant;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Slide;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index ()
    {
        return view('participant.dashboard.index', [
            'events' => Event::all(),
        ]);
    }

    public function detail ($id)
    {
        return view('participant.dashboard.detail', [
            'event' => Event::findOrFail($id),
        ]);
    }
}
