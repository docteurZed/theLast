@extends('layouts.admin.app', [
    'header' => 'Programmes'
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
                                        <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#create-program">
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
                                        <th>Titre</th>
                                        <th>Heure de début</th>
                                        <th>Heure de fin</th>
                                        <th>Intervenant</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($programs as $program)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="fw-bold">
                                                {{ ucfirst($program->title) }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="fw-bold text-success">
                                                {{ \Carbon\Carbon::parse($program->starts_at)->translatedFormat('H\hi') }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="fw-bold text-danger">
                                                {{ \Carbon\Carbon::parse($program->ends_at)->translatedFormat('H\hi') }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="fw-bold text-primary">
                                                {{ ucfirst($program->speaker) }}
                                            </div>

                                        </td>
                                        <td>
                                            <div class="hstack gap-2 fs-15">
                                                <a aria-label="anchor" href="javascript:void(0);" class="btn btn-icon btn-wave waves-effect waves-light btn-sm btn-info-light" data-bs-toggle="modal" data-bs-target="#show-program-{{ $program->id }}">
                                                    <i class="ri-eye-line"></i>
                                                </a>
                                                <a aria-label="anchor" href="javascript:void(0);" class="btn btn-icon btn-wave waves-effect waves-light btn-sm btn-warning-light" data-bs-toggle="modal" data-bs-target="#edit-program-{{ $program->id }}">
                                                    <i class="ri-edit-line"></i>
                                                </a>
                                                <a aria-label="anchor" href="javascript:void(0);" class="btn btn-icon btn-wave waves-effect waves-light btn-sm btn-danger-light" data-bs-toggle="modal" data-bs-target="#delete-program-{{ $program->id }}">
                                                    <i class="ri-delete-bin-6-line"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Show Program -->
                                    <div class="modal fade" id="show-program-{{ $program->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title">Détail du programme</h6>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body px-4">
                                                    <div class="row gy-2">
                                                        <div class="col-xl-12 mb-3">
                                                            <label for="title" class="form-label">Titre</label>
                                                            <input type="text" class="form-control" id="title" name="title" value="{{ ucfirst($program->title) }}" disabled>
                                                        </div>
                                                        <div class="col-xl-12 mb-3">
                                                            <label for="starts_at" class="form-label">Heure de début</label>
                                                            <input type="text" class="form-control" id="starts_at" name="starts_at" value="{{ \Carbon\Carbon::parse($program->starts_at)->translatedFormat('H\hi') }}" disabled>
                                                        </div>
                                                        <div class="col-xl-12 mb-3">
                                                            <label for="ends_at" class="form-label">Heure de fin</label>
                                                            <input type="text" class="form-control" id="ends_at" name="ends_at" value="{{ \Carbon\Carbon::parse($program->ends_at)->translatedFormat('H\hi') }}" disabled>
                                                        </div>
                                                        <div class="col-xl-12 mb-3">
                                                            <label for="speaker" class="form-label">Intervenant</label>
                                                            <input type="text" class="form-control" id="speaker" name="speaker" value="{{ ucfirst($program->speaker) }}" disabled>
                                                        </div>
                                                        <div class="col-xl-12 mb-3">
                                                            <label for="description" class="form-label">Description</label>
                                                            <textarea class="form-control" id="description" name="description" disabled>{{ $program->description }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Retour</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Edit Program -->
                                    <div class="modal fade" id="edit-program-{{ $program->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title">Modifier le programme</h6>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('admin.event.program.update', ['id' => $program->id]) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="event_id" value="{{ $event_id }}">
                                                <div class="modal-body px-4">
                                                    <div class="row gy-2">
                                                        <div class="col-xl-12 mb-3">
                                                            <label for="title" class="form-label">Titre</label>
                                                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $program->title) }}" required>
                                                        </div>
                                                        <div class="col-xl-12 mb-3">
                                                            <label for="starts_at" class="form-label">Heure de début</label>
                                                            <input type="time" class="form-control" id="starts_at" name="starts_at" value="{{ old('starts_at', $program->starts_at) }}" required>
                                                        </div>
                                                        <div class="col-xl-12 mb-3">
                                                            <label for="ends_at" class="form-label">Heure de fin</label>
                                                            <input type="time" class="form-control" id="ends_at" name="ends_at" value="{{ old('ends_at', $program->ends_at) }}">
                                                        </div>
                                                        <div class="col-xl-12 mb-3">
                                                            <label for="speaker" class="form-label">Intervenant</label>
                                                            <input type="text" class="form-control" id="speaker" name="speaker" value="{{ old('speaker', $program->speaker) }}">
                                                        </div>
                                                        <div class="col-xl-12 mb-3">
                                                            <label for="description" class="form-label">Description</label>
                                                            <textarea class="form-control" id="description" name="description">{{ old('description', $program->description) }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Retour</button>
                                                    <button type="submit" class="btn btn-primary">Modifier</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Delete Program -->
                                    <div class="modal fade" id="delete-program-{{ $program->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title">Supprimer le programme</h6>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('admin.event.program.destroy', ['id' => $program->id]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                <div class="modal-body px-4">
                                                    <p class="text-center my-4">
                                                        Voulez-vous vraiment supprimer ce programme ?
                                                    </p>
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
                                        <td colspan="6">
                                            <div class="flex justify-content-center">
                                                <p class="text-center">Aucun programme enregistré</p>
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

<!-- Create Program Modal -->
<div class="modal fade" id="create-program" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Créer un programme</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.event.program.store') }}" method="POST">
                @csrf
                <input type="hidden" name="event_id" value="{{ $event_id }}">
            <div class="modal-body px-4">
                <div class="row gy-2">
                    <div class="col-xl-12 mb-3">
                        <label for="title" class="form-label">Titre</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="col-xl-12 mb-3">
                        <label for="starts_at" class="form-label">Heure de début</label>
                        <input type="time" class="form-control" id="starts_at" name="starts_at" required>
                    </div>
                    <div class="col-xl-12 mb-3">
                        <label for="ends_at" class="form-label">Heure de fin</label>
                        <input type="time" class="form-control" id="ends_at" name="ends_at">
                    </div>
                    <div class="col-xl-12 mb-3">
                        <label for="speaker" class="form-label">Intervenant</label>
                        <input type="text" class="form-control" id="speaker" name="speaker">
                    </div>
                    <div class="col-xl-12 mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Retour</button>
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </div>
            </form>
        </div>
    </div>
</div>

@endsection
