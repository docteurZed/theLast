<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use App\Models\Payment;
use App\Models\User;
use App\Services\PaymentService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    protected $paymentService;
    protected $userService;

    public function __construct(PaymentService $paymentService,
                                UserService $userService)
    {
        $this->paymentService = $paymentService;
        $this->userService = $userService;
    }

    public function index()
    {
        if (Auth::user()->role == 'guest') {
            abort(403);
        }

        $payments = $this->paymentService->showAll();
        $users = User::all();

        return view('admin.payment.index', [
            'payments' => $payments,
            'users' => $users,
        ]);
    }

    public function store(PaymentRequest $request)
    {
        if (Auth::user()->role == 'guest') {
            abort(403);
        }

        $payment = $this->paymentService->create($request);
        $this->userService->updatePaymentStatus($payment->user->id, $request->amount, null, 'add');

        return back()->with('success', 'Payement enrégistré avec succès.');
    }

    public function update(PaymentRequest $request, $id)
    {
        if (Auth::user()->role == 'guest') {
            abort(403);
        }

        $payment = Payment::findOrFail($id);
        $oldAmount = $payment->amount;

        $this->paymentService->update($request, $id);
        $this->userService->updatePaymentStatus($payment->user->id, $request->amount, $oldAmount, 'update');

        return back()->with('success', 'Payement mis à jour avec succès.');
    }

    public function destroy($id)
    {
        if (Auth::user()->role == 'guest') {
            abort(403);
        }

        $payment = Payment::findOrFail($id);
        $oldAmount = $payment->amount;

        $this->paymentService->delete($id);
        $this->userService->updatePaymentStatus($payment->user->id, null, $oldAmount, 'delete');

        return back()->with('success', 'Payement supprimé avec succès.');
    }
}
