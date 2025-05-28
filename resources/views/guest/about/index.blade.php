@extends('layouts.guest.app', [
    'header' => 'A propos',
])

@section('content')

<section class="section px-5 md:px-16 lg:px-24">
    <div class="fade-section gap-16 items-center py-8 mx-auto max-w-screen-xl lg:grid lg:grid-cols-2 lg:py-16">
        <div class="font-light sm:text-lg text-gray-400">
            <p class="mb-2 font-semibold fs-12 bg-gradient-to-r from-yellow-600 to-yellow-800 bg-clip-text text-transparent">{{ $sections['about']->name }}</p>
            <h2 class="mb-5 text-3xl md:text-4xl tracking-tight font-extrabold text-white">{{ $sections['about']->title }}</h2>
            <p class="mb-3 font-medium">{{ $sections['about']->description }}</p>
        </div>
        <div class="gap-4 mt-8 flex justify-center">
            <img class="w-full rounded-lg" src="{{ asset('images/about.jpg') }}" alt="office content 1">
        </div>
    </div>
</section>

@if ($events->isNotEmpty())
<section class="{{ $events->isNotEmpty() ? 'section' : '' }} px-5 md:px-16 lg:px-24">
    <div class="fade-section py-12 mx-auto max-w-screen-xl">
        <!-- Header -->
        <div class="mb-12 text-center">
            <p class="mb-2 font-semibold bg-gradient-to-r from-yellow-600 to-yellow-800 bg-clip-text text-transparent">{{ $sections['info']->name }}</p>
            <h2 class="text-3xl md:text-4xl font-extrabold text-white">{{ $sections['info']->title }}</h2>
            <p class="mt-3 text-gray-400">{{ $sections['info']->description }}</p>
        </div>

        <!-- Desktop Tabs -->
        <ul id="event-tab"
            class="flex text-sm font-semibold text-center text-white rounded-lg mb-6 overflow-hidden"
            data-tabs-toggle="#event-tab-content"
            data-tabs-active-classes="bg-gradient-to-r from-yellow-500 via-yellow-600 to-yellow-800 hover:opacity-90"
            data-tabs-inactive-classes="bg-gray-700 text-white hover:bg-gray-600"
            role="tablist">
            @foreach ($events as $event)
            <li class="w-full">
                <button id="event-tab-{{ $event->id }}"
                        data-tabs-target="#event-{{ $event->id }}"
                        type="button"
                        role="tab"
                        aria-controls="event-{{ $event->id }}"
                        aria-selected="{{ $loop->first ? 'true' : 'false' }}"
                        class="w-full p-4 transition-colors duration-200">
                    {{ $event->name }}
                </button>
            </li>
            @endforeach
        </ul>

        <!-- Tabs Content -->
        <div id="event-tab-content">
            @foreach ($events as $event)
                <div id="event-{{ $event->id }}" role="tabpanel" aria-labelledby="event-tab-{{ $event->id }}">
                <!-- Infos pratiques -->
                    <div class="grid md:grid-cols-3 gap-8 text-gray-300 mb-8">
                        <!-- Date -->
                        <div class="flex flex-col items-center text-center border border-gray-600 px-2 py-3 rounded-lg bg-gray-900">
                            <svg class="w-10 h-10 text-yellow-600 mb-3" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M6 2a1 1 0 000 2h1v1a1 1 0 102 0V4h2v1a1 1 0 102 0V4h1a1 1 0 100-2H6zM3 7a2 2 0 012-2h10a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V7zm2 0v9h10V7H5z"/>
                            </svg>
                            <h3 class="font-bold text-lg mb-1">Date</h3>
                            <p class="font-semibold">{{ ucfirst(\Carbon\Carbon::parse($event->starts_at)->translatedFormat('l, d F Y')) }}</p>
                        </div>
                        <!-- Heure -->
                        <div class="flex flex-col items-center text-center border border-gray-600 px-2 py-3 rounded-lg bg-gray-900">
                            <svg class="w-10 h-10 text-yellow-600 mb-3" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 2a8 8 0 100 16 8 8 0 000-16zm1 8V6a1 1 0 10-2 0v5a1 1 0 00.293.707l2.5 2.5a1 1 0 001.414-1.414L11 10z"/>
                            </svg>
                            <h3 class="font-bold text-lg mb-1">Heure</h3>
                            <p class="font-semibold">{{ \Carbon\Carbon::parse($event->starts_at)->translatedFormat('H:i') }}</p>
                        </div>
                        <!-- Lieu -->
                        <div class="flex flex-col items-center text-center border border-gray-600 px-2 py-3 rounded-lg bg-gray-900">
                            <svg class="w-10 h-10 text-yellow-600 mb-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 2a6 6 0 00-6 6c0 4.28 6 10 6 10s6-5.72 6-10a6 6 0 00-6-6zm0 8a2 2 0 110-4 2 2 0 010 4z" clip-rule="evenodd" />
                            </svg>
                            <h3 class="font-bold text-lg mb-1">Lieu</h3>
                            <p class="font-semibold">{{ ucfirst($event->location) }}</p>
                        </div>
                    </div>

                    @if($event->location_latitude && $event->location_longitude)
                    <div class="mb-8 flex justify-center">
                        <div class="w-full max-w-lg aspect-video rounded-lg overflow-hidden shadow-md border">
                            <iframe
                                class="w-full h-full"
                                frameborder="0"
                                style="border:0"
                                src="https://www.google.com/maps?q={{ $event->location_latitude }},{{ $event->location_longitude }}&hl=fr&z=16&output=embed"
                                allowfullscreen
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>
                    @endif

                    @if ($event->programs->isNotEmpty())
                    <!-- Programme -->
                    <div class="p-4 md:p-6 text-center">
                        <ul class="list-inside text-gray-300 space-y-4 font-semibold">
                            @foreach ($event->programs as $program)
                            <li>
                                <div class="p-3 md:p-5 grid grid-cols-4 {{ !$loop->last ? 'border-b border-gray-700 border-dashed' : '' }}">
                                    <div class="border-r border-gray-700 border-dashed text-yellow-600 px-2">
                                        {{ \Carbon\Carbon::parse($program->starts_at)->translatedFormat('H\hi') }}
                                        {{ $program->ends_at ? ' - ' . \Carbon\Carbon::parse($program->ends_at)->translatedFormat('H\hi') : '' }}
                                    </div>
                                    <div class="col-span-2 border-r border-gray-700 border-dashed px-2">
                                        {{ ucfirst($program->title) }}
                                    </div>
                                    <div class="px-2">
                                        {{ ucfirst($program->speaker) }}
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="{{ $events->isNotEmpty() ? 'section' : '' }} px-5 md:px-16 lg:px-24">
    <div class="fade-section gap-16 items-center py-12 mx-auto max-w-screen-xl lg:grid lg:grid-cols-2">
        <!-- Texte -->
        <div class="font-light sm:text-lg text-gray-400">
            <p class="mb-2 font-semibold bg-gradient-to-r from-yellow-600 to-yellow-800 bg-clip-text text-transparent">
                {{ $sections['dress']->name }}
            </p>
            <h2 class="mb-5 text-3xl md:text-4xl tracking-tight font-extrabold text-white">
                {{ $sections['dress']->title }}
            </h2>
            <p class="mb-6 font-medium">
                {{ $sections['dress']->description }}
            </p>

            <!-- Dresscode items -->
            <div class="grid gap-4 sm:grid-cols-2" id="dresscode-options">
                @foreach ($events as $event)
                <div class="dresscode-item cursor-pointer gap-4 rounded-xl p-4 bg-gradient-to-r from-yellow-500 via-yellow-600 to-yellow-800 card text-center"
                    data-type="event-{{ $event->id }}"
                    data-primary-image="{{ $event->primary_image ?? '' }}"
                    data-secondary-image="{{ $event->secondary_image ?? '' }}">
                    <div class="mb-5">
                        <h4 class="text-white font-bold text-xl">{{ $event->name }}</h4>
                        <hr class="border border-dashed border-gray-200 my-3">
                        <p class="text-gray-200 font-semibold">{{ $event->dress_code }}</p>
                        <div class="mt-3 flex justify-center gap-3 items-center">
                            <span class="rounded-full border border-white w-8 h-8" style="background: {{ $event->primary_color_hex }}"></span>
                            @if ($event->secondary_color_hex)
                            <span class="rounded-full border border-white w-8 h-8" style="background: {{ $event->secondary_color_hex }}"></span>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Images dynamiques -->
        <div class="md:grid grid-cols-2 gap-4 mt-8" id="dresscode-images">
            <img id="img1" class="w-full rounded-lg" src="" alt="Image principale" style="display: block;">
            <img id="img2" class="mt-4 w-full lg:mt-10 rounded-lg" src="" alt="Image secondaire" style="display: block;">
        </div>
    </div>
