@extends('layouts.admin.app', [
    'header' => 'Page ' . $title,
])

@section('content')

<div class="row mt-4">
    <div class="col-xl-12">
        <div class="team-members" id="team-members">
            <div class="row">
                @foreach ($sections as $section)
                <div class="col-xl-9 mb-3">
                    <div class="card custom-card">
                        <div class="card-header">
                            <div class="card-title">
                                Section {{ $section->name }}
                            </div>
                        </div>
                        <form action="{{ route('admin.page.home.update') }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="modal-body px-3">
                                    <div class="row gy-2">
                                        <input type="hidden" name="page" value="{{ $section->page }}">
                                        <input type="hidden" name="section" value="{{ $section->section }}">
                                        <div class="col-xl-12 mb-3">
                                            <label for="name" class="form-label">Nom <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Le nom" value="{{ old('name', $section->name) }}" readonly>
                                        </div>
                                        <div class="col-xl-12 mb-3">
                                            <label for="title" class="form-label">Titre de la section <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="title" name="title" placeholder="Le numéro de téléphone" value="{{ old('title', $section->title) }}" required>
                                        </div>
                                        <div class="col-xl-12 mb-3">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control" id="description" name="description" placeholder="La description">{{ old('description', $section->description) }}</textarea>
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
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection