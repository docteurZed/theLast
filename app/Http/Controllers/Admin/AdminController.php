<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Setting;
use App\Services\PaymentService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    protected $userService;
    protected $paymentService;
    protected $participation_fee;

    public function __construct(UserService $userService, PaymentService $paymentService)
    {
        $this->userService = $userService;
        $this->paymentService = $paymentService;
        $this->participation_fee = Setting::where('singleton_key', 'main')->first()->participation_fee;
    }

    public function index()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $admins = $this->userService->showAll('admin');

        return view('admin.admin.index', [
            'admins' => $admins
        ]);
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

        if (Auth::user()->role !== 'admin') {
            abort(403, 'Accès interdit.');
        }

        $user = $this->userService->create($request, 'admin', true);

        if ($request->has_paid) {
            $this->userService->updatePaymentStatus($user->id, $this->participation_fee, null, 'add');
            $this->paymentService->create($request, $user->id, true);
        }

        return back()->with('success', 'Organisateur ajouté avec succès.');
    }

    public function update(UserRequest $request, $id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Accès interdit.');
        }

        $this->userService->update($id, $request);

        return back()->with('success', 'Organisateur mis à jour avec succès.');
    }

    public function destroy($id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Accès interdit.');
        }

        if(Auth::user()->id == $id) {
            return back()->with(['warning' => 'Vous ne pouvez pas vous supprimer vous même']);
        }

        $this->userService->delete($id);

        return back()->with('success', 'Organisateur supprimé avec succès.');
    }

    public function toggleIsActive($id)
    {
        try {
            if(Auth::user()->id == $id) {
                return response()->json(['success' => false, 'message' => 'Vous ne pouvez pas désactiver votre propre compte']);
            };

            if (Auth::user()->role !== 'admin') {
                return response()->json(['success' => false, 'message' => 'Vous n\'avez pas les autorisations nécessaires']);
            }

            $this->userService->toggleActive($id);

            return response()->json([
                'success' => true,
                'message' => 'Statut mis à jour avec succès.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors du changement de statut.'
            ]);
        }
    }

    public function updatePaymentStatus(Request $request, $id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Accès interdit.');
        }

        $request->validate([
            'amount' => 'required|numeric',
            'method' => 'nullable|in:mixx,flooz,cash',
        ], [
            'amount.required' => 'Le montant est obligatoire',
        ]);

        $user = $this->userService->updatePaymentStatus($id, $request->amount, null, 'add');

        $this->paymentService->create($request, $user->id);

        return back()->with('success', 'Statut de payement mis à jour avec succès');
    }
}