</section>
@endif

<section id="parallax-section" class="w-full bg-center bg-cover bg-[url('{{ asset('images/bg.jpg') }}')] bg-gray-900/80 bg-blend-multiply">
    <!-- Content -->
    <div class="fade-section relative z-10 px-6 py-24 md:py-32 text-center text-white max-w-3xl mx-auto">
        <p class="mb-2 text-sm font-semibold bg-gradient-to-r from-yellow-600 to-yellow-800 bg-clip-text text-transparent">{{ $sections['cta']->name }}</p>
        <h2 class="text-3xl md:text-4xl font-extrabold mb-4">{{ $sections['cta']->title }}</h2>
        <p class="text-lg md:text-xl mb-8">{{ $sections['cta']->description }}</p>
        <a href="{{ route('confirmation') }}" class="inline-block px-6 py-3 text-lg font-semibold text-white bg-gradient-to-r from-yellow-500 via-yellow-600 to-yellow-800 hover:opacity-90 transition rounded-lg shadow-lg">
            Confirmer ma présence
        </a>
    </div>
</section>

@if ($guests->isNotEmpty())
<section class="{{ $guests->isNotEmpty() ? 'section' : '' }} px-5 md:px-16 lg:px-24 py-16 bg-gray-950">
    <div class="fade-section max-w-screen-xl mx-auto text-center">
        <p class="mb-2 text-sm font-semibold bg-gradient-to-r from-yellow-600 to-yellow-800 bg-clip-text text-transparent">{{ $sections['guest']->name }}</p>
        <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-6">{{ $sections['guest']->title }}</h2>
        <p class="text-lg text-gray-400 mb-12">{{ $sections['guest']->description }}</p>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10 text-center">
            @foreach ($guests as $guest)
            <div class="bg-gray-900 rounded-xl p-6 shadow hover:shadow-lg transition">
                <img class="w-24 h-24 mx-auto rounded-full mb-4 object-cover" src="{{ $guest->image ?? asset('images/user.png') }}" alt="Invité">
                <h3 class="text-xl font-bold text-white">{{ ucfirst($guest->name) }}. {{ ucfirst($guest->name) }}</h3>
                <p class="text-sm text-yellow-600 font-semibold mb-2">{{ ucfirst($guest->role) }} • {{ ucfirst($guest->domain) }}</p>
                <p class="text-gray-400 text-sm">{{ ucfirst($guest->description) }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@if ($sponsors->isNotEmpty())
<section class="{{ $sponsors->isNotEmpty() ? 'section' : '' }} px-5 md:px-16 lg:px-24 text-center">
    <div class="fade-section fade-right gap-16 items-center py-8 mx-auto max-w-screen-xl lg:py-16">
        <div class="font-light sm:text-lg text-gray-400">
            <p class="mb-2 text-sm font-semibold bg-gradient-to-r from-yellow-600 to-yellow-800 bg-clip-text text-transparent">{{ $sections['sponsor']->name }}</p>
            <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-6">{{ $sections['sponsor']->title }}</h2>
            <p class="text-lg text-gray-400 mb-12">{{ $sections['sponsor']->description }}</p>

            <div class="bg-gray-50 py-3 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-8 items-center justify-center text-center">
                @foreach ($sponsors as $sponsor)
                <img class="max-h-12 w-full object-contain" src="{{ $sponsor->logo }}" alt="sponsor" loading="lazy">
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const dresscodeItems = document.querySelectorAll('.dresscode-item');
        const img1 = document.getElementById('img1');
        const img2 = document.getElementById('img2');

        if (dresscodeItems.length === 0) return;

        // Fonction pour activer un item
        function activateDresscodeItem(item) {
            // Reset styles
            dresscodeItems.forEach(el => {
                el.classList.remove('bg-gradient-to-r', 'from-yellow-500', 'via-yellow-600', 'to-yellow-800', 'active');
            });

            item.classList.add('bg-gradient-to-r', 'from-yellow-500', 'via-yellow-600', 'to-yellow-800', 'active');

            const primaryImage = item.getAttribute('data-primary-image');
            const secondaryImage = item.getAttribute('data-secondary-image');

            img1.src = primaryImage;
            img1.style.display = 'block';

            if (secondaryImage) {
                img2.src = secondaryImage;
                img2.style.display = 'block';
            } else {
                img2.style.display = 'none';
            }
        }

        // Ajouter l'écouteur à chaque élément
        dresscodeItems.forEach(item => {
            item.addEventListener('click', () => {
                activateDresscodeItem(item);
            });
        });

        // ✅ Activation du premier élément par défaut
        activateDresscodeItem(dresscodeItems[0]);
    });
</script>
@endsection
