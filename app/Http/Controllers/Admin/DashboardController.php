<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GuestMessage;
use App\Models\Payment;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index ()
    {
        if (Auth::user()->role == 'guest') {
            abort(403);
        }

        return view('admin.dashboard.index', [
            'totalParticipants' => User::count(),
            'totalIncomes' => Transaction::where('type', 'income')->sum('amount'),
            'totalExpenses' => Transaction::where('type', 'expense')->sum('amount'),
            'unreadMessages' => GuestMessage::where('has_read', false)->count(),
            'recentUsers' => User::where('role', 'guest')->latest()->take(5)->get(),
            'recentPayments' => Payment::latest()->take(5)->get(),
        ]);
    }
}
