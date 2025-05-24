@extends('layouts.admin.app', [
    'header' => 'Notifications'
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
                <div class="col-xl-9">
                    <div class="card custom-card">
                        <div class="card-body">
                            <form action="{{ route('admin.system.notification.store') }}" method="post">
                                @csrf
                                <div class="row gy-2">
                                    <div class="col-xl-12 mb-3">
                                        <label for="subject" class="form-label">Objet <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="subject" name="subject" required>
                                    </div>
                                    <div class="col-xl-12 mb-3">
                                        <label for="editor" class="form-label">Message <span class="text-danger">*</span></label>
                                        <textarea class="form-control" id="summernote" name="message"></textarea>
                                    </div>
                                    <div class="col-xl-12">
                                        <button class="btn btn-primary">
                                            <i class="ri-send-plane-line me-1 fw-semibold align-middle"></i>
                                            <span class="fw-bold">Envoyer les messages</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
