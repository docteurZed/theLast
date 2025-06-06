@extends('layouts.admin.app', [
    'header' => 'Participants'
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

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="card custom-card">
                        <div class="card-body">
                            <table id="file-export" class="table table-bordered w-100">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nom</th>
                                        <th>Prénom.s</th>
                                        <th>Numéro de téléphone</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($guests as $admin)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            {{ ucfirst($admin->name) }}
                                        </td>
                                        <td>
                                            {{ ucfirst($admin->first_name) }}
                                        </td>
                                        <td>
                                            {{ $admin->phone }}
                                        </td>
                                        <td>
                                            {{ $admin->email }}
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5">
                                            <div class="flex justify-content-center">
                                                <p class="text-center">
                                                    Aucun participant enrégistré
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

@endsection
