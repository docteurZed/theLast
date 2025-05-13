<!DOCTYPE html>
<html lang="{{ env('APP_LOCALE') }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ env('APP_NAME') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    </head>
    <body class="bg-gray-950">

        <section class="flex justify-center items-center">
            <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
                <div class="text-center mb-12">
                    <a href="{{ route('home') }}" class="flex items-center justify-center">
                        <span class="self-center text-4xl font-bold whitespace-nowrap text-white">
                            the<span class="bg-gradient-to-r from-yellow-800 via-yellow-600 to-yellow-500 bg-clip-text text-transparent">Last</span>
                        </span>
                    </a>
                </div>

                <div class="mx-auto max-w-screen-sm text-center">
                    <p class="mb-8 text-green-600 flex justify-center">
                        <span class="mx-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="h-16 w-16" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                            </svg>
                        </span>
                    </p>
                    <p class="mb-4 text-4xl text-lg font-semibold text-white">
                        Votre message a bien été envoyé. Vous recevrez bientôt une réponse de la part du comité d'organisation.
                    </p>
                    <a href="{{ route('home') }}" class="inline-flex text-white bg-gradient-to-r from-yellow-500 via-yellow-600 to-yellow-800 hover:opacity-90 transition focus:ring-2 focus:outline-none focus:ring-yellow-500 font-semibold rounded-lg text-sm px-5 py-2.5 text-center my-4">
                        Revenir à l'accueil
                    </a>
                </div>
            </div>
        </section>

    </body>
</html>
