<!DOCTYPE html>
<html lang="{{ env('APP_LOCALE') }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ env('APP_NAME') }}{{ $error ? ' | Erreur ' . $error : '' }}</title>

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
                <div class="mx-auto max-w-screen-sm text-center">
                    <h1 class="mb-4 tracking-tight font-extrabold text-7xl lg:text-9xl bg-gradient-to-r from-yellow-800 via-yellow-600 to-yellow-500 bg-clip-text text-transparent">
                        {{ $error }}
                    </h1>
                    <p class="mb-4 text-2xl tracking-tight font-bold md:text-4xl text-white">
                        {{ $subtitle }}
                    </p>
                    <p class="mb-4 text-lg font-medium text-gray-400">
                        {{ $description }}
                    </p>
                    <a href="{{ route('home') }}" class="inline-flex text-white bg-gradient-to-r from-yellow-500 via-yellow-600 to-yellow-800 hover:opacity-90 transition focus:ring-2 focus:outline-none focus:ring-yellow-500 font-semibold rounded-lg text-sm px-5 py-2.5 text-center my-4">
                        Revenir à l'accueil
                    </a>
                </div>
            </div>
        </section>

    </body>
</html>

