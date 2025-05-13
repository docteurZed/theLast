<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>{{ env('APP_NAME') }}</title>

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

<!-- Styles / Scripts -->
{{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
<link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

<style>
    @keyframes spin-slow {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    .animate-spin-slow {
        animation: spin-slow 30s linear infinite;
    }

    .fade-section {
        opacity: 0;
        transform: translateY(30px);
        transition: opacity 0.8s ease-out, transform 0.8s ease-out;
    }

    .fade-section.visible {
            opacity: 1;
            transform: translateY(0);
        }

    .fade-left {
        opacity: 0;
        transform: translateX(-50px); /* glisse depuis la gauche */
        transition: opacity 1.2s ease-out, transform 1.2s ease-out;
    }

    .fade-left.visible {
        opacity: 1;
        transform: translateX(0);
    }

    .fade-right {
        opacity: 0;
        transform: translateX(50px); /* glisse depuis la gauche */
        transition: opacity 1.2s ease-out, transform 1.2s ease-out;
    }

    .fade-right.visible {
        opacity: 1;
        transform: translateX(0);
    }


</style>
