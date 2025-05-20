<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ConfirmationController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index ()
    {
        $now = Carbon::now();
        $deadline = Carbon::create(2025, 5, 20, 13, 0, 0);

        if ($now->gt($deadline)) {
            abort(403);
        }

        return view('guest.confirmation.index');
    }

    public function show ()
    {
        if (!Session::has('confirmation_sent')) {
            abort(403);
        }

        return view('guest.confirmation.message');
    }

    public function store(UserRequest $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email,',
        ], [
            'email.required' => 'L\'adresse email est obligatoire.',
            'email.email' => 'L\'adresse email n\'est pas valide.',
            'email.unique' => 'L\'adresse email est dèjà utilisé.'
        ]);

        $this->userService->create($request, 'guest');

        return redirect()->route('confirmation.message')->with('confirmation_sent', true);
    }
}
