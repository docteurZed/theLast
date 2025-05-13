@extends('layouts.admin.app', [
    'header' => 'Témoignages'
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
                                        <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#create-testimony">
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
                                        <th>Image</th>
                                        <th>Nom</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($testimonies as $testimony)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <span class="avatar avatar-xxl avatar-rounded bg-primary-transparent fw-semibold">
                                                @if (isset($testimony->image))
                                                <img src="{{ asset('storage/public/' . basename($testimony->image)) }}" alt="Photo de profil">
                                                @else
                                                <img src="{{ asset('images/user.png') }}" alt="Photo de profil">
                                                @endif
                                            </span>
                                        </td>
                                        <td>
                                            <div class="fw-bold text-center">
                                                {{ ucfirst($testimony->name) }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="hstack gap-2 fs-15">
                                                <a aria-label="anchor" href="javascript:void(0);" class="btn btn-icon btn-wave waves-effect waves-light btn-sm btn-info-light" data-bs-toggle="modal" data-bs-target="#show-testimony-{{ $testimony->id }}">
                                                    <i class="ri-eye-line"></i>
                                                </a>
                                                <a aria-label="anchor" href="javascript:void(0);" class="btn btn-icon btn-wave waves-effect waves-light btn-sm btn-warning-light" data-bs-toggle="modal" data-bs-target="#edit-testimony-{{ $testimony->id }}">
                                                    <i class="ri-edit-line"></i>
                                                </a>
                                                <a aria-label="anchor" href="javascript:void(0);" class="btn btn-icon btn-wave waves-effect waves-light btn-sm btn-danger-light" data-bs-toggle="modal" data-bs-target="#delete-testimony-{{ $testimony->id }}">
                                                    <i class="ri-delete-bin-6-line"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- End:: Create Contact -->
                                    <div class="modal fade" id="show-testimony-{{ $testimony->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title">Détail d'un témoignage</h6>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body px-4">
                                                    <div class="row gy-2">
                                                        <div class="col-xl-12 mb-3 text-center">
                                                            <span class="avatar avatar-xxl avatar-rounded bg-primary-transparent fw-semibold">
                                                                @if (isset($testimony->image))
                                                                <img src="{{ asset('storage/public/' . basename($testimony->image)) }}" alt="Photo de profil">
                                                                @else
                                                                <img src="{{ asset('images/user.png') }}" alt="Photo de profil">
                                                                @endif
                                                            </span>
                                                        </div>
                                                        <div class="col-xl-12 mb-3">
                                                            <label for="name" class="form-label">Nom</label>
                                                            <input type="text" class="form-control" id="name" name="name" placeholder="Le nom" value="{{ ucfirst($testimony->name) }}" disabled>
                                                        </div>
                                                        <div class="col-xl-12 mb-3">
                                                            <label for="testimony" class="form-label">Témoignage</label>
                                                            <textarea class="form-control" id="testimony" name="testimony" placeholder="La testimony" disabled>{{ $testimony->testimony }}</textarea>
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
                                    <!-- Edit testimony -->
                                    <div class="modal fade" id="edit-testimony-{{ $testimony->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title">Modification d'un témoignage</h6>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('admin.testimony.update', ['id' => $testimony->id]) }}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                <div class="modal-body px-4">
                                                    <div class="row gy-2">
                                                        <div class="col-xl-12 mb-3 text-center">
                                                            <span class="avatar avatar-xxl avatar-rounded bg-primary-transparent fw-semibold">
                                                                @if (isset($testimony->image))
                                                                <img src="{{ asset('storage/public/' . basename($testimony->image)) }}" alt="Photo de profil">
                                                                @else
                                                                <img src="{{ asset('images/user.png') }}" alt="Photo de profil">
                                                                @endif
                                                                <a href="javascript:void(0);" class="badge rounded-pill bg-primary avatar-badge">
                                                                    <input type="file" name="image" class="position-absolute w-100 h-100 op-0" id="image" accept=".jpg,.png,.jpeg">
                                                                    <i class="fe fe-camera"></i>
                                                                </a>
                                                            </span>
                                                        </div>
                                                        <div class="col-xl-12 mb-3">
                                                            <label for="name" class="form-label">Nom <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="name" name="name" placeholder="Le nom" value="{{ old('name', $testimony->name) }}" required>
                                                        </div>
                                                        <div class="col-xl-12 mb-3">
                                                            <label for="testimony" class="form-label">Témoignage <span class="text-danger">*</span></label>
                                                            <textarea class="form-control" id="testimony" name="testimony" placeholder="Le témoignage" required>{{ old('testimony', $testimony->testimony) }}</textarea>
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
                                    <div class="modal fade" id="delete-testimony-{{ $testimony->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title">Supprimer un témoignage</h6>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('admin.testimony.destroy', ['id' => $testimony->id]) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                <div class="modal-body px-4">
                                                    <p class="text-center my-4">
                                                        Voulez-vous vraiment supprimer ce témoignage ?
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
                                        <td colspan="4">
                                            <div class="flex justify-content-center">
                                                <p class="text-center">
                                                    Aucun témoignage enrégistré
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

<!-- Create testimony -->
<div class="modal fade" id="create-testimony" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Créer un témoignage</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.testimony.store') }}" method="post" enctype="multipart/form-data">
                @csrf
            <div class="modal-body px-4">
                <div class="row gy-2">
                    <div class="col-xl-12 mb-3">
                        <label for="name" class="form-label">Nom <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Le nom" value="{{ old('name') }}" required>
                    </div>
                    <div class="col-xl-12 mb-3">
                        <label for="testimony" class="form-label">Témoignage <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="testimony" name="testimony" placeholder="Le témoignage" required>{{ old('testimony') }}</textarea>
                    </div>
                    <div class="col-xl-12 mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image" name="image" value="{{ old('image') }}" accept=".png,.jpg,.jpeg">
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
<!-- Create testimony -->

@endsection
