@extends('layouts.admin.app', [
    'header' => 'Slides'
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
                                        <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#create-slide">
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
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($slides as $slide)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="fw-bold">
                                                {{ $slide->name ? ucfirst($slide->name) : 'Aucun nom enrégistré' }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="hstack gap-2 fs-15">
                                                <a aria-label="anchor" href="javascript:void(0);" class="btn btn-icon btn-wave waves-effect waves-light btn-sm btn-info-light" data-bs-toggle="modal" data-bs-target="#show-slide-{{ $slide->id }}">
                                                    <i class="ri-eye-line"></i>
                                                </a>
                                                <a aria-label="anchor" href="javascript:void(0);" class="btn btn-icon btn-wave waves-effect waves-light btn-sm btn-warning-light" data-bs-toggle="modal" data-bs-target="#edit-slide-{{ $slide->id }}">
                                                    <i class="ri-edit-line"></i>
                                                </a>
                                                <a aria-label="anchor" href="javascript:void(0);" class="btn btn-icon btn-wave waves-effect waves-light btn-sm btn-danger-light" data-bs-toggle="modal" data-bs-target="#delete-slide-{{ $slide->id }}">
                                                    <i class="ri-delete-bin-6-line"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Show slide -->
                                    <div class="modal fade" id="show-slide-{{ $slide->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title">Détail d'une slide</h6>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body px-4">
                                                    <div class="row gy-2">
                                                        <div class="col-xl-12 mb-3">
                                                            <label for="name" class="form-label">Nom</label>
                                                            <input type="text" class="form-control" id="name" name="name" value="{{ ucfirst($slide->name) }}" disabled>
                                                        </div>
                                                        <div class="col-xl-12 mb-3">
                                                            <label for="name" class="form-label">Image</label>
                                                            <div class="mt-3">
                                                                <img src="{{ asset('storage/public/' . basename($slide->image)) }}" alt="slide" width="150">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Retour</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Edit slide -->
                                    <div class="modal fade" id="edit-slide-{{ $slide->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title">Modifier une slide</h6>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('admin.slide.update', ['id' => $slide->id]) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                <div class="modal-body px-4">
                                                    <div class="row gy-2">
                                                        <div class="col-xl-12 mb-3">
                                                            <label for="name" class="form-label">Nom</label>
                                                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $slide->name) }}">
                                                        </div>
                                                        <div class="col-xl-12 mb-3">
                                                            <label for="image" class="form-label">Image <span class="text-danger">*</span></label>
                                                            <input type="file" class="form-control" id="image" name="image" value="{{ old('image', $slide->image) }}" required accept=".png,.jpg,.jpeg">
                                                        </div>
                                                        <div class="mt-3">
                                                            <img src="{{ asset('storage/public/' . basename($slide->image)) }}" alt="slide" width="150">
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
                                    <!-- Delete slide -->
                                    <div class="modal fade" id="delete-slide-{{ $slide->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title">Supprimer une slide</h6>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('admin.slide.destroy', ['id' => $slide->id]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                <div class="modal-body px-4">
                                                    <p class="text-center my-4">
                                                        Voulez-vous vraiment supprimer cette slide ?
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
                                        <td colspan="3">
                                            <div class="flex justify-content-center">
                                                <p class="text-center">Aucune slide enregistrée</p>
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

<!-- Create slide Modal -->
<div class="modal fade" id="create-slide" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Créer une slide</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.slide.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="modal-body px-4">
                <div class="row gy-2">
                    <div class="col-xl-12 mb-3">
                        <label for="name" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="col-xl-12 mb-3">
                        <label for="image" class="form-label">Image <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" id="image" name="image" value="{{ old('image') }}" required accept=".png,.jpg,.jpeg">
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
