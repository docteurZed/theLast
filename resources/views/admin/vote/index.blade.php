@extends('layouts.admin.app', [
    'header' => 'Catégories de votes'
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
                                        <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#create-category">
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
                                    @forelse ($categories as $category)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="fw-bold">
                                                {{ ucfirst($category->name) }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="hstack gap-2 fs-15">
                                                <a aria-label="anchor" href="javascript:void(0);" class="btn btn-icon btn-wave waves-effect waves-light btn-sm btn-primary-light" data-bs-toggle="modal" data-bs-target="#list-category-{{ $category->id }}">
                                                    <i class="ri-file-list-line"></i>
                                                </a>
                                                <a aria-label="anchor" href="javascript:void(0);" class="btn btn-icon btn-wave waves-effect waves-light btn-sm btn-info-light" data-bs-toggle="modal" data-bs-target="#show-category-{{ $category->id }}">
                                                    <i class="ri-eye-line"></i>
                                                </a>
                                                <a aria-label="anchor" href="javascript:void(0);" class="btn btn-icon btn-wave waves-effect waves-light btn-sm btn-warning-light" data-bs-toggle="modal" data-bs-target="#edit-category-{{ $category->id }}">
                                                    <i class="ri-edit-line"></i>
                                                </a>
                                                <a aria-label="anchor" href="javascript:void(0);" class="btn btn-icon btn-wave waves-effect waves-light btn-sm btn-danger-light" data-bs-toggle="modal" data-bs-target="#delete-category-{{ $category->id }}">
                                                    <i class="ri-delete-bin-6-line"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Show category -->
                                    <div class="modal fade" id="show-category-{{ $category->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title">Détail d'une catégorie</h6>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body px-4">
                                                    <div class="row gy-2">
                                                        <div class="col-xl-12 mb-3">
                                                            <label for="name" class="form-label">Nom</label>
                                                            <input type="text" class="form-control" id="name" name="name" value="{{ ucfirst($category->name) }}" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Retour</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Edit category -->
                                    <div class="modal fade" id="edit-category-{{ $category->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title">Modifier une catégorie</h6>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('admin.vote.category.update', ['id' => $category->id]) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                <div class="modal-body px-4">
                                                    <div class="row gy-2">
                                                        <div class="col-xl-12 mb-3">
                                                            <label for="name" class="form-label">Nom <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $category->name) }}" required>
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
                                    <!-- Delete category -->
                                    <div class="modal fade" id="delete-category-{{ $category->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title">Supprimer une catégorie</h6>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('admin.vote.category.destroy', ['id' => $category->id]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                <div class="modal-body px-4">
                                                    <p class="text-center my-4">
                                                        Voulez-vous vraiment supprimer cette catégorie ?
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
                                                <p class="text-center">Aucune catégorie enregistrée</p>
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

@forelse ($categories as $category)
<div class="modal fade" id="list-category-{{ $category->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Top 5 de la catégorie</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-4">
                <table class="table table-bordered">
                    <thead>
                        <th>Nom</th>
                        <th>Pénom.s</th>
                        <th>Nombre de votes</th>
                    </thead>
                    <tbody>
                        @if(isset($topCandidates[$category->id]))
                            @foreach($topCandidates[$category->id] as $candidate)
                                <tr>
                                    <td>{{ ucfirst($candidate['name']) }}</td>
                                    <td>{{ ucfirst($candidate['first_name']) }}</td>
                                    <td>{{ $candidate['votes_count'] }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3" class="text-center">Aucun candidat dans cette catégorie</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Retour</button>
            </div>
        </div>
    </div>
</div>
@empty
<div></div>
@endforelse

<!-- Create category Modal -->
<div class="modal fade" id="create-category" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Créer une catégorie</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.vote.category.store') }}" method="POST">
                @csrf
            <div class="modal-body px-4">
                <div class="row gy-2">
                    <div class="col-xl-12 mb-3">
                        <label for="name" class="form-label">Nom <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" required>
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
