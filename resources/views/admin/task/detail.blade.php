@extends('layouts.admin.app', [
    'header' => 'Détail de tâche'
])

@section('content')

<!-- Start::row-1 -->
<div class="row">
    <div class="col-xl-9">
        <div class="card custom-card">
            <div class="card-header d-flex justify-content-between">
                <div class="card-title">Informations</div>
                <div class="fs-15">Priorité :
                    @switch($task->priority)
                        @case('critical')
                            <span class="badge bg-danger text-light px-3 py-2">Urgent</span>
                            @break
                        @case('high')
                            <span class="badge bg-warning text-light px-3 py-2">Elevé</span>
                            @break
                        @case('medium')
                            <span class="badge bg-primary text-light px-3 py-2">Moyen</span>
                            @break
                        @case('low')
                            <span class="badge bg-secondary text-light px-3 py-2">Faible</span>
                            @break
                    @endswitch
                </div>
            </div>
            <div class="card-body">
                <h5 class="fw-semibold mb-4 task-title">
                    {{ $task->name }}
                </h5>
                @if ($task->image)
                <div class="d-flex justify-content-center align-items-center mb-4">
                    <img src="{{ $task->image }}" class="img-fluid rounded" alt="">
                </div>
                @endif
                <div class="text-muted task-description">
                    {{ $task->description }}
                </div>
            </div>
            <div class="card-footer">
                <div class="d-flex align-items-center justify-content-between gap-2 flex-wrap">
                    <div>
                        <span class="d-block text-muted fs-12">Assigné par</span>
                        <div class="d-flex align-items-center">
                            <div class="me-2 lh-1">
                                <span class="avatar avatar-xs avatar-rounded bg-primary-transparent fw-semibold">
                                    @if (isset($task->user->profile_photo))
                                    <img src="{{ asset('storage/public/' . basename($task->user->profile_photo)) }}" alt="Photo de profil">
                                    @else
                                    {{ substr(strtoupper($task->user->first_name), 0, 1) }}{{ substr(strtoupper($task->user->name), 0, 1) }}
                                    @endif
                                </span>
                            </div>
                            <span class="d-block fs-14 fw-semibold">{{ $task->user->first_name }} {{ $task->user->name }}</span>
                        </div>
                    </div>
                    <div>
                        <span class="d-block text-muted fs-12">Assigné le</span>
                        <span class="d-block fs-14 fw-semibold">{{ $task->formatted_created_at }}</span>
                    </div>
                    <div>
                        <span class="d-block text-muted fs-12">Assigné à</span>
                        <span class="d-block fs-14 fw-semibold">
                            <div class="avatar-list-stacked">
                                @foreach ($task->users as $user)
                                <span class="avatar avatar-xs avatar-rounded bg-primary-transparent fw-semibold">
                                    @if ($user->profile_photo)
                                    <img src="{{ asset('storage/public/' . basename($user->profile_photo)) }}" alt="Photo de profil">
                                    @else
                                    {{ substr(strtoupper($user->first_name), 0, 1) }}{{ substr(strtoupper($user->name), 0, 1) }}
                                    @endif
                                </span>
                                @endforeach
                            </div>
                        </span>
                    </div>
                    <div>
                        <span class="d-block text-muted fs-12">Deadline</span>
                        <span class="d-block fs-14 fw-semibold">{{ $task->deadline }}</span>
                    </div>
                    @if ($total != 0)
                    <div class="task-details-progress">
                        <span class="d-block text-muted fs-12 mb-1">Progression</span>
                        <div class="d-flex align-items-center">
                            <div class="progress progress-xs progress-animate flex-fill me-2" role="progressbar" aria-valuenow="{{ $completed }}" aria-valuemin="0" aria-valuemax="{{ $total }}" id="progress">
                                <div class="progress-bar bg-primary" style="width: {{ $completed / $total * 100 }}%" id="progress-bar"></div>
                            </div>
                            <div class="text-muted fs-11" id="progress-text">{{ round(($completed / $total) * 100) }}%</div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">Tâche assigné à :</div>
            </div>
            <div class="card-body">
                <ul class="list-group overflow-hidden">
                    @foreach ($task->users as $user)
                    <li class="list-group-item">
                        <div class="d-flex align-items-center">
                            <div>
                                <span class="avatar avatar-md avatar-rounded bg-primary-transparent fw-semibold">
                                    @if ($user->profile_photo)
                                    <img src="{{ $user->profile_photo }}" alt="Photo de profil">
                                    @else
                                    {{ substr(strtoupper($user->first_name), 0, 1) }}{{ substr(strtoupper($user->name), 0, 1) }}
                                    @endif
                                </span>
                            </div>
                            <div class="mx-2">
                                <p class="fw-semibold mb-1">{{ $user->first_name }} {{ $user->name }}</p>
                                <p class="text-muted text-sm">{{ $user->email }}</p>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="col-xl-9">
        <div class="card custom-card overflow-hidden">
            <div class="card-header justify-content-between">
                <div class="card-title">Détails de la tâche</div>
                <div>
                    <button class="btn btn-primary btn-wave"><i class="ri-add-line me-1 align-middle" data-bs-toggle="modal" data-bs-target="#addtask"></i>Ajouter</button>
                </div>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    @forelse ($task->task_details as $detail)
                    <li class="list-group-item">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="me-2"><input class="form-check-input" type="checkbox" id="statut_{{ $detail->id }}" {{ $detail->statut == 'completed' ? 'checked' : '' }} onchange="updateStatut({{ $detail->id }})"></div>
                                <div class="fw-semibold">{{ $detail->detail }}</div>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editTask-{{ $detail->id }}">
                                    <i class="ri-edit-line me-1 align-middle d-inline-block"></i>
                                </button>
                                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteTask-{{ $detail->id }}">
                                    <i class="ri-delete-bin-line me-1 align-middle d-inline-block"></i>
                                </button>
                            </div>
                            <div class="modal fade" id="editTask-{{ $detail->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h6 class="modal-title" id="mail-ComposeLabel">Créer un détail de tâche</h6>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('admin.task.detail.update', ['id' => $detail->id]) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="task_id" value="{{ $task->id }}">
                                            <div class="modal-body px-4">
                                                <div class="row gy-2">
                                                    <div class="col-xl-12">
                                                        <label for="detail" class="form-label">Détail <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="detail" name="detail" placeholder="Entrée le détail" value="{{ old('detail', $detail->detail) }}" required>
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
                            <div class="modal fade" id="deleteTask-{{ $detail->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h6 class="modal-title" id="mail-ComposeLabel">Créer un détail de tâche</h6>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('admin.task.detail.destroy', ['id' => $detail->id]) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-body px-4">
                                                <p class="text-center my-4">
                                                    Voulez-vous vraiment supprimer ce détail ?
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
                        </div>
                    </li>
                    @empty
                    <li class="list-group-item">
                        <div class="d-flex justify-content-center align-items-center text-muted">
                            Aucun détail enrégistré
                        </div>
                    </li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
