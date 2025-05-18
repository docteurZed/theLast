@extends('layouts.admin.app', [
    'header' => 'Interactions'
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
                                        {{-- <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#create-user">
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
                                        <th>Total Likes</th>
                                        <th>Total Messages</th>
                                        <th>Total Votes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="fw-bold">
                                                {{ ucfirst($user->first_name) }} {{ ucfirst($user->name) }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="fw-bold text-danger">
                                                {{ $user->likesReceived->count() }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="fw-bold text-success">
                                                {{ $user->receivedMessages->count() }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="fw-bold text-primary">
                                                {{ $user->votesReceived->count() }}
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5">
                                            <div class="flex justify-content-center">
                                                <p class="text-center">Aucune interaction enregistrée</p>
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

@endsection
