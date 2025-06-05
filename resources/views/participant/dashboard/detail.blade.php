@extends('layouts.participant.app')

@section('content')
<div class="max-w-4xl mx-auto sm:p-6 space-y-6 text-gray-400 mb-16">

    <!-- SECTION ÉVÉNEMENT -->
    <div class="">
        <div class="mx-auto max-w-screen-xl">

            <!-- INFOS PRATIQUES -->
            <div class="grid md:grid-cols-3 gap-4 text-gray-300 mb-5 md:mb-8">
                <!-- Date -->
                <div class="flex flex-col justify-center items-center bg-gray-800 rounded-lg p-4 shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mb-2 text-yellow-500" fill="none" viewBox="0 0 16 16" stroke="currentColor">
                        <path d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2M1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857z"/>
                        <path d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
                    </svg>
                    <h3 class="text-white text-lg font-semibold mb-1">Date</h3>
                    <p class="text-center">
                        {{ ucfirst(\Carbon\Carbon::parse($event->starts_at)->translatedFormat('l, d F Y')) }}
                    </p>
                </div>

                <!-- Heure -->
                <div class="flex flex-col justify-center items-center bg-gray-800 rounded-lg p-4 shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mb-2 text-yellow-500" fill="none" viewBox="0 0 16 16" stroke="currentColor">
                        <path d="M6.5 0a.5.5 0 0 0 0 1H7v1.07A7.001 7.001 0 0 0 8 16a7 7 0 0 0 5.29-11.584l.013-.012.354-.354.353.354a.5.5 0 1 0 .707-.707l-1.414-1.415a.5.5 0 1 0-.707.707l.354.354-.354.354-.012.012A6.97 6.97 0 0 0 9 2.071V1h.5a.5.5 0 0 0 0-1zm2 5.6V9a.5.5 0 0 1-.5.5H4.5a.5.5 0 0 1 0-1h3V5.6a.5.5 0 1 1 1 0"/>
                    </svg>
                    <h3 class="text-white text-lg font-semibold mb-1">Heure</h3>
                    <p class="text-center">
                        {{ \Carbon\Carbon::parse($event->starts_at)->translatedFormat('H:i') }}
                    </p>
                </div>

                <!-- Lieu -->
                <div class="flex flex-col justify-center items-center bg-gray-800 rounded-lg p-4 shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mb-2 text-yellow-500" fill="none" viewBox="0 0 16 16" stroke="currentColor">
                        <path fill-rule="evenodd" d="M4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999zm2.493 8.574a.5.5 0 0 1-.411.575c-.712.118-1.28.295-1.655.493a1.3 1.3 0 0 0-.37.265.3.3 0 0 0-.057.09V14l.002.008.016.033a.6.6 0 0 0 .145.15c.165.13.435.27.813.395.751.25 1.82.414 3.024.414s2.273-.163 3.024-.414c.378-.126.648-.265.813-.395a.6.6 0 0 0 .146-.15l.015-.033L12 14v-.004a.3.3 0 0 0-.057-.09 1.3 1.3 0 0 0-.37-.264c-.376-.198-.943-.375-1.655-.493a.5.5 0 1 1 .164-.986c.77.127 1.452.328 1.957.594C12.5 13 13 13.4 13 14c0 .426-.26.752-.544.977-.29.228-.68.413-1.116.558-.878.293-2.059.465-3.34.465s-2.462-.172-3.34-.465c-.436-.145-.826-.33-1.116-.558C3.26 14.752 3 14.426 3 14c0-.599.5-1 .961-1.243.505-.266 1.187-.467 1.957-.594a.5.5 0 0 1 .575.411"/>
                    </svg>
                    <h3 class="text-white text-lg font-semibold mb-1">Lieu</h3>
                    <p class="text-center">
                        {{ ucfirst($event->location) }}
                    </p>
                </div>
            </div>

            <!-- Google Maps -->
            @if($event->location_latitude && $event->location_longitude)
            <div class="flex justify-center mb-5 md:mb-8">
                <div class="w-full max-w-lg max-h-64 aspect-video rounded-lg overflow-hidden shadow-md border">
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
            <div class="p-4 md:p-6 text-center mb-5 md:mb-8">
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
    <div class="w-full">
        <div class="flex justify-center items-center flex-col mx-auto max-w-screen-xl">

                <div class="w-full flex items-center justify-center mb-8">
                    <div class="gap-4 rounded-xl p-4 bg-gradient-to-r from-yellow-500 via-yellow-600 to-yellow-800 w-full text-center">
                        <h4 class="text-white font-bold text-xl">Dress code</h4>
                        <hr class="border border-dashed border-gray-200 my-3 md:my-8">
                        <p class="text-gray-200 font-semibold">{{ $event->dress_code }}</p>
                        <div class="mt-3 md:my-8 flex justify-center gap-3 md:gap-8 items-center">
                            <span class="rounded-full border border-white w-8 h-8 md:w-12 md:h-12" style="background: {{ $event->primary_color_hex }}"></span>
                            @if ($event->secondary_color_hex)
                            <span class="rounded-full border border-white w-8 h-8 md:w-12 md:h-12" style="background: {{ $event->secondary_color_hex }}"></span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- IMAGES DYNAMIQUES -->
            <div class="flex justify-center gap-4 items-center" id="dresscode-images">
                <img id="img1" class="w-full rounded-lg" src="{{ $event->primary_image }}" alt="Image principale">
                @if ($event->secondary_image)
                <img id="img2" class="w-full rounded-lg" src="{{ $event->secondary_image }}" alt="Image secondaire">
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
