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
                    Chargement...
                </p>
            </div>
        </div>

        <div id="page">
            @if (!isset($noSidebar))
                @include('layouts.participant._sidebar')
            @endif
            <div class="{{ !isset($noPadding) ? 'p-4' : '' }} {{ !isset($noSidebar) ? 'sm:ml-64' : '' }} {{ !isset($noMargin) ? 'mt-16' : '' }}">
                @yield('content')
            </div>

            @if (!isset($noBottombar))
                @include('layouts.participant._bottombar')
            @endif

        </div>

        <!-- Bouton "Installer l'application" -->
        <div id="install-container" class="fixed bottom-4 mb-16 right-4 z-50">
            <button id="install-button"
                class="hidden px-6 py-3 bg-gradient-to-r from-yellow-500 via-yellow-600 to-yellow-800 hover:opacity-90 text-white text-center rounded-xl shadow-lg transition duration-300">
                Installer l'application
            </button>
        </div>


        @include('layouts.participant._script')
    </body>
</html>