<!--End::row-1 -->

<div class="modal fade" id="addtask" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="mail-ComposeLabel">Créer un détail de tâche</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.task.detail.store') }}" method="post">
                @csrf
                <input type="hidden" name="task_id" value="{{ $task->id }}">
                <div class="modal-body px-4">
                    <div class="row gy-2">
                        <div class="col-xl-12">
                            <label for="detail" class="form-label">Détail <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="detail" name="detail" placeholder="Entrée le détail" value="{{ old('detail') }}" required>
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

<script>
    function updateStatut(id) {
        let checkbox = document.getElementById('statut_' + id);
        let isChecked = checkbox.checked;

        fetch(`/admin/task/detail/updateStatut/${id}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {

                let progress = document.querySelector('#progress');
                let progressBar = document.querySelector('#progress-bar');
                let progressText = document.querySelector('#progress-text');

                let progressPercent = (data.completed / data.total) * 100;

                progress.setAttribute('aria-valuenow', data.completed);
                progress.setAttribute('aria-valuemax', data.total);

                progressBar.style.width = progressPercent + '%';
                progressText.textContent = Math.round(progressPercent) + '%';

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

                checkbox.checked = !isChecked;
            }
        })
        .catch(error => {
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: error,
                showConfirmButton: false,
                timer: 3000
            });

            checkbox.checked = !isChecked;
        });
    }
</script>

@endsection
