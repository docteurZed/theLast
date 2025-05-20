@extends('layouts.admin.app', [
    'header' => 'Participants'
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
                                        <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#create-admin">
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
                                        <th>Code individuel</th>
                                        <th>Nom</th>
                                        <th>Email</th>
                                        <th>Numéro de téléphone</th>
                                        <th>Activité</th>
                                        <th>Statut de payement</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($guests as $admin)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="fw-bold d-flex align-items-center justify-content-center gap-2">
                                                <i class="bi bi-upc-scan"></i>
                                                {{ ucfirst($admin->personal_code) }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="fw-bold d-flex align-items-center justify-content-center gap-2">
                                                <i class="bi bi-person-fill"></i>
                                                {{ ucfirst($admin->first_name) }} {{ ucfirst($admin->name) }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="fw-bold d-flex align-items-center justify-content-center gap-2">
                                                <i class="bi bi-envelope"></i>
                                                {{ $admin->email }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="fw-bold d-flex align-items-center justify-content-center gap-2">
                                                <i class="bi bi-telephone-fill"></i>
                                                {{ $admin->phone }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-toggle-switch d-flex align-items-center">
                                                <input id="statut_{{ $admin->id }}" data-admin-id="{{ $admin->id }}" name="statut" type="checkbox"
                                                    @if($admin->is_active) checked @endif onchange="toggleAdminStatut({{ $admin->id }})">
                                                <label for="statut_{{ $admin->id }}" class="label-success"></label>
                                                <span class="ms-3 fw-semibold">
                                                    @if($admin->is_active)
                                                        <span class="text-success">Actif</span>
                                                    @else
                                                        <span class="text-danger">Inactif</span>
                                                    @endif
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                            @switch($admin->payment_status)
                                                @case('paid')
                                                    <span class="badge fw-bold bg-success py-2 px-3">
                                                        Payé
                                                    </span>
                                                    @break
                                                @case('pending')
                                                    <button type="button" class="btn btn-warning my-1 me-2" data-bs-toggle="modal" data-bs-target="#edit-admin-payment-{{ $admin->id }}">
                                                        En cours
                                                    </button>
                                                    @break
                                                @default
                                                    <button type="button" class="btn btn-danger my-1 me-2" data-bs-toggle="modal" data-bs-target="#edit-admin-payment-{{ $admin->id }}">
                                                        Non payé
                                                    </button>
                                            @endswitch
                                            </div>
                                        </td>
                                        <td>
                                            <div class="hstack gap-2 fs-15">
                                                <a aria-label="anchor" href="javascript:void(0);" class="btn btn-icon btn-wave waves-effect waves-light btn-sm btn-info-light" data-bs-toggle="modal" data-bs-target="#show-admin-{{ $admin->id }}">
                                                    <i class="ri-eye-line"></i>
                                                </a>
                                                <a aria-label="anchor" href="javascript:void(0);" class="btn btn-icon btn-wave waves-effect waves-light btn-sm btn-warning-light" data-bs-toggle="modal" data-bs-target="#edit-admin-{{ $admin->id }}">
                                                    <i class="ri-edit-line"></i>
                                                </a>
                                                <a aria-label="anchor" href="javascript:void(0);" class="btn btn-icon btn-wave waves-effect waves-light btn-sm btn-danger-light" data-bs-toggle="modal" data-bs-target="#delete-admin-{{ $admin->id }}">
                                                    <i class="ri-delete-bin-6-line"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Edit Admin -->
                                    <div class="modal fade" id="edit-admin-payment-{{ $admin->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title">Modification d'un statut de payement</h6>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('admin.guest.updatePaymentStatus', ['id' => $admin->id]) }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="user_id" value="{{ $admin->id }}">
                                                <div class="modal-body px-4">
                                                    <div class="row gy-2">
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
                                                    <button type="submit" class="btn btn-primary">Modifier</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End:: Create Contact -->
                                    <div class="modal fade" id="show-admin-{{ $admin->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title">Détail d'un admin</h6>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body px-4">
                                                    <div class="row gy-2">
                                                        <div class="col-xl-12 mb-3 text-center">
                                                            <span class="avatar avatar-xxl avatar-rounded bg-primary-transparent fw-semibold">
                                                                @if (isset($admin->profile_photo))
                                                                <img src="{{ asset('storage/public/' . basename($admin->profile_photo)) }}" alt="Photo de profil">
                                                                @else
                                                                {{ substr(strtoupper($admin->name), 0, 1) }}{{ substr(strtoupper($admin->first_name), 0, 1) }}
                                                                @endif
                                                            </span>
                                                        </div>
                                                        <div class="col-xl-12 mb-3">
                                                            <label for="personal_code" class="form-label">Code personnel</label>
                                                            <input type="text" class="form-control" id="personal_code" name="personal_code" placeholder="Le nom" value="{{ old('personal_code', $admin->personal_code) }}" disabled>
                                                        </div>
                                                        <div class="col-xl-12 mb-3">
                                                            <label for="name" class="form-label">Nom</label>
                                                            <input type="text" class="form-control" id="name" name="name" placeholder="Le nom" value="{{ old('name', $admin->name) }}" disabled>
                                                        </div>
                                                        <div class="col-xl-12 mb-3">
                                                            <label for="first_name" class="form-label">Prénom.s</label>
                                                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Le.s prénom.s" value="{{ old('first_name', $admin->first_name) }}" disabled>
                                                        </div>
                                                        <div class="col-xl-12 mb-3">
                                                            <label for="email" class="form-label">Email</label>
                                                            <input type="email" class="form-control" id="email" placeholder="Email" name="L'adresse email" value="{{ $admin->email }}" disabled>
                                                        </div>
                                                        <div class="col-xl-12 mb-3">
                                                            <label for="phone" class="form-label">Numéro de téléphone</label>
                                                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Le numéro de téléphone" value="{{ $admin->phone }}" disabled>
                                                        </div>
                                                        <div class="col-xl-12 mb-3">
                                                            <label for="bio" class="form-label">Bio</label>
                                                            <textarea class="form-control" id="bio" name="bio" placeholder="La biographie" disabled>{{ $admin->bio }}</textarea>
                                                        </div>
                                                        <div class="col-xl-12 mb-3">
                                                            <label for="phone" class="form-label">Total payement</label>
                                                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Le montant total payé" value="{{ $admin->total_amount }}" disabled>
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
                                    <!-- Edit Admin -->
                                    <div class="modal fade" id="edit-admin-{{ $admin->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title">Modification d'un admin</h6>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('admin.guest.update', ['id' => $admin->id]) }}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                <div class="modal-body px-4">
                                                    <div class="row gy-2">
                                                        <div class="col-xl-12 mb-3 text-center">
                                                            <span class="avatar avatar-xxl avatar-rounded bg-primary-transparent fw-semibold">
                                                                @if (isset($admin->profile_photo))
                                                                <img src="{{ asset('storage/public/' . basename($admin->profile_photo)) }}" alt="Photo de profil">
                                                                @else
                                                                {{ substr(strtoupper($admin->name), 0, 1) }}{{ substr(strtoupper($admin->first_name), 0, 1) }}
                                                                @endif
                                                                <a href="javascript:void(0);" class="badge rounded-pill bg-primary avatar-badge">
                                                                    <input type="file" name="profile_photo" class="position-absolute w-100 h-100 op-0" id="profile_photo" accept=".jpg,.png,.jpeg">
                                                                    <i class="fe fe-camera"></i>
                                                                </a>
                                                            </span>
                                                        </div>
                                                        <div class="col-xl-12 mb-3">
                                                            <label for="name" class="form-label">Nom <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="name" name="name" placeholder="Le nom" value="{{ old('name', $admin->name) }}" required>
                                                        </div>
                                                        <div class="col-xl-12 mb-3">
                                                            <label for="first_name" class="form-label">Prénom.s <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Le.s prénom.s" value="{{ old('first_name', $admin->first_name) }}" required>
                                                        </div>
                                                        <div class="col-xl-12 mb-3">
                                                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                                            <input type="email" class="form-control" id="email" placeholder="Email" name="L'adresse email" value="{{ old('email', $admin->email) }}" disabled>
                                                        </div>
                                                        <div class="col-xl-12 mb-3">
                                                            <label for="phone" class="form-label">Numéro de téléphone <span class="text-danger">*</span></label>
                                                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Le numéro de téléphone" value="{{ old('phone', $admin->phone) }}" required>
                                                        </div>
                                                        <div class="col-xl-12 mb-3">
                                                            <label for="bio" class="form-label">Bio</label>
                                                            <textarea class="form-control" id="bio" name="bio" placeholder="La biographie">{{ old('bio', $admin->bio) }}</textarea>
                                                        </div>
                                                        @if (Auth::user()->role == 'admin')
                                                        <div class="col-xl-12 mb-3">
                                                            <label for="role" class="form-label">Rôle <span class="text-danger">*</span></label>
                                                            <select class="form-control" name="role" id="role" required>
                                                                <option value="">Choisir un rôle</option>
                                                                <option value="guest" {{ old('role') == 'guest' ? 'selected' : '' }}>Participant</option>
                                                                <option value="organizer" {{ old('role') == 'organizer' ? 'selected' : '' }}>Organisateur</option>
                                                            </select>
                                                        </div>
                                                        @endif
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
                                    <div class="modal fade" id="delete-admin-{{ $admin->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title">Supprimer un admin</h6>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('admin.guest.destroy', ['id' => $admin->id]) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                <div class="modal-body px-4">
                                                    <p class="text-center my-4">
                                                        Voulez-vous vraiment supprimer cet admin ?
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
                                        <td colspan="8">
                                            <div class="flex justify-content-center">
                                                <p class="text-center">
                                                    Aucun utilisateur enrégistré
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
<div class="modal fade" id="create-admin" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Créer un admin</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.guest.store') }}" method="post">
                @csrf
            <div class="modal-body px-4">
                <div class="row gy-2">
                    <div class="col-xl-12 mb-3">
                        <label for="name" class="form-label">Nom <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Le nom" value="{{ old('name') }}" required>
                    </div>
                    <div class="col-xl-12 mb-3">
                        <label for="first_name" class="form-label">Prénom.s <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Le.s prénom.s" value="{{ old('first_name') }}" required>
                    </div>
                    <div class="col-xl-12 mb-3">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="L'adresse email" value="{{ old('email') }}" required>
                    </div>
                    <div class="col-xl-12 mb-3">
                        <label for="phone" class="form-label">Numéro de téléphone <span class="text-danger">*</span></label>
                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="Le numéro de téléphone" value="{{ old('phone') }}" required>
                    </div>
                    <div class="col-xl-12 mb-3 d-flex justify-content-between align-items-center">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" {{ old('is_active') ? 'checked' : '' }}
                                id="is_active" name="is_active">
                            <label class="form-check-label" for="is_active">
                                <span class="fw-semibold">
                                    Compte actif
                                </span>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" {{ old('has_paid') ? 'checked' : '' }}
                                id="has_paid" name="has_paid">
                            <label class="form-check-label" for="has_paid">
                                <span class="fw-semibold">
                                    Payé
                                </span>
                            </label>
                        </div>
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

<script>

    function toggleAdminStatut(adminId) {

        let checkbox = document.getElementById('statut_' + adminId);
        let isChecked = checkbox.checked;
        const routeUrl = "{{ route('admin.guest.toggleIsActive', ['id' => 'ADMIN_ID']) }}".replace('ADMIN_ID', adminId);

        fetch(routeUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {

                let statusSpan = checkbox.nextElementSibling.nextElementSibling;
                if (isChecked) {
                    statusSpan.innerHTML = '<span class="text-success">Actif</span>';
                } else {
                    statusSpan.innerHTML = '<span class="text-danger">Inactif</span>';
                }

                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: data.message,
                    showConfirmButton: false,
                    timer: 3000
                });

            } else {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: data.message,
                    showConfirmButton: false,
                    timer: 3000
                });

                checkbox.checked = !isChecked; // Remettre la valeur initiale si erreur
            }
        })
        .catch(error => {
            Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Une erreur s\'est produite lors du changement du statut',
                    showConfirmButton: false,
                    timer: 3000
                });

            checkbox.checked = !isChecked; // Remettre la valeur initiale si erreur
        });
    }

</script>


@endsection
