@extends('layouts.participant.app')

@section('content')
<div class="max-w-4xl mx-auto sm:p-6 space-y-6 text-gray-400 mb-16">

    <!-- SECTION ÉVÉNEMENT -->
    <div class="md:px-16 lg:px-24">
        <div class="py-12 mx-auto max-w-screen-xl">

            <!-- INFOS PRATIQUES -->
            <div class="grid md:grid-cols-3 gap-4 text-gray-300">
                <!-- Date -->
                <div class="flex flex-col justify-center items-center bg-gray-800 rounded-lg p-4 shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mb-2 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3M16 7V3M3 11h18M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <h3 class="text-white text-lg font-semibold mb-1">Date</h3>
                    <p class="text-center">
                        {{ ucfirst(\Carbon\Carbon::parse($event->starts_at)->translatedFormat('l, d F Y')) }}
                    </p>
                </div>

                <!-- Heure -->
                <div class="flex flex-col justify-center items-center bg-gray-800 rounded-lg p-4 shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mb-2 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="text-white text-lg font-semibold mb-1">Heure</h3>
                    <p class="text-center">
                        {{ \Carbon\Carbon::parse($event->starts_at)->translatedFormat('H:i') }}
                    </p>
                </div>

                <!-- Lieu -->
                <div class="flex flex-col justify-center items-center bg-gray-800 rounded-lg p-4 shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mb-2 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 21a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <h3 class="text-white text-lg font-semibold mb-1">Lieu</h3>
                    <p class="text-center">
                        {{ ucfirst($event->location) }}
                    </p>
                </div>
            </div>

            <!-- Google Maps -->
            @if($event->location_latitude && $event->location_longitude)
            <div class="flex justify-center">
                <div class="w-full max-w-lg aspect-video rounded-lg overflow-hidden shadow-md border">
                    <iframe
                        class="w-full h-full"
                        src="https://www.google.com/maps?q={{ $event->location_latitude }},{{ $event->location_longitude }}&hl=fr&z=16&output=embed"
                        allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
            @endif

            <!-- PROGRAMME -->
            @if ($event->programs->isNotEmpty())
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
    </div>

    <!-- SECTION DRESS CODE -->
    <div class="px-5 md:px-16">
        <div class="flex justify-center items-center flex-col mx-auto max-w-screen-xl">

                <div class="w-full flex items-center justify-center" id="dresscode-options">
                    <div class="dresscode-item cursor-pointer gap-4 rounded-xl p-4 bg-gradient-to-r from-yellow-500 via-yellow-600 to-yellow-800 card text-center">
                        <h4 class="text-white font-bold text-xl">Dress code</h4>
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
            </div>

            <!-- IMAGES DYNAMIQUES -->
            <div class="flex justify-center gap-4 items-center" id="dresscode-images">
                <img id="img1" class="w-full rounded-lg" src="{{ $event->primary_image }}" alt="Image principale" style="display: block;">
                @if ($event->secondary_image)
                <img id="img2" class="mt-4 w-full lg:mt-10 rounded-lg" src="{{ $event->secondary_image }}" alt="Image secondaire" style="display: block;">
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
