<!DOCTYPE html>
<html lang="{{ env('APP_LOCALE') }}" dir="ltr" data-nav-layout="vertical" data-theme-mode="light" data-header-styles="light" data-menu-styles="dark" data-toggled="close">

<head>
    @include('layouts.admin._head')
</head>

<body>

    @include('layouts.admin._switcher')

    @include('layouts.admin._loader')

    <div class="page">

        @include('layouts.admin._header')

        @include('layouts.admin._sidebar')

        <!-- Start::app-content -->
        <div class="main-content app-content">
            <div class="container-fluid">

                @include('layouts.admin._breadcrumb')

                @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ Session::get('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"><i class="bi bi-x"></i>
                        </button>
                    </div>
                @elseif (Session::has('warning'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ Session::get('warning') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"><i class="bi bi-x"></i>
                        </button>
                    </div>
                @elseif($errors->any())
                    @foreach ($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ $error }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"><i class="bi bi-x"></i>
                        </button>
                    </div>
                    @endforeach
                @endif

                @yield('content')

            </div>
        </div>
        <!-- End::app-content -->
    </div>

    @include('layouts.admin._scroll')

    @include('layouts.admin._script')
</body>

</html>
