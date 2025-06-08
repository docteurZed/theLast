@extends('layouts.admin.app', [
    'header' => 'Événements'
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
                                        <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#create-event">
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
                                        <th>Nom</th>
                                        <th>Date</th>
                                        <th>Lieu</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($events as $event)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="fw-bold text-primary">
                                                {{ ucfirst($event->name) }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="fw-bold text-danger">
                                                {{ ucfirst(\Carbon\Carbon::parse($event->starts_at)->translatedFormat('l \le d F Y à H:i')) }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="fw-bold">
                                                {{ ucfirst($event->location) }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="hstack gap-2 fs-15">
                                                <a href="{{ route('admin.event.program.index', ['eventId' => $event->id]) }}" class="btn btn-icon btn-wave waves-effect waves-light btn-sm btn-primary-light">
                                                    <i class="ri-file-list-line"></i>
                                                </a>
                                                <a href="{{ route('admin.event.image.index', ['eventId' => $event->id]) }}" class="btn btn-icon btn-wave waves-effect waves-light btn-sm btn-primary-light">
                                                    <i class="ri-file-image-line"></i>
                                                </a>
                                                <a href="javascript:void(0);" class="btn btn-icon btn-wave waves-effect waves-light btn-sm btn-info-light" data-bs-toggle="modal" data-bs-target="#show-event-{{ $event->id }}">
                                                    <i class="ri-eye-line"></i>
                                                </a>
                                                <a href="javascript:void(0);" class="btn btn-icon btn-wave waves-effect waves-light btn-sm btn-warning-light" data-bs-toggle="modal" data-bs-target="#edit-event-{{ $event->id }}">
                                                    <i class="ri-edit-line"></i>
                                                </a>
                                                <a href="javascript:void(0);" class="btn btn-icon btn-wave waves-effect waves-light btn-sm btn-danger-light" data-bs-toggle="modal" data-bs-target="#delete-event-{{ $event->id }}">
                                                    <i class="ri-delete-bin-6-line"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="show-event-{{ $event->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title">Détails de l'événement</h6>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body px-4">
                                                    <div class="row gy-3">
                                                        <div class="col-xl-12 mb-3">
                                                            <label for="name" class="form-label">Nom</label>
                                                            <input type="text" name="name" class="form-control" id="name"
                                                                value="{{ ucfirst($event->name) }}" disabled>
                                                        </div>
                                                        <div class="col-xl-12 mb-3">
                                                            <label for="starts_at" class="form-label">Date et heure</label>
                                                            <input type="text" name="starts_at" class="form-control" id="starts_at"
                                                                value="{{ ucfirst(\Carbon\Carbon::parse($event->starts_at)->translatedFormat('l \le d F Y à H:i')) }}"
                                                                disabled>
                                                        </div>
                                                        <div class="col-md-12 mb-3">
                                                            <label for="location" class="form-label">Lieu</label>
                                                            <input type="text" name="location" class="form-control" id="location"
                                                                value="{{ $event->location }}" disabled>
                                                        </div>
                                                        <div class="col-xl-12 mb-3">
                                                            <label for="location_latitude" class="form-label">Latitude</label>
                                                            <input type="text" name="location_latitude" class="form-control" id="location_latitude"
                                                                value="{{ $event->location_latitude }}" disabled>
                                                        </div>
                                                        <div class="col-xl-12 mb-3">
                                                            <label for="location_longitude" class="form-label">Longitude</label>
                                                            <input type="text" name="location_longitude" class="form-control" id="location_longitude"
                                                                value="{{ $event->location_longitude }}" disabled>
                                                        </div>
                                                        <div class="col-md-12 mb-3">
                                                            <label for="dress_code" class="form-label">Code vestimentaire</label>
                                                            <input type="text" name="dress_code" class="form-control" id="dress_code"
                                                                value="{{ $event->dress_code }}" disabled>
                                                        </div>
                                                        <div class="col-xl-12 mb-3">
                                                            <label for="primary_color_name" class="form-label">Couleur principale</label>
                                                            <input type="text" name="primary_color_name" class="form-control" id="primary_color_name"
                                                                value="{{ $event->primary_color_name }}" disabled>
                                                        </div>
                                                        <div class="col-xl-12 mb-3">
                                                            <label for="primary_color_hex" class="form-label">Code hexadécimal</label>
                                                            <input type="color" name="primary_color_hex" class="form-control form-control-color" id="primary_color_hex"
                                                                value="{{ $event->primary_color_hex }}" disabled>
                                                        </div>
                                                        @isset($event->secondary_color_name)
                                                        <div class="col-xl-12 mb-3">
                                                            <label for="secondary_color_name" class="form-label">Couleur secondaire</label>
                                                            <input type="text" name="secondary_color_name" class="form-control" id="secondary_color_name"
                                                                value="{{ $event->secondary_color_name }}" disabled>
                                                        </div>
                                                        @endisset
                                                        @isset($event->secondary_color_hex)
                                                        <div class="col-xl-12 mb-3">
                                                            <label for="secondary_color_hex" class="form-label">Code hexadécimal</label>
                                                            <input type="color" name="secondary_color_hex" class="form-control form-control-color" id="secondary_color_hex"
                                                                value="{{ $event->secondary_color_hex }}" disabled>
                                                        </div>
                                                        @endisset
                                                        @isset($event->primary_image)
                                                        <div class="col-xl-12 mb-3">
                                                            <label for="primary_image" class="form-label">Image principale</label>
                                                            <div>
                                                                <img src="{{ $event->primary_image }}" class="img-thumbnail mt-2" width="150">
                                                            </div>
                                                        </div>
                                                        @endisset
                                                        @isset($event->secondary_image)
                                                        <div class="col-xl-12 mb-3">
                                                            <label for="secondary_image" class="form-label">Image secondaire</label>
                                                            <div>
                                                                <img src="{{ $event->secondary_image }}" class="img-thumbnail mt-2" width="150">
                                                            </div>
                                                        </div>
                                                        @endisset
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="edit-event-{{ $event->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <form action="{{ route('admin.event.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header">
                                                        <h6 class="modal-title">Modifier un événement</h6>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body px-4">
                                                        <div class="row gy-3">
                                                            <div class="col-xl-12 mb-3">
                                                                <label for="name" class="form-label">Nom <span class="text-danger">*</span></label>
                                                                <input type="text" name="name" class="form-control" id="name"
                                                                    value="{{ old('name', $event->name) }}" required>
                                                            </div>
                                                            <div class="col-xl-12 mb-3">
                                                                <label for="starts_at" class="form-label">Date et heure <span class="text-danger">*</span></label>
                                                                <input type="datetime-local" name="starts_at" class="form-control" id="starts_at"
                                                                    value="{{ old('starts_at', $event->starts_at) }}"
                                                                    required>
                                                            </div>
                                                            <div class="col-md-12 mb-3">
                                                                <label for="location" class="form-label">Lieu <span class="text-danger">*</span></label>
                                                                <input type="text" name="location" class="form-control" id="location"
                                                                    value="{{ old('location', $event->location) }}" required>
                                                            </div>
                                                            <div class="col-xl-12 mb-3">
                                                                <label for="location_latitude" class="form-label">Latitude</label>
                                                                <input type="text" name="location_latitude" class="form-control" id="location_latitude"
                                                                    value="{{ old('location_latitude', $event->location_latitude) }}">
                                                            </div>
                                                            <div class="col-xl-12 mb-3">
                                                                <label for="location_longitude" class="form-label">Longitude</label>
                                                                <input type="text" name="location_longitude" class="form-control" id="location_longitude"
                                                                    value="{{ old('location_longitude', $event->location_longitude) }}">
                                                            </div>
                                                            <div class="col-md-12 mb-3">
                                                                <label for="dress_code" class="form-label">Code vestimentaire <span class="text-danger">*</span></label>
                                                                <input type="text" name="dress_code" class="form-control" id="dress_code"
                                                                    value="{{ old('dress_code', $event->dress_code) }}" required>
                                                            </div>
                                                            <div class="col-xl-12 mb-3">
                                                                <label for="primary_color_name" class="form-label">Couleur principale <span class="text-danger">*</span></label>
                                                                <input type="text" name="primary_color_name" class="form-control" id="primary_color_name"
                                                                    value="{{ old('primary_color_name', $event->primary_color_name) }}" required>
                                                            </div>
                                                            <div class="col-xl-12 mb-3">
                                                                <label for="primary_color_hex" class="form-label">Code hexadécimal <span class="text-danger">*</span></label>
                                                                <input type="color" name="primary_color_hex" class="form-control form-control-color" id="primary_color_hex"
                                                                    value="{{ old('primary_color_hex', $event->primary_color_hex) }}" required>
                                                            </div>
                                                            <div class="col-xl-12 mb-3">
                                                                <label for="secondary_color_name" class="form-label">Couleur secondaire</label>
                                                                <input type="text" name="secondary_color_name" class="form-control" id="secondary_color_name"
                                                                    value="{{ old('secondary_color_name', $event->secondary_color_name) }}">
                                                            </div>
                                                            <div class="col-xl-12 mb-3">
                                                                <label for="secondary_color_hex" class="form-label">Code hexadécimal</label>
                                                                <input type="color" name="secondary_color_hex" class="form-control form-control-color" id="secondary_color_hex"
                                                                    value="{{ old('secondary_color_hex', $event->secondary_color_hex) }}">
                                                            </div>
                                                            <div class="col-xl-12 mb-3">
                                                                <label for="primary_image" class="form-label">Image principale <span class="text-danger">*</span></label>
                                                                <input type="file" name="primary_image" class="form-control" id="primary_image"
                                                                    @if (!isset($event)) required @endif>
                                                                @isset($event->primary_image)
                                                                    <div>
                                                                        <img src="{{ $event->primary_image }}" class="img-thumbnail mt-2" width="150">
                                                                    </div>
                                                                @endisset
                                                            </div>
                                                            <div class="col-xl-12 mb-3">
                                                                <label for="secondary_image" class="form-label">Image secondaire</label>
                                                                <input type="file" name="secondary_image" class="form-control" id="secondary_image">
                                                                @isset($event->secondary_image)
                                                                    <div>
                                                                        <img src="{{ $event->secondary_image }}" class="img-thumbnail mt-2" width="150">
                                                                    </div>
                                                                @endisset
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
                                    <div class="modal fade" id="delete-event-{{ $event->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <form action="{{ route('admin.event.destroy', $event->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal-header">
                                                        <h6 class="modal-title">Supprimer l'événement</h6>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body px-4">
                                                        <p class="text-center">Voulez-vous vraiment supprimer cet événement ?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler</button>
                                                        <button type="submit" class="btn btn-danger">Supprimer</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Aucun événement enregistré</td>
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

<!-- Create event -->
<div class="modal fade" id="create-event" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('admin.event.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h6 class="modal-title">Créer un événement</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body px-4">
                    <div class="row gy-3">
                        <div class="col-xl-12">
                            <label for="name" class="form-label">Nom <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" id="name"
                                value="{{ old('name') }}" required>
                        </div>
                        <div class="col-xl-12">
                            <label for="starts_at" class="form-label">Date et heure <span class="text-danger">*</span></label>
                            <input type="datetime-local" name="starts_at" class="form-control" id="starts_at"
                                value="{{ old('starts_at', isset($event->starts_at)) }}"
                                required>
                        </div>
                        <div class="col-md-12">
                            <label for="location" class="form-label">Lieu <span class="text-danger">*</span></label>
                            <input type="text" name="location" class="form-control" id="location"
                                value="{{ old('location') }}" required>
                        </div>
                        <div class="col-xl-12">
                            <label for="location_latitude" class="form-label">Latitude</label>
                            <input type="text" name="location_latitude" class="form-control" id="location_latitude"
                                value="{{ old('location_latitude') }}">
                        </div>
                        <div class="col-xl-12">
                            <label for="location_longitude" class="form-label">Longitude</label>
                            <input type="text" name="location_longitude" class="form-control" id="location_longitude"
                                value="{{ old('location_longitude') }}">
                        </div>
                        <div class="col-md-12">
                            <label for="dress_code" class="form-label">Code vestimentaire <span class="text-danger">*</span></label>
                            <input type="text" name="dress_code" class="form-control" id="dress_code"
                                value="{{ old('dress_code') }}" required>
                        </div>
                        <div class="col-xl-12">
                            <label for="primary_color_name" class="form-label">Couleur principale <span class="text-danger">*</span></label>
                            <input type="text" name="primary_color_name" class="form-control" id="primary_color_name"
                                value="{{ old('primary_color_name') }}" required>
                        </div>
                        <div class="col-xl-12">
                            <label for="primary_color_hex" class="form-label">Code hexadécimal <span class="text-danger">*</span></label>
                            <input type="color" name="primary_color_hex" class="form-control form-control-color" id="primary_color_hex"
                                value="{{ old('primary_color_hex', '#ffffff') }}" required>
                        </div>
                        <div class="col-xl-12">
                            <label for="secondary_color_name" class="form-label">Couleur secondaire</label>
                            <input type="text" name="secondary_color_name" class="form-control" id="secondary_color_name"
                                value="{{ old('secondary_color_name') }}">
                        </div>
                        <div class="col-xl-12">
                            <label for="secondary_color_hex" class="form-label">Code hexadécimal</label>
                            <input type="color" name="secondary_color_hex" class="form-control form-control-color" id="secondary_color_hex"
                                value="{{ old('secondary_color_hex') }}">
                        </div>
                        <div class="col-xl-12">
                            <label for="primary_image" class="form-label">Image principale <span class="text-danger">*</span></label>
                            <input type="file" name="primary_image" class="form-control" id="primary_image" required>
                        </div>
                        <div class="col-xl-12">
                            <label for="secondary_image" class="form-label">Image secondaire</label>
                            <input type="file" name="secondary_image" class="form-control" id="secondary_image">
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
