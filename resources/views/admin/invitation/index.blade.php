@extends('layouts.admin.app', [
    'header' => 'Invitation'
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
                                        <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#create-invitation">
                                            <i class="ri-add-line me-1 fw-semibold align-middle"></i>
                                            <span class="fw-bold">Générer toutes les invitations</span>
                                        </button>
                                    </div>
                                    <div class="mx-2">
                                        <a href="{{ route('admin.invitation.template') }}" class="btn btn-info me-2">
                                            <i class="ri-eye-line me-1 fw-semibold align-middle"></i>
                                            <span class="fw-bold">Voir le modèle</span>
                                        </a>
                                    </div>
                                    <div class="mx-2">
                                        <a href="" class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#send-invitation">
                                            <i class="ri-send-plane-line me-1 fw-semibold align-middle"></i>
                                            <span class="fw-bold">Envoyer toutes les invitation</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Table des invitations -->
                <div class="col-xl-12">
                    <div class="card custom-card">
                        <div class="card-body">
                            <table id="responsiveDataTable" class="table table-bordered w-100">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Evénement</th>
                                        <th>Nom</th>
                                        <th>Statut d'envoi</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($invitations as $invitation)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ ucfirst($invitation->event->name) }}</td>
                                        <td class="text-danger fw-bold">
                                            {{ ucfirst($invitation->user->first_name) }} {{ ucfirst($invitation->user->name) }}
                                        </td>
                                        <td>
                                            <div class="fw-bold">
                                                @if ($invitation->is_sent)
                                                <i class="bi bi-toggle-on mx-2 text-success"></i>
                                                <span class="text-success">Envoyé</span>
                                                @else
                                                <i class="bi bi-toggle-off mx-2 text-danger"></i>
                                                <span class="text-danger">Non envoyé</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <div class="hstack gap-2 fs-15">
                                                <a href="{{ route('admin.invitation.sendDetail', ['id' => $invitation->id]) }}" class="btn btn-icon btn-wave waves-effect waves-light btn-sm btn-info-light">
                                                    <i class="ri-send-plane-line"></i>
                                                </a>
                                                <a href="{{ route('admin.invitation.show', ['id' => $invitation->id]) }}" class="btn btn-icon btn-wave waves-effect waves-light btn-sm btn-info-light">
                                                    <i class="ri-eye-line"></i>
                                                </a>
                                                <a href="javascript:void(0);" class="btn btn-icon btn-wave waves-effect waves-light btn-sm btn-danger-light" data-bs-toggle="modal" data-bs-target="#delete-invitation-{{ $invitation->id }}">
                                                    <i class="ri-delete-bin-6-line"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Modal suppression -->
                                    <div class="modal fade" id="delete-invitation-{{ $invitation->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title">Supprimer l'entrée</h6>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('admin.invitation.destroy', ['id' => $invitation->id]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal-body px-4">
                                                        <p class="text-center my-4">Voulez-vous vraiment supprimer cette invitation ?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Retour</button>
                                                        <button type="submit" class="btn btn-danger">Confirmer</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Aucune invitation générée</td>
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

<!-- Modal de création -->
<div class="modal fade" id="create-invitation" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Créer les invitations</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.invitation.store') }}" method="POST">
                @csrf
                <div class="modal-body px-4">
                    <div class="mb-3">
                        <label for="event_id" class="form-label">Evénement <span class="text-danger">*</span></label>
                        <select id="event_id" name="event_id" class="form-control" required>
                            @foreach ($events as $event)
                            <option value="{{ $event->id }}">{{ ucfirst($event->name) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Retour</button>
                    <button type="submit" class="btn btn-primary">Générer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal de création -->
<div class="modal fade" id="send-invitation" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Envoyer les invitations</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.invitation.send') }}" method="POST">
                @csrf
                <div class="modal-body px-4">
                    <div class="mb-3">
                        <label for="event_id" class="form-label">Evénement <span class="text-danger">*</span></label>
                        <select id="event_id" name="event_id" class="form-control" required>
                            @foreach ($events as $event)
                            <option value="{{ $event->id }}">{{ ucfirst($event->name) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Retour</button>
                    <button type="submit" class="btn btn-primary">Générer</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
