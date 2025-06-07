<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PushSubscriptionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'endpoint' => 'required|url',
            'publicKey' => 'required|string',
            'authToken' => 'required|string',
        ]);

        $request->user()->pushSubscriptions()->updateOrCreate(
            ['endpoint' => $request->endpoint],
            [
                'public_key' => $request->publicKey,
                'auth_token' => $request->authToken,
            ]
        );

        return response()->json(['status' => 'ok']);
    }
}
