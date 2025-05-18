<!DOCTYPE html>
<html lang="{{ env('APP_LOCALE') }}">
    <head>

        @include('layouts.participant._head')

    </head>
    <body class="bg-gray-900">

        @include('layouts.participant._sidebar')

        <div class="p-4 sm:ml-64 mt-16">
            @yield('content')
        </div>

        @include('layouts.participant._bottombar')

        @include('layouts.participant._script')
    </body>
</html>
