<!-- Page Header -->
<div class="d-md-flex d-block align-items-center justify-content-between mb-4 page-header-breadcrumb">
    <h1 class="page-title fw-semibold fs-18 mb-0">{{ $header ?? 'Tableau de bord' }}</h1>
    <div class="ms-md-1 ms-0">
        <nav>
            <ol class="breadcrumb mb-0">
                @if (isset($header))
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Tableau de bord</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $header }}</li>
                @else
                <li class="breadcrumb-item active" aria-current="page">Tableau de bord</li>
                @endif
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header Close -->
