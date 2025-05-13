<?php

namespace App\Services;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class TransactionService
{
    public function list(string $type): Collection
    {
        return Transaction::where('type', $type)
                            ->orderBy('created_at', 'desc')
                            ->get();
    }

    public function create(Request $data, string $type): Transaction
    {
        return Transaction::create([
            'type' => $type,
            'label' => $data->label,
            'amount' => $data->amount,
        ]);
    }

    public function update(Request $data, int $id, string $type): Transaction
    {
        $transaction = Transaction::findOrFail($id);

        $transaction->update([
            'type' => $type,
            'label' => $data->label,
            'amount' => $data->amount,
        ]);

        return $transaction;
    }

    public function delete(int $id): void
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();
    }
}
