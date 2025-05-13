<?php

namespace App\Services;

use App\Models\Payment;
use App\Models\Setting;
use App\Models\Transaction;
use Illuminate\Http\Request;

class PaymentService
{
    protected $participation_fee;

    public function __construct()
    {
        $setting = Setting::where('singleton_key', 'main')->first();
        $this->participation_fee = $setting->participation_fee;
    }

    public function showAll()
    {
        return Payment::orderBy('created_at', 'desc')->get();
    }

    public function show(int $id)
    {
        return Payment::findOrFail($id);
    }

    public function create(Request $data, int $user_id = null, bool $sold_out = false)
    {
        $payment = Payment::create([
            'user_id' => $user_id ?? $data->user_id,
            'amount' => $sold_out ? $this->participation_fee : $data->amount,
            'method' => $data->method,
        ]);

        Transaction::updateOrCreate([
            'type' => 'income',
            'label' => 'Cotisation',
        ],[
            'amount' => Payment::sum('amount'),
        ]);

        return $payment;
    }

    public function update(Request $data, int $id, bool $sold_out = false)
    {
        $payment = $this->show($id);

        $payment->update([
            'user_id' => $data->user_id,
            'amount' => $sold_out ? $this->participation_fee : $data->amount,
            'method' => $data->method,
        ]);

        Transaction::updateOrCreate([
            'type' => 'income',
            'label' => 'Cotisation',
        ],[
            'amount' => Payment::sum('amount'),
        ]);

        return $payment;
    }

    public function delete(int $id)
    {
        $payment = $this->show($id);

        $payment->delete();

        Transaction::updateOrCreate([
            'type' => 'income',
            'label' => 'Cotisation',
        ],[
            'amount' => Payment::sum('amount'),
        ]);

        return $payment;
    }
}
