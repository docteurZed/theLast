<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionRequest;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IncomeController extends Controller
{
    protected $service;

    public function __construct(TransactionService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        if (Auth::user()->role == 'guest') {
            abort(403);
        }

        return view('admin.income.index', [
            'incomes' => $this->service->list('income'),
        ]);
    }

    public function store(TransactionRequest $request)
    {
        if (Auth::user()->role == 'guest') {
            abort(403);
        }

        $this->service->create($request, 'income');
        return back()->with('success', 'Entrée ajoutée avec succès.');
    }

    public function update(TransactionRequest $request, $id)
    {
        if (Auth::user()->role == 'guest') {
            abort(403);
        }

        $this->service->update($request, $id, 'income');
        return back()->with('success', 'Entrée mise à jour avec succès.');
    }

    public function destroy($id)
    {
        if (Auth::user()->role == 'guest') {
            abort(403);
        }

        $this->service->delete($id);
        return back()->with('success', 'Entrée supprimée avec succès');
    }
}
