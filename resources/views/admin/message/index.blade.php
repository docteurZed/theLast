@extends('layouts.admin.app', [
    'header' => 'Message'
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
                                        {{-- <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#create-message">
                                            <i class="ri-add-line me-1 fw-semibold align-middle"></i>
                                            <span class="fw-bold">Ajouter</span>
                                        </button> --}}
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
                                        <th>Nom</th>
                                        <th>Numéro de téléphone</th>
                                        <th>Email</th>
                                        <th>Statut</th>
                                        <th>Date d'envoi</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($messages as $message)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="fw-bold text-center text-primary">
                                                {{ ucfirst($message->name) }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="fw-bold text-center">
                                                {{ $message->phone }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="fw-bold text-center text-danger">
                                                {{ $message->email }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-toggle-switch d-flex align-items-center">
                                                <input id="statut_{{ $message->id }}" data-admin-id="{{ $message->id }}" name="statut" type="checkbox"
                                                    @if($message->has_read) checked @endif onchange="messageReadStatus({{ $message->id }})">
                                                <label for="statut_{{ $message->id }}" class="label-success"></label>
                                                <span class="ms-3 fw-semibold">
                                                    @if($message->has_read)
                                                        <span class="text-success">Lu</span>
                                                    @else
                                                        <span class="text-danger">Non lu</span>
                                                    @endif
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="fw-bold text-center">
                                                {{ $message->relative_created_at }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="hstack gap-2 fs-15">
                                                <a aria-label="anchor" href="javascript:void(0);" class="btn btn-icon btn-wave waves-effect waves-light btn-sm btn-info-light" data-bs-toggle="modal" data-bs-target="#show-message-{{ $message->id }}" onclick="messageReadStatus({{ $message->id }})">
                                                    <i class="ri-eye-line"></i>
                                                </a>
                                                <a aria-label="anchor" href="javascript:void(0);" class="btn btn-icon btn-wave waves-effect waves-light btn-sm btn-danger-light" data-bs-toggle="modal" data-bs-target="#delete-message-{{ $message->id }}">
                                                    <i class="ri-delete-bin-6-line"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Edit Admin -->
                                    <div class="modal fade" id="show-message-{{ $message->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title">Détail d'un message</h6>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body px-4">
                                                    <div class="row gy-2">
                                                        <div class="col-xl-12 mb-3">
                                                            <label for="name" class="form-label">Nom et prénom.s</label>
                                                            <input type="text" class="form-control" id="amount" name="name" value="{{ ucfirst($message->name) }}" disabled>
                                                        </div>
                                                        <div class="col-xl-12 mb-3">
                                                            <label for="phone" class="form-label">Numéro de téléphone</label>
                                                            <input type="text" class="form-control" id="phone" name="phone" value="{{ $message->phone }}" disabled>
                                                        </div>
                                                        <div class="col-xl-12 mb-3">
                                                            <label for="email" class="form-label">Email</label>
                                                            <input type="text" class="form-control" id="email" name="email" value="{{ $message->email }}" disabled>
                                                        </div>
                                                        <div class="col-xl-12 mb-3">
                                                            <label for="message" class="form-label">Message</label>
                                                            <textarea class="form-control" id="message" name="message" disabled>{{ $message->message }}</textarea>
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
                                    <!-- Delete ClientType -->
                                    <div class="modal fade" id="delete-message-{{ $message->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title">Supprimer un message</h6>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('admin.message.destroy', ['id' => $message->id]) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                <div class="modal-body px-4">
                                                    <p class="text-center my-4">
                                                        Voulez-vous vraiment supprimer ce message ?
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
                                        <td colspan="7">
                                            <div class="flex justify-content-center">
                                                <p class="text-center">
                                                    Aucun message enrégistré
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

<script>

    function messageReadStatus(adminId) {

        let checkbox = document.getElementById('statut_' + adminId);
        let isChecked = checkbox.checked;
        const routeUrl = "{{ route('admin.message.updateStatut', ['id' => 'ADMIN_ID']) }}".replace('ADMIN_ID', adminId);

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
                    statusSpan.innerHTML = '<span class="text-success">Lu</span>';
                } else {
                    statusSpan.innerHTML = '<span class="text-danger">Non lu</span>';
                }

                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: data.message,
                    showConfirmButton: false,
                    timer: 3000
                });

            } else {
                checkbox.checked = true; // Remettre la valeur initiale si erreur
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
