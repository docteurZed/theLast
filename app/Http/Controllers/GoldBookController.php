<?php

namespace App\Http\Controllers;

use App\Http\Requests\GoldBookRequest;
use App\Models\GoldBook;
use Illuminate\Http\Request;

class GoldBookController extends Controller
{
    public function index()
    {
        return view('participant.gold_book.index', [
            'messages' => GoldBook::all()
        ]);
    }

    public function create()
    {
        return view('participant.gold_book.create');
    }

    public function store(GoldBookRequest $request)
    {
        GoldBook::create([
            'user_id' => $request->user()->id,
            'message' => $request->message,
        ]);

        return back()->with('success', 'Merci d\'avoir pensé à tes cadets. Dieu te récompensera ✨');
    }
}
