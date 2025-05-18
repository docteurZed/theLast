<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class InteractionController extends Controller
{
    public function index ()
    {
        return view('admin.interaction.index', [
            'users' => User::all(),
        ]);
    }
}
