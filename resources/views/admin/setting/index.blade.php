@extends('layouts.admin.app', [
    'header' => 'Paramètres'
])

@section('content')

<div class="row mt-4">
    <div class="col-xl-12">
        <div class="team-members" id="team-members">
            <div class="row">
                <div class="col-xl-9">
                    <div class="card custom-card">
                        <div class="card-header">
                            <div class="card-title">
                                Paramètres généraux
                            </div>
                        </div>
                        <form action="{{ route('admin.setting.update') }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="modal-body px-3">
                                    <div class="row gy-2">
                                        <div class="col-xl-12 mb-3">
                                            <label for="name" class="form-label">Nom <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Le nom" value="{{ old('name', $setting->name) }}" readonly>
                                        </div>
                                        <div class="col-xl-12 mb-3">
                                            <label for="phone" class="form-label">Numéro de téléphone <span class="text-danger">*</span></label>
                                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Le numéro de téléphone" value="{{ old('phone', $setting->phone) }}" required>
                                        </div>
                                        <div class="col-xl-12 mb-3">
                                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="L'adresse email" value="{{ old('email', $setting->email) }}" required>
                                        </div>
                                        <div class="col-xl-12 mb-3">
                                            <label for="participation_fee" class="form-label">Montant de participation <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" id="participation_fee" name="participation_fee" placeholder="Le montant de participation" value="{{ old('participation_fee', $setting->participation_fee) }}" required>
                                        </div>
                                        <div class="col-xl-12 mb-3">
                                            <label for="decompt_event_date" class="form-label">Date pour la décompte <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" id="decompt_event_date" name="decompt_event_date" placeholder="La date pour la décompte" value="{{ old('decompt_event_date', $setting->decompt_event_date) }}" required>
                                        </div>
                                        <div class="col-xl-12 mb-3">
                                            <label for="decompt_event_time" class="form-label">Heure pour la décompte <span class="text-danger">*</span></label>
                                            <input type="time" class="form-control" id="decompt_event_time" name="decompt_event_time" placeholder="L'heure pour la décompte" value="{{ old('decompt_event_time', $setting->decompt_event_time) }}" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="flex align-items-center">
                                    <button class="btn btn-primary">Mettre à jour</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection