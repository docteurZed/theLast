@extends('layouts.admin.app')

@section('content')

<div class="row">

    <div class="col-xl-3">
        <div class="card custom-card">
            <div class="card-body">
                <div class="d-flex align-items-top mb-2">
                    <div class="flex-fill">
                        <p class="mb-0 op-7">Total des participants</p>
                    </div>
                    <div class="ms-2">
                        <span class="avatar avatar-md bg-primary shadow-sm fs-18">
                            <i class="bi bi-person-square"></i>
                        </span>
                    </div>
                </div>
                <span class="fs-5 fw-semibold">{{ $totalParticipants }}</span>
            </div>
        </div>
    </div>

    <div class="col-xl-3">
        <div class="card custom-card">
            <div class="card-body">
                <div class="d-flex align-items-top mb-2">
                    <div class="flex-fill">
                        <p class="mb-0 op-7">Total des entrées</p>
                    </div>
                    <div class="ms-2">
                        <span class="avatar avatar-md bg-secondary shadow-sm fs-18">
                            <i class="bi bi-box-arrow-in-down"></i>
                        </span>
                    </div>
                </div>
                <span class="fs-5 fw-semibold">{{ $totalIncomes }}</span>
            </div>
        </div>
    </div>

    <div class="col-xl-3">
        <div class="card custom-card">
            <div class="card-body">
                <div class="d-flex align-items-top mb-2">
                    <div class="flex-fill">
                        <p class="mb-0 op-7">Total des dépenses</p>
                    </div>
                    <div class="ms-2">
                        <span class="avatar avatar-md bg-danger shadow-sm fs-18">
                            <i class="bi bi bi-box-arrow-in-up"></i>
                        </span>
                    </div>
                </div>
                <span class="fs-5 fw-semibold">{{ $totalExpenses }}</span>
            </div>
        </div>
    </div>

    <div class="col-xl-3">
        <div class="card custom-card">
            <div class="card-body">
                <div class="d-flex align-items-top mb-2">
                    <div class="flex-fill">
                        <p class="mb-0 op-7">Messages non lus</p>
                    </div>
                    <div class="ms-2">
                        <span class="avatar avatar-md bg-warning shadow-sm fs-18">
                            <i class="bi bi-person-square"></i>
                        </span>
                    </div>
                </div>
                <span class="fs-5 fw-semibold">{{ $unreadMessages }}</span>
            </div>
        </div>
    </div>

    @if ($recentUsers->isNotEmpty())
    <div class="col-xl-12">
        <div class="card custom-card overflow-hidden">
            <div class="card-header justify-content-between">
                <div class="card-title">
                    Participants récemment enrégistrés
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap mb-0">
                        <thead>
                            <tr>
                                <th scope="col">Code</th>
                                <th scope="col">Nom et prénoms</th>
                                <th scope="col">Numéro de téléphone</th>
                                <th scope="col">Statut de payement</th>
                            </tr>
                        </thead>
                        <tbody class="active-tab">
                            @foreach ($recentUsers as $user)
                            <tr>
                                <td>
                                    <div class="fw-bold">
                                        <i class="bi bi-upc-scan mx-2"></i>
                                        {{ $user->personal_code }}
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-bold text-primary">
                                        <i class="bi bi-person-fill mx-2"></i>
                                        {{ ucfirst($user->first_name) }} {{ ucfirst($user->name) }}
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-bold">
                                        <i class="bi bi-telephone-fill mx-2"></i>
                                        {{ $user->phone }}
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-bold">
                                        @if ($user->is_active)
                                        <i class="bi bi-toggle-on mx-2 text-success"></i>
                                        <span class="text-success">Actif</span>
                                        @else
                                        <i class="bi bi-toggle-off mx-2 text-danger"></i>
                                        <span class="text-danger">Inactif</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if ($recentPayments->isNotEmpty())
    <div class="col-xl-12">
        <div class="card custom-card overflow-hidden">
            <div class="card-header justify-content-between">
                <div class="card-title">
                    Récents payements
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap mb-0">
                        <thead>
                            <tr>
                                <th scope="col">Code</th>
                                <th scope="col">Nom et prénoms</th>
                                <th scope="col">Montant</th>
                                <th scope="col">Statut de payement</th>
                            </tr>
                        </thead>
                        <tbody class="active-tab">
                            @foreach ($recentPayments as $payment)
                            <tr>
                                <td>
                                    <div class="fw-bold">
                                        <i class="bi bi-upc-scan mx-2"></i>
                                        {{ $payment->reference_code }}
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-bold text-primary">
                                        {{ ucfirst($payment->user->first_name) }} {{ ucfirst($payment->user->name) }}
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-bold">
                                        {{ $payment->amount }}
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-bold">
                                        @if ($payment->user->payment_status == 'paid')
                                        <span class="badge bg-success px-3 py-2">Payé</span>
                                        @elseif($payment->user->payment_status == 'pending')
                                        <span class="badge bg-warning px-3 py-2">En cours</span>
                                        @else
                                        <span class="badge bg-danger px-3 py-2">Non payé</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

@endsection
