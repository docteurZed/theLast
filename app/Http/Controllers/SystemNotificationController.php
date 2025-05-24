<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\SystemNotification;
use Illuminate\Http\Request;

class SystemNotificationController extends Controller
{
    public function index ()
    {
        return view('admin.system_notification.index');
    }

    public function store (Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
        ]);

        $users = User::orderBy('id', 'desc')->get();

        foreach ($users as $user) {
            $user->notify(new SystemNotification($request->subject, $request->message));
        }

        return back()->with('success', 'Messages envoyés avec succès.');
    }
}
