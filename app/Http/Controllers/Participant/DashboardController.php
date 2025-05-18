<?php

namespace App\Http\Controllers\Participant;

use App\Http\Controllers\Controller;
use App\Models\Slide;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index ()
    {
        return view('participant.dashboard.index', [
            'slides' => Slide::all()
        ]);
    }
}
