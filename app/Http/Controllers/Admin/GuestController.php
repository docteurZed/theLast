<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Setting;
use App\Models\User;
use App\Services\PaymentService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestController extends Controller
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
        if (Auth::user()->role == 'guest') {
            abort(403);
        }

        $guests = $this->userService->showAll('guest');

        return view('admin.guest.index', [
            'guests' => $guests
        ]);
    }

    public function printedList()
    {
        if (Auth::user()->role != 'admin') {
            abort(403);
        }

        $guests = User::where('role', '!=', 'admin')->orderBy('name')->get();

        return view('admin.guest.printed_list', [
            'guests' => $guests
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

        $user = $this->userService->create($request, 'guest');

        if ($request->has_paid) {
            $this->userService->updatePaymentStatus($user->id, $this->participation_fee, null, 'add');;
            $this->paymentService->create($request, $user->id, true);
        }

        return back()->with('success', 'Participant ajouté avec succès.');
    }

    public function update(UserRequest $request, $id)
    {
        $this->userService->update($id, $request);

        return back()->with('success', 'Participant mis à jour avec succès.');
    }

    public function destroy($id)
    {
        if (Auth::user()->role == 'guest') {
            abort(403, 'Accès interdit.');
        }

        if(Auth::user()->id == $id) {
            return back()->with(['warning' => 'Vous ne pouvez pas vous supprimer vous même']);
        }

        $this->userService->delete($id);

        return back()->with('success', 'Participant supprimé avec succès.');
    }

    public function toggleIsActive($id)
    {
        try {
            if(Auth::user()->id == $id) {
                return response()->json(['success' => false, 'message' => 'Vous ne pouvez pas désactiver votre propre compte']);
            };

            if (Auth::user()->role == 'guest') {
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
        if (Auth::user()->role == 'guest') {
            abort(403, 'Accès interdit.');
        }

        $request->validate([
            'amount' => 'required|numeric',
            'method' => 'nullable|in:mixx,flooz,cash',
        ], [
            'amount.required' => 'Le montant est obligatoire',
        ]);

        $guest = $this->userService->updatePaymentStatus($id, $request->amount, null, 'add');

        $this->paymentService->create($request, $guest->id);

        return back()->with('success', 'Statut de payement mis à jour avec succès');
    }
}
