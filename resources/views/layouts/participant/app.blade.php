<!DOCTYPE html>
<html lang="{{ env('APP_LOCALE') }}">
    <head>

        @include('layouts.participant._head')

    </head>
    <body class="bg-gray-900">

        <div id="loading-screen" class="max-w-md m-auto flex justify-center items-center min-h-screen hidden">
            <div class="text-center">
                <a href="#" class="flex items-center justify-center">
                    <span class="self-center text-3xl font-bold whitespace-nowrap text-white">
                        the<span class="bg-gradient-to-r from-yellow-800 via-yellow-600 to-yellow-500 bg-clip-text text-transparent">Last</span>
                    </span>
                </a>
                <p class="my-8 text-gray-400 text-xl font-semibold">
                    Loading...
                </p>
            </div>
        </div>

        <div id="page">
            @include('layouts.participant._sidebar')

            <div class="p-4 sm:ml-64 mt-16">
                @yield('content')
            </div>

            @include('layouts.participant._bottombar')
        </div>

        @include('layouts.participant._script')
    </body>
</html>
