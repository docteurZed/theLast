@extends('layouts.admin.app', [
    'header' => 'Administration'
])

@section('content')

<div class="row mt-4">
    <div class="col-xl-12">
        <div class="team-members" id="team-members">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card">
                        <div class="card-body">
                            <div class="team-header">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="mx-2">
                                        <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#create-payment">
                                            <i class="ri-add-line me-1 fw-semibold align-middle"></i>
                                            <span class="fw-bold">Ajouter</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="card custom-card">
                        <div class="card-body">
                            <table id="responsiveDataTable" class="table table-bordered w-100">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Référence</th>
                                        <th>Nom du participant</th>
                                        <th>Montant payé</th>
                                        <th>Total payé</th>
                                        <th>Méthode payment</th>
                                        <th>Statut de payement</th>
                                        <th>Date de payement</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($payments as $payment)
                                    @php
                                        $method = null;
                                        switch ($payment->method) {
                                            case 'cash':
                                                $method = 'Espèce';
                                                break;
                                            case 'mixx':
                                                $method = 'Mixx By Yas';
                                                break;
                                            case 'flooz':
                                                $method = 'Flooz';
                                                break;
                                            default :
                                                $method = 'Aucune méthode choisie';
                                                break;
                                        }
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="fw-bold text-center">
                                                {{ $payment->reference_code }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="fw-bold text-primary">
                                                {{ ucfirst($payment->user->first_name) }} {{ ucfirst($payment->user->name) }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="fw-bold text-center text-danger">
                                                {{ $payment->amount }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="fw-bold text-center text-success">
                                                {{ $payment->user->total_amount }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="fw-bold text-center">
                                                {{ $method }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                            @switch($payment->user->payment_status)
                                                @case('paid')
                                                    <span class="badge fw-bold bg-success py-2 px-3">
                                                        Payé
                                                    </span>
                                                    @break
                                                @case('pending')
                                                    <span class="badge fw-bold bg-warning py-2 px-3">
                                                        En cours
                                                    </span>
                                                    @break
                                                @default
                                                    <span class="badge fw-bold bg-success py-2 px-3">
                                                        Non payé
                                                    </span>
                                            @endswitch
                                            </div>
                                        </td>
                                        <td>
                                            <div class="fw-bold text-center">
                                                {{ $payment->relative_created_at }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="hstack gap-2 fs-15">
                                                <a aria-label="anchor" href="javascript:void(0);" class="btn btn-icon btn-wave waves-effect waves-light btn-sm btn-info-light" data-bs-toggle="modal" data-bs-target="#show-payment-{{ $payment->id }}">
                                                    <i class="ri-eye-line"></i>
                                                </a>
                                                <a aria-label="anchor" href="javascript:void(0);" class="btn btn-icon btn-wave waves-effect waves-light btn-sm btn-warning-light" data-bs-toggle="modal" data-bs-target="#edit-payment-{{ $payment->id }}">
                                                    <i class="ri-edit-line"></i>
                                                </a>
                                                <a aria-label="anchor" href="javascript:void(0);" class="btn btn-icon btn-wave waves-effect waves-light btn-sm btn-danger-light" data-bs-toggle="modal" data-bs-target="#delete-payment-{{ $payment->id }}">
                                                    <i class="ri-delete-bin-6-line"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Edit Admin -->
                                    <div class="modal fade" id="show-payment-{{ $payment->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title">Détail d'un payement</h6>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body px-4">
                                                    <div class="row gy-2">
                                                        <div class="col-xl-12 mb-3">
                                                            <label for="user_id" class="form-label">Participant <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="amount" name="amount" placeholder="Le nom du participant" value="{{ ucfirst($payment->user->first_name) }} {{ ucfirst($payment->user->name) }}" disabled>
                                                        </div>
                                                        <div class="col-xl-12 mb-3">
                                                            <label for="amount" class="form-label">Montant payé <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="amount" name="amount" placeholder="Le montant payé" value="{{ $payment->amount }}" disabled>
                                                        </div>
                                                        <div class="col-xl-12 mb-3">
                                                            <label for="method" class="form-label">Méthode de payement</label>
                                                            <input type="text" class="form-control" id="amount" name="amount" placeholder="Le montant payé" value="{{ $method }}" disabled>
                                                        </div>
                                                        <div class="col-xl-12 mb-3">
                                                            <label for="reference_code" class="form-label">Code de référence</label>
                                                            <input type="text" class="form-control" id="reference_code" name="reference_code" placeholder="Le code de référence" value="{{ $payment->reference_code }}" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light"
                                                        data-bs-dismiss="modal">Retour</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End:: Create Contact -->
                                    <!-- Edit Admin -->
                                    <div class="modal fade" id="edit-payment-{{ $payment->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title">Modification d'un payement</h6>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('admin.payment.update', ['id' => $payment->id]) }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                <div class="modal-body px-4">
                                                    <div class="row gy-2">
                                                        <div class="col-xl-12 mb-3">
                                                            <label for="user_id" class="form-label">Participant <span class="text-danger">*</span></label>
                                                            <select class="form-control" name="user_id" id="user_id" required>
                                                                <option value="">Choisir un statut</option>
                                                                @forelse ($users as $user)
                                                                <option value="{{ $user->id }}" {{ old('user_id', $payment->user_id) == $user->id ? 'selected' : '' }}>{{ ucfirst($user->first_name) }} {{ ucfirst($user->name) }}</option>
                                                                @empty
                                                                <option value="">Aucun utilisateur enrégistré</option>
                                                                @endforelse
                                                            </select>
                                                        </div>
                                                        <div class="col-xl-12 mb-3">
                                                            <label for="amount" class="form-label">Montant payé <span class="text-danger">*</span></label>
                                                            <input type="number" class="form-control" id="amount" name="amount" placeholder="Le montant payé" value="{{ old('amount', $payment->amount) }}" required>
                                                        </div>
                                                        <div class="col-xl-12 mb-3">
                                                            <label for="method" class="form-label">Méthode de payement</label>
                                                            <select class="form-control" name="method" id="method">
                                                                <option value="">Choisir une méthode</option>
                                                                <option value="cash" {{ old('method', $payment->method) == 'cash' ? 'selected' : '' }}>Espèce</option>
                                                                <option value="mixx" {{ old('method', $payment->method) == 'mixx' ? 'selected' : '' }}>Mixx By Yas</option>
                                                                <option value="flooz" {{ old('method', $payment->method) == 'flooz' ? 'selected' : '' }}>Flooz</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light"
                                                        data-bs-dismiss="modal">Retour</button>
                                                    <button type="submit" class="btn btn-primary">Modifier</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End:: Create Contact -->
                                    <!-- Delete ClientType -->
                                    <div class="modal fade" id="delete-payment-{{ $payment->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title">Supprimer un payement</h6>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('admin.payment.destroy', ['id' => $payment->id]) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                <div class="modal-body px-4">
                                                    <p class="text-center my-4">
                                                        Voulez-vous vraiment supprimer ce payement ?
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light"
                                                        data-bs-dismiss="modal">Retour</button>
                                                    <button type="submit" class="btn btn-primary">Confirmer</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End:: Edit ClientType -->
                                    @empty
                                    <tr>
                                        <td colspan="9">
                                            <div class="flex justify-content-center">
                                                <p class="text-center">
                                                    Aucun payement enrégistré
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Create Admin -->
<div class="modal fade" id="create-payment" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Créer un payement</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.payment.store') }}" method="post">
                @csrf
            <div class="modal-body px-4">
                <div class="row gy-2">
                    <div class="col-xl-12 mb-3">
                        <label for="user_id" class="form-label">Participant <span class="text-danger">*</span></label>
                        <select class="form-control" name="user_id" id="user_id" required>
                            <option value="">Choisir un participant</option>
                            @forelse ($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ ucfirst($user->first_name) }} {{ ucfirst($user->name) }}</option>
                            @empty
                            <option value="">Aucun utilisateur enrégistré</option>
                            @endforelse
                        </select>
                    </div>
                    <div class="col-xl-12 mb-3">
                        <label for="amount" class="form-label">Montant payé <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="amount" name="amount" placeholder="Le montant payé" value="{{ old('amount') }}" required>
                    </div>
                    <div class="col-xl-12 mb-3">
                        <label for="method" class="form-label">Méthode de payement</label>
                        <select class="form-control" name="method" id="method">
                            <option value="">Choisir une méthode</option>
                            <option value="cash" {{ old('method') == 'cash' ? 'selected' : '' }}>Espèce</option>
                            <option value="mixx" {{ old('method') == 'mixx' ? 'selected' : '' }}>Mixx By Yas</option>
                            <option value="flooz" {{ old('method') == 'flooz' ? 'selected' : '' }}>Flooz</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light"
                    data-bs-dismiss="modal">Retour</button>
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Create Admin -->

@endsection
