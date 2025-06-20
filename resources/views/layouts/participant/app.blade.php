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
            <div class="{{ !isset($noPadding) ? 'p-4' : '' }} {{ !isset($noSidebar) ? 'sm:ml-64' : '' }} {{ !isset($noMargin) ? 'mt-15' : '' }}">
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

        {{-- <section id="special-section" class="fixed inset-0 z-50 bg-gray-950 bg-opacity-70 flex items-center justify-center p-4">
            <div
                class="bg-gray-900 rounded-2xl shadow-xl p-6 w-full max-w-xl max-h-[90vh] overflow-y-auto text-center animate-fade-in relative"
            >
                <!-- Bouton dismiss -->
                <button
                    id="special-message-button"
                    aria-label="Fermer"
                    class="absolute top-4 right-4 text-gray-400 hover:text-yellow-500 transition cursor-pointer"
                    title="Fermer le message"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <div class="text-gray-400 text-sm mb-4">
                    <div class="text-yellow-600 text-xl sm:text-2xl font-bold mb-4 capitalize">🎓 ça y est c'est la fin !!!</div>
                    <p class="text-base leading-relaxed">
                        Wesh la famille... <br><br>

                        La fin d’un chapitre n’est en réalité que le commencement d’une nouvelle aventure pleine de promesses et de défis. ✨ <br><br>

                        Nous avons su, ensemble, écrire une page unique de notre histoire collective, faite de défis relevés, d’efforts partagés et de succès mérités. 💪✨<br><br>

                        Ce moment est à nous, pour célébrer tout ce que nous avons accompli, la force de votre cohésion et la fierté d’appartenir à cette promotion exceptionnelle. 🌟🔥<br><br>

                        Nous vous invitons maintenant à laisser une trace indélébile de votre passage : un mot sincère pour votre promotion et un message d’encouragement pour celles et ceux qui suivront vos pas. 💬🌟 <br><br>

                        OEDEN...
                    </p>
                </div>

                <a href=""
                    class="bg-gradient-to-r from-yellow-500 via-yellow-600 to-yellow-800 text-white px-6 py-3 rounded-lg font-semibold shadow-md hover:opacity-90 transition inline-block mt-4">
                    ✍️ Écrire un mot à la promotion
                </a>
            </div>
        </section> --}}

        @include('layouts.participant._script')
    </body>
</html>
