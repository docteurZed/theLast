@extends('layouts.admin.app', [
    'header' => 'Tâches',
])

@section('content')

<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-body p-0">
                <div class="d-flex p-3 align-items-center justify-content-between">
                    <div>
                        <button class="btn btn-primary d-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#addtask">
                            <i class="ri-add-line fs-16 align-middle me-1"></i> Ajouter
                        </button>
                    </div>
                    <div>
                        <ul class="nav nav-tabs nav-tabs-header mb-0 d-sm-flex d-block" role="tablist">
                            <li class="nav-item m-1">
                                <a class="nav-link active" data-bs-toggle="tab" role="tab" aria-current="page"
                                href="#all-tasks" aria-selected="true">Toutes</a>
                            </li>
                            <li class="nav-item m-1">
                                <a class="nav-link" data-bs-toggle="tab" role="tab" aria-current="page"
                                href="#pending" aria-selected="true">En attente</a>
                            </li>
                            <li class="nav-item m-1">
                                <a class="nav-link" data-bs-toggle="tab" role="tab" aria-current="page"
                                href="#in-progress" aria-selected="true">En cours</a>
                            </li>
                            <li class="nav-item m-1">
                                <a class="nav-link" data-bs-toggle="tab" role="tab" aria-current="page"
                                href="#completed" aria-selected="true">Terminé</a>
                            </li>
                        </ul>
                    </div>
                    <div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-content task-tabs-container">
        <div class="tab-pane show active p-0" id="all-tasks"
            role="tabpanel">
            <div class="row" id="tasks-container">
                @forelse ($tasks as $task)

                @php
                    $color = null;
                    switch ($task->priority) {
                        case 'low':
                            $color = 'secondary';
                            break;
                        case 'medium':
                            $color = 'primary';
                            break;
                        case 'high':
                            $color = 'warning';
                            break;
                        case 'critical':
                            $color = 'danger';
                            break;
                    }
                @endphp


                <div class="col-xl-4">
                    <div class="card custom-card border border-{{ $color }}">
                        <div class="card-body p-0">
                            <div class="p-3 kanban-board-head">
                                <div class="d-flex text-muted justify-content-between mb-1 fs-12 fw-semibold">
                                    <div class="text-dark">Créé par - {{ $task->user->id == Auth::user()->id ? 'Vous' : $task->user->first_name . ' ' . $task->user->name }}</div>
                                    <div>{{ $task->relative_created_at }}</div>
                                </div>
                                <div class="d-flex align-items-center justify-content-end">
                                    <div class="dropdown">
                                        <a aria-label="anchor" href="javascript:void(0);" class="btn btn-icon btn-sm btn-light" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fe fe-more-vertical"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item" href="{{ route('admin.task.detail', ['id' => $task->id]) }}"><i class="ri-eye-line me-1 align-middle d-inline-block"></i>Voir</a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#editTask-{{ $task->id }}"><i class="ri-edit-line me-1 align-middle d-inline-block"></i>Editer</a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#deleteTask-{{ $task->id }}"><i class="ri-delete-bin-line me-1 align-middle d-inline-block"></i>Supprimer</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="kanban-content mt-2">
                                    @if ($task->image)
                                    <div class="task-image mt-2">
                                        <img src="{{ asset('storage/public/' . basename($task->image)) }}" class="img-fluid rounded kanban-image" alt="">
                                    </div>
                                    @endif
                                    <h6 class="fw-semibold mb-1 fs-15 mt-2">{{ $task->first_name . ' ' . $task->name }}</h6>
                                    @if ($task->description)
                                    <div class="kanban-task-description">{{ Str::limit($task->description, 50) }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="p-3 border-top border-{{ $color }}">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        @switch($task->statut)
                                            @case('in_progress')
                                                <span class="badge bg-warning text-light px-3 py-2">En cours</span>
                                                @break
                                            @case('completed')
                                                <span class="badge bg-success text-light px-3 py-2">Terminé</span>
                                                @break
                                            @default
                                                <span class="badge bg-danger text-light px-3 py-2">En attente</span>
                                        @endswitch
                                    </div>
                                    <div class="avatar-list-stacked">
                                        @foreach ($task->users as $user)
                                        <span class="avatar avatar-sm avatar-rounded bg-primary-transparent fw-semibold">
                                            @if ($user->profile_photo)
                                            <img src="{{ asset('storage/public/' . basename($user->profile_photo)) }}" alt="Photo de profil">
                                            @else
                                            {{ substr(strtoupper($user->first_name), 0, 1) }}{{ substr(strtoupper($user->name), 0, 1) }}
                                            @endif
                                        </span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="editTask-{{ $task->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="modal-title" id="mail-ComposeLabel">Modifier une tâche</h6>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="{{ route('admin.task.update', ['id' => $task->id]) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="modal-body px-4">
                                    <div class="row gy-2">
                                        <div class="col-xl-6">
                                            <label for="name" class="form-label">Nom <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Nom de la tâche" value="{{ old('name', $task->name) }}" required>
                                        </div>
                                        <div class="col-xl-6">
                                            <label class="form-label" for="userIds">Assigné à <span class="text-danger">*</span></label>
                                            <select class="form-control" name="userIds[]" id="userIds" multiple required>
                                                <option value="">Choisir une option</option>
                                                @forelse ($users as $user)
                                                <option value="{{ $user->id }}" {{ $task->users->contains($user->id) ? 'selected' : '' }}>{{ $user->first_name }} {{ $user->name }}</option>
                                                @empty
                                                <option value="">Aucun utilisateur enrégistré</option>
                                                @endforelse
                                            </select>
                                        </div>
                                        <div class="col-xl-6">
                                            <label class="form-label" for="due_date">Deadline</label>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-text text-muted"> <i class="ri-calendar-line"></i> </div>
                                                    <input type="date" class="form-control" id="due_date" name="due_date" placeholder="Sélectionnez un deadline" value="{{ old('due_date', $task->due_date) }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <label class="form-label">Priorité <span class="text-danger">*</span></label>
                                            <select class="form-control" id="choices-single-default" name="priority">
                                                <option value="">Choisir une option</option>
                                                <option value="critical" {{ old('priority', $task->priority) == 'critical' ? 'selected' : '' }}>Critique</option>
                                                <option value="high" {{ old('priority', $task->priority) == 'high' ? 'selected' : '' }}>Elevé</option>
                                                <option value="medium" {{ old('priority', $task->priority) == 'medium' ? 'selected' : '' }}>Moyen</option>
                                                <option value="low" {{ old('priority', $task->priority) == 'low' ? 'selected' : '' }}>Faible</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-12">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control" id="description" name="description" placeholder="Description de la tâche">{{ old('description', $task->description) }}</textarea>
                                        </div>
                                        <div class="col-xl-12">
                                            <label for="image" class="form-label">Image</label>
                                            <input type="file" class="form-control" id="image" name="image" placeholder="L'image de la tâche" accept=".jpg,.jpeg,.png">
                                            @if ($task->image)
                                            <div class="d-flex justify-content-center mt-3">
                                                <img src="{{ asset('storage/public/' . basename($task->image)) }}" alt="Image">
                                            </div>
                                            @endif
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
                <div class="modal fade" id="deleteTask-{{ $task->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="modal-title" id="mail-ComposeLabel">Modifier une tâche</h6>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="{{ route('admin.task.destroy', ['id' => $task->id]) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('DELETE')
                                <div class="modal-body px-4">
                                    <div class="row gy-2">
                                        <p class="text-center my-4">
                                            Voulez-vous vraiment supprimer cette tâche ?
                                        </p>
                                    </div>
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
                @empty
                <div class="col-xl-12 my-5 py-5 d-flex justify-content-center align-items-center text-muted">
                    Aucune tâche enrégistrée
                </div>
                @endforelse
            </div>
        </div>
        <div class="tab-pane p-0" id="pending"
            role="tabpanel">
            <div class="row">
                @forelse ($pendingTasks as $task)

                @php
                    $color = null;
                    switch ($task->priority) {
                        case 'low':
                            $color = 'secondary';
                            break;
                        case 'medium':
                            $color = 'primary';
                            break;
                        case 'high':
                            $color = 'warning';
                            break;
                        case 'critical':
                            $color = 'danger';
                            break;
                    }
                @endphp


                <div class="col-xl-4">
                    <div class="card custom-card border border-{{ $color }}">
                        <div class="card-body p-0">
                            <div class="p-3 kanban-board-head">
                                <div class="d-flex text-muted justify-content-between mb-1 fs-12 fw-semibold">
                                    <div class="text-dark">Créé par - {{ $task->user->id == Auth::user()->id ? 'Vous' : $task->user->name }}</div>
                                    <div>{{ $task->relative_created_at }}</div>
                                </div>
                                <div class="d-flex align-items-center justify-content-end">
                                    <div class="dropdown">
                                        <a aria-label="anchor" href="javascript:void(0);" class="btn btn-icon btn-sm btn-light" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fe fe-more-vertical"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item" href="{{ route('admin.task.detail', ['id' => $task->id]) }}"><i class="ri-eye-line me-1 align-middle d-inline-block"></i>Voir</a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#editTask-{{ $task->id }}"><i class="ri-edit-line me-1 align-middle d-inline-block"></i>Editer</a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#deleteTask-{{ $task->id }}"><i class="ri-delete-bin-line me-1 align-middle d-inline-block"></i>Supprimer</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="kanban-content mt-2">
                                    @if ($task->image)
                                    <div class="task-image mt-2">
                                        <img src="{{ asset('storage/public/' . basename($task->image)) }}" class="img-fluid rounded kanban-image" alt="">
                                    </div>
                                    @endif
                                    <h6 class="fw-semibold mb-1 fs-15 mt-2">{{ $task->first_name . ' ' . $task->name }}</h6>
                                    @if ($task->description)
                                    <div class="kanban-task-description">{{ Str::limit($task->description, 50) }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="p-3 border-top border-{{ $color }}">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        @switch($task->statut)
                                            @case('in_progress')
                                                <span class="badge bg-warning text-light px-3 py-2">En cours</span>
                                                @break
                                            @case('completed')
                                                <span class="badge bg-success text-light px-3 py-2">Terminé</span>
                                                @break
                                            @default
                                                <span class="badge bg-danger text-light px-3 py-2">En attente</span>
                                        @endswitch
                                    </div>
                                    <div class="avatar-list-stacked">
                                        @foreach ($task->users as $user)
                                        <span class="avatar avatar-sm avatar-rounded bg-primary-transparent fw-semibold">
                                            @if ($user->profile_photo)
                                            <img src="{{ asset('storage/public/' . basename($user->profile_photo)) }}" alt="Photo de profil">
                                            @else
                                            {{ substr(strtoupper($user->first_name), 0, 1) }}{{ substr(strtoupper($user->name), 0, 1) }}
                                            @endif
                                        </span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="editTask-{{ $task->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="modal-title" id="mail-ComposeLabel">Modifier une tâche</h6>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="{{ route('admin.task.update', ['id' => $task->id]) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="modal-body px-4">
                                    <div class="row gy-2">
                                        <div class="col-xl-6">
                                            <label for="name" class="form-label">Nom <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Nom de la tâche" value="{{ old('name', $task->name) }}" required>
                                        </div>
                                        <div class="col-xl-6">
                                            <label class="form-label" for="userIds">Assigné à <span class="text-danger">*</span></label>
                                            <select class="form-control" name="userIds[]" id="userIds" multiple required>
                                                <option value="">Choisir une option</option>
                                                @forelse ($users as $user)
                                                <option value="{{ $user->id }}" {{ $task->users->contains($user->id) ? 'selected' : '' }}>{{ $user->first_name }} {{ $user->name }}</option>
                                                @empty
                                                <option value="">Aucun utilisateur enrégistré</option>
                                                @endforelse
                                            </select>
                                        </div>
                                        <div class="col-xl-6">
                                            <label class="form-label" for="due_date">Deadline</label>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-text text-muted"> <i class="ri-calendar-line"></i> </div>
                                                    <input type="date" class="form-control" id="due_date" name="due_date" placeholder="Sélectionnez un deadline" value="{{ old('due_date', $task->due_date) }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <label class="form-label">Priorité <span class="text-danger">*</span></label>
                                            <select class="form-control" id="choices-single-default" name="priority">
                                                <option value="">Choisir une option</option>
                                                <option value="critical" {{ old('priority', $task->priority) == 'critical' ? 'selected' : '' }}>Critique</option>
                                                <option value="high" {{ old('priority', $task->priority) == 'high' ? 'selected' : '' }}>Elevé</option>
                                                <option value="medium" {{ old('priority', $task->priority) == 'medium' ? 'selected' : '' }}>Moyen</option>
                                                <option value="low" {{ old('priority', $task->priority) == 'low' ? 'selected' : '' }}>Faible</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-12">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control" id="description" name="description" placeholder="Description de la tâche">{{ old('description', $task->description) }}</textarea>
                                        </div>
                                        <div class="col-xl-12">
                                            <label for="image" class="form-label">Image</label>
                                            <input type="file" class="form-control" id="image" name="image" placeholder="L'image de la tâche" accept=".jpg,.jpeg,.png">
                                            @if ($task->image)
                                            <div class="d-flex justify-content-center mt-3">
                                                <img src="{{ asset('storage/public/' . basename($task->image)) }}" alt="Image">
                                            </div>
                                            @endif
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
                <div class="modal fade" id="deleteTask-{{ $task->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="modal-title" id="mail-ComposeLabel">Modifier une tâche</h6>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="{{ route('admin.task.destroy', ['id' => $task->id]) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('DELETE')
                                <div class="modal-body px-4">
                                    <div class="row gy-2">
                                        <p class="text-center my-4">
                                            Voulez-vous vraiment supprimer cette tâche ?
                                        </p>
                                    </div>
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
                @empty
                <div class="col-xl-12 my-5 py-5 d-flex justify-content-center align-items-center text-muted">
                    Aucune tâche enrégistrée
                </div>
                @endforelse
            </div>
        </div>
        <div class="tab-pane p-0" id="in-progress"
            role="tabpanel">
            <div class="row">
                @forelse ($progressTasks as $task)

                @php
                    $color = null;
                    switch ($task->priority) {
                        case 'low':
                            $color = 'secondary';
                            break;
                        case 'medium':
                            $color = 'primary';
                            break;
                        case 'high':
                            $color = 'warning';
                            break;
                        case 'critical':
                            $color = 'danger';
                            break;
                    }
                @endphp


                <div class="col-xl-4">
                    <div class="card custom-card border border-{{ $color }}">
                        <div class="card-body p-0">
                            <div class="p-3 kanban-board-head">
                                <div class="d-flex text-muted justify-content-between mb-1 fs-12 fw-semibold">
                                    <div class="text-dark">Créé par - {{ $task->user->id == Auth::user()->id ? 'Vous' : $task->user->name }}</div>
                                    <div>{{ $task->relative_created_at }}</div>
                                </div>
                                <div class="d-flex align-items-center justify-content-end">
                                    <div class="dropdown">
                                        <a aria-label="anchor" href="javascript:void(0);" class="btn btn-icon btn-sm btn-light" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fe fe-more-vertical"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item" href="{{ route('admin.task.detail', ['id' => $task->id]) }}"><i class="ri-eye-line me-1 align-middle d-inline-block"></i>Voir</a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#editTask-{{ $task->id }}"><i class="ri-edit-line me-1 align-middle d-inline-block"></i>Editer</a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#deleteTask-{{ $task->id }}"><i class="ri-delete-bin-line me-1 align-middle d-inline-block"></i>Supprimer</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="kanban-content mt-2">
                                    @if ($task->image)
                                    <div class="task-image mt-2">
                                        <img src="{{ asset('storage/public/' . basename($task->image)) }}" class="img-fluid rounded kanban-image" alt="">
                                    </div>
                                    @endif
                                    <h6 class="fw-semibold mb-1 fs-15 mt-2">{{ $task->first_name . ' ' . $task->name }}</h6>
                                    @if ($task->description)
                                    <div class="kanban-task-description">{{ Str::limit($task->description, 50) }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="p-3 border-top border-{{ $color }}">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        @switch($task->statut)
                                            @case('in_progress')
                                                <span class="badge bg-warning text-light px-3 py-2">En cours</span>
                                                @break
                                            @case('completed')
                                                <span class="badge bg-success text-light px-3 py-2">Terminé</span>
                                                @break
                                            @default
                                                <span class="badge bg-danger text-light px-3 py-2">En attente</span>
                                        @endswitch
                                    </div>
                                    <div class="avatar-list-stacked">
                                        @foreach ($task->users as $user)
                                        <span class="avatar avatar-sm avatar-rounded bg-primary-transparent fw-semibold">
                                            @if ($user->profile_photo)
                                            <img src="{{ asset('storage/public/' . basename($user->profile_photo)) }}" alt="Photo de profil">
                                            @else
                                            {{ substr(strtoupper($user->first_name), 0, 1) }}{{ substr(strtoupper($user->name), 0, 1) }}
                                            @endif
                                        </span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="editTask-{{ $task->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="modal-title" id="mail-ComposeLabel">Modifier une tâche</h6>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="{{ route('admin.task.update', ['id' => $task->id]) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="modal-body px-4">
                                    <div class="row gy-2">
                                        <div class="col-xl-6">
                                            <label for="name" class="form-label">Nom <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Nom de la tâche" value="{{ old('name', $task->name) }}" required>
                                        </div>
                                        <div class="col-xl-6">
                                            <label class="form-label" for="userIds">Assigné à <span class="text-danger">*</span></label>
                                            <select class="form-control" name="userIds[]" id="userIds" multiple required>
                                                <option value="">Choisir une option</option>
                                                @forelse ($users as $user)
                                                <option value="{{ $user->id }}" {{ $task->users->contains($user->id) ? 'selected' : '' }}>{{ $user->first_name }} {{ $user->name }}</option>
                                                @empty
                                                <option value="">Aucun utilisateur enrégistré</option>
                                                @endforelse
                                            </select>
                                        </div>
                                        <div class="col-xl-6">
                                            <label class="form-label" for="due_date">Deadline</label>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-text text-muted"> <i class="ri-calendar-line"></i> </div>
                                                    <input type="date" class="form-control" id="due_date" name="due_date" placeholder="Sélectionnez un deadline" value="{{ old('due_date', $task->due_date) }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <label class="form-label">Priorité <span class="text-danger">*</span></label>
                                            <select class="form-control" id="choices-single-default" name="priority">
                                                <option value="">Choisir une option</option>
                                                <option value="critical" {{ old('priority', $task->priority) == 'critical' ? 'selected' : '' }}>Critique</option>
                                                <option value="high" {{ old('priority', $task->priority) == 'high' ? 'selected' : '' }}>Elevé</option>
                                                <option value="medium" {{ old('priority', $task->priority) == 'medium' ? 'selected' : '' }}>Moyen</option>
                                                <option value="low" {{ old('priority', $task->priority) == 'low' ? 'selected' : '' }}>Faible</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-12">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control" id="description" name="description" placeholder="Description de la tâche">{{ old('description', $task->description) }}</textarea>
                                        </div>
                                        <div class="col-xl-12">
                                            <label for="image" class="form-label">Image</label>
                                            <input type="file" class="form-control" id="image" name="image" placeholder="L'image de la tâche" accept=".jpg,.jpeg,.png">
                                            @if ($task->image)
                                            <div class="d-flex justify-content-center mt-3">
                                                <img src="{{ asset('storage/public/' . basename($task->image)) }}" alt="Image">
                                            </div>
                                            @endif
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
                <div class="modal fade" id="deleteTask-{{ $task->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="modal-title" id="mail-ComposeLabel">Modifier une tâche</h6>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="{{ route('admin.task.destroy', ['id' => $task->id]) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('DELETE')
                                <div class="modal-body px-4">
                                    <div class="row gy-2">
                                        <p class="text-center my-4">
                                            Voulez-vous vraiment supprimer cette tâche ?
                                        </p>
                                    </div>
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
                @empty
                <div class="col-xl-12 my-5 py-5 d-flex justify-content-center align-items-center text-muted">
                    Aucune tâche enrégistrée
                </div>
                @endforelse
            </div>
        </div>
        <div class="tab-pane p-0" id="completed"
            role="tabpanel">
            <div class="row">
                @forelse ($completedTasks as $task)

                @php
                    $color = null;
                    switch ($task->priority) {
                        case 'low':
                            $color = 'secondary';
                            break;
                        case 'medium':
                            $color = 'primary';
                            break;
                        case 'high':
                            $color = 'warning';
                            break;
                        case 'critical':
                            $color = 'danger';
                            break;
                    }
                @endphp


                <div class="col-xl-4">
                    <div class="card custom-card border border-{{ $color }}">
                        <div class="card-body p-0">
                            <div class="p-3 kanban-board-head">
                                <div class="d-flex text-muted justify-content-between mb-1 fs-12 fw-semibold">
                                    <div class="text-dark">Créé par - {{ $task->user->id == Auth::user()->id ? 'Vous' : $task->user->name }}</div>
                                    <div>{{ $task->relative_created_at }}</div>
                                </div>
                                <div class="d-flex align-items-center justify-content-end">
                                    <div class="dropdown">
                                        <a aria-label="anchor" href="javascript:void(0);" class="btn btn-icon btn-sm btn-light" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fe fe-more-vertical"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item" href="{{ route('admin.task.detail', ['id' => $task->id]) }}"><i class="ri-eye-line me-1 align-middle d-inline-block"></i>Voir</a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#editTask-{{ $task->id }}"><i class="ri-edit-line me-1 align-middle d-inline-block"></i>Editer</a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#deleteTask-{{ $task->id }}"><i class="ri-delete-bin-line me-1 align-middle d-inline-block"></i>Supprimer</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="kanban-content mt-2">
                                    @if ($task->image)
                                    <div class="task-image mt-2">
                                        <img src="{{ asset('storage/public/' . basename($task->image)) }}" class="img-fluid rounded kanban-image" alt="">
                                    </div>
                                    @endif
                                    <h6 class="fw-semibold mb-1 fs-15 mt-2">{{ $task->first_name . ' ' . $task->name }}</h6>
                                    @if ($task->description)
                                    <div class="kanban-task-description">{{ Str::limit($task->description, 50) }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="p-3 border-top border-{{ $color }}">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        @switch($task->statut)
                                            @case('in_progress')
                                                <span class="badge bg-warning text-light px-3 py-2">En cours</span>
                                                @break
                                            @case('completed')
                                                <span class="badge bg-success text-light px-3 py-2">Terminé</span>
                                                @break
                                            @default
                                                <span class="badge bg-danger text-light px-3 py-2">En attente</span>
                                        @endswitch
                                    </div>
                                    <div class="avatar-list-stacked">
                                        @foreach ($task->users as $user)
                                        <span class="avatar avatar-sm avatar-rounded bg-primary-transparent fw-semibold">
                                            @if ($user->profile_photo)
                                            <img src="{{ asset('storage/public/' . basename($user->profile_photo)) }}" alt="Photo de profil">
                                            @else
                                            {{ substr(strtoupper($user->first_name), 0, 1) }}{{ substr(strtoupper($user->name), 0, 1) }}
                                            @endif
                                        </span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="editTask-{{ $task->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="modal-title" id="mail-ComposeLabel">Modifier une tâche</h6>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="{{ route('admin.task.update', ['id' => $task->id]) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="modal-body px-4">
                                    <div class="row gy-2">
                                        <div class="col-xl-6">
                                            <label for="name" class="form-label">Nom <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Nom de la tâche" value="{{ old('name', $task->name) }}" required>
                                        </div>
                                        <div class="col-xl-6">
                                            <label class="form-label" for="userIds">Assigné à <span class="text-danger">*</span></label>
                                            <select class="form-control" name="userIds[]" id="userIds" multiple required>
                                                <option value="">Choisir une option</option>
                                                @forelse ($users as $user)
                                                <option value="{{ $user->id }}" {{ $task->users->contains($user->id) ? 'selected' : '' }}>{{ $user->first_name }} {{ $user->name }}</option>
                                                @empty
                                                <option value="">Aucun utilisateur enrégistré</option>
                                                @endforelse
                                            </select>
                                        </div>
                                        <div class="col-xl-6">
                                            <label class="form-label" for="due_date">Deadline</label>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-text text-muted"> <i class="ri-calendar-line"></i> </div>
                                                    <input type="date" class="form-control" id="due_date" name="due_date" placeholder="Sélectionnez un deadline" value="{{ old('due_date', $task->due_date) }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <label class="form-label">Priorité <span class="text-danger">*</span></label>
                                            <select class="form-control" id="choices-single-default" name="priority">
                                                <option value="">Choisir une option</option>
                                                <option value="critical" {{ old('priority', $task->priority) == 'critical' ? 'selected' : '' }}>Critique</option>
                                                <option value="high" {{ old('priority', $task->priority) == 'high' ? 'selected' : '' }}>Elevé</option>
                                                <option value="medium" {{ old('priority', $task->priority) == 'medium' ? 'selected' : '' }}>Moyen</option>
                                                <option value="low" {{ old('priority', $task->priority) == 'low' ? 'selected' : '' }}>Faible</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-12">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control" id="description" name="description" placeholder="Description de la tâche">{{ old('description', $task->description) }}</textarea>
                                        </div>
                                        <div class="col-xl-12">
                                            <label for="image" class="form-label">Image</label>
                                            <input type="file" class="form-control" id="image" name="image" placeholder="L'image de la tâche" accept=".jpg,.jpeg,.png">
                                            @if ($task->image)
                                            <div class="d-flex justify-content-center mt-3">
                                                <img src="{{ asset('storage/public/' . basename($task->image)) }}" alt="Image">
                                            </div>
                                            @endif
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
                <div class="modal fade" id="deleteTask-{{ $task->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="modal-title" id="mail-ComposeLabel">Modifier une tâche</h6>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="{{ route('admin.task.destroy', ['id' => $task->id]) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('DELETE')
                                <div class="modal-body px-4">
                                    <div class="row gy-2">
                                        <p class="text-center my-4">
                                            Voulez-vous vraiment supprimer cette tâche ?
                                        </p>
                                    </div>
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
                @empty
                <div class="col-xl-12 my-5 py-5 d-flex justify-content-center align-items-center text-muted">
                    Aucune tâche enrégistrée
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addtask" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="mail-ComposeLabel">Créer une tâche</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.task.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body px-4">
                    <div class="row gy-2">
                        <div class="col-xl-6">
                            <label for="name" class="form-label">Nom <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nom de la tâche" value="{{ old('name') }}" required>
                        </div>
                        <div class="col-xl-6">
                            <label class="form-label" for="userIds">Assigné à <span class="text-danger">*</span></label>
                            <select class="form-control" name="userIds[]" id="userIds" multiple required>
                                <option value="">Choisir une option</option>
                                @forelse ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->name }}</option>
                                @empty
                                <option value="">Aucun utilisateur enrégistré</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="col-xl-6">
                            <label class="form-label" for="due_date">Deadline</label>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-text text-muted"> <i class="ri-calendar-line"></i> </div>
                                    <input type="date" class="form-control" id="due_date" name="due_date" placeholder="Sélectionnez un deadline" value="{{ old('due_date') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <label class="form-label">Priorité <span class="text-danger">*</span></label>
                            <select class="form-control" id="choices-single-default" name="priority">
                                <option value="">Choisir une option</option>
                                <option value="critical" {{ old('priority') == 'critical' ? 'selected' : '' }}>Critique</option>
                                <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>Elevé</option>
                                <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>Moyen</option>
                                <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Faible</option>
                            </select>
                        </div>
                        <div class="col-xl-12">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" placeholder="Description de la tâche">{{ old('description') }}</textarea>
                        </div>
                        <div class="col-xl-12">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control" id="image" name="image" placeholder="L'image de la tâche" accept=".jpg,.jpeg,.png">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light"
                        data-bs-dismiss="modal">Retour</button>
                    <button type="submit" class="btn btn-primary">Enrégistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
