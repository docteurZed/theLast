@extends('layouts.participant.app')

@section('content')

<div class="max-w-4xl mx-auto sm:p-6 space-y-6 text-gray-400 mb-16">
    @php
        $user = Auth::user();
        $hour = now()->hour;
        $isMorning = ($hour >= 0 && $hour < 14);
        $greeting = $isMorning ? 'Bonjour' : 'Bonsoir';
        $icon = $isMorning ? '🌞' : '🌜';
    @endphp

    @if($user)
        <div class="mb-6 flex items-center space-x-3 text-white">
            <span class="text-2xl sm:text-3xl animate-pulse">{{ $icon }}</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold tracking-wide">
                {{ $greeting }}
                <span class="text-yellow-600">
                    {{ ucfirst($user->first_name) }} {{ ucfirst($user->name) }}
                </span>
            </h2>
        </div>
    @endif

    {{-- @if ($slides->isNotEmpty())
    <div id="default-carousel" class="relative w-full" data-carousel="slide">
        <!-- Carousel wrapper -->
        <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
            @foreach ($slides as $slide)
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="{{ $slide->image }}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
            @endforeach
        </div>
    </div>
    @endif --}}

    <div class="relative w-full">
        <!-- Carousel wrapper -->
        <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
            <img src="{{ asset('images/bg-1.jpg') }}" class="block w-full" alt="...">
        </div>
    </div>

    @if ($events->isNotEmpty())
    <div>

        <div id="accordion-collapse" data-accordion="collapse">
            <h2 id="accordion-collapse-heading-1">
                <button type="button" class="flex items-center justify-between w-full p-5 font-medium rtl:text-right border rounded-t-xl focus:ring-4 focus:ring-gray-800 border-gray-700 text-gray-400 hover:bg-gray-800 gap-3" data-accordion-target="#accordion-collapse-body-1" aria-expanded="true" aria-controls="accordion-collapse-body-1">
                    <span class="font-bold text-xl">Nos fururs événements</span>
                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                    </svg>
                </button>
            </h2>
            <div id="accordion-collapse-body-1" class="hidden" aria-labelledby="accordion-collapse-heading-1">
                <div class="p-5 border border-t-0 border-gray-700 bg-gray-900 rounded-b-xl">
                    @foreach($events as $evenement)
                    <div class="mb-6 p-6 border border-gray-700 rounded-2xl bg-gray-800 text-gray-200 shadow-lg hover:shadow-xl transition-shadow duration-300 text-center md:text-start">
                        <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                            <div class="w-full md:w-3/4">
                                <h3 class="text-2xl font-extrabold text-white mb-5 flex gap-3 items-center justify-center md:justify-start">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6" viewBox="0 0 16 16">
                                        <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2m-3.5-7h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5"/>
                                    </svg>
                                    {{ $evenement->name }}
                                </h3>

                                <div class="grid grid-cols-3 items-start justify-center md:justify-start gap-4 text-sm text-gray-400 mb-4">
                                    <div class="flex flex-col md:flex-row items-center gap-2">
                                        <span class="flex items-center justify-center p-2 bg-yellow-500 rounded-full text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-5 h-5" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999zm2.493 8.574a.5.5 0 0 1-.411.575c-.712.118-1.28.295-1.655.493a1.3 1.3 0 0 0-.37.265.3.3 0 0 0-.057.09V14l.002.008.016.033a.6.6 0 0 0 .145.15c.165.13.435.27.813.395.751.25 1.82.414 3.024.414s2.273-.163 3.024-.414c.378-.126.648-.265.813-.395a.6.6 0 0 0 .146-.15l.015-.033L12 14v-.004a.3.3 0 0 0-.057-.09 1.3 1.3 0 0 0-.37-.264c-.376-.198-.943-.375-1.655-.493a.5.5 0 1 1 .164-.986c.77.127 1.452.328 1.957.594C12.5 13 13 13.4 13 14c0 .426-.26.752-.544.977-.29.228-.68.413-1.116.558-.878.293-2.059.465-3.34.465s-2.462-.172-3.34-.465c-.436-.145-.826-.33-1.116-.558C3.26 14.752 3 14.426 3 14c0-.599.5-1 .961-1.243.505-.266 1.187-.467 1.957-.594a.5.5 0 0 1 .575.411"/>
                                            </svg>
                                        </span>
                                        <span class="font-semibold">{{ $evenement->location }}</span>
                                    </div>

                                    <div class="flex flex-col md:flex-row items-center gap-2">
                                        <span class="flex items-center justify-center p-2 bg-yellow-500 rounded-full text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-5 h-5" viewBox="0 0 16 16">
                                                <path d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2M1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857z"/>
                                                <path d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
                                            </svg>
                                        </span>
                                        <span class="font-semibold">{{ \Carbon\Carbon::parse($evenement->starts_at)->translatedFormat('d F Y') }}</span>
                                    </div>

                                    <div class="flex flex-col md:flex-row items-center gap-2">
                                        <span class="flex items-center justify-center p-2 bg-yellow-500 rounded-full text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-5 h-5" viewBox="0 0 16 16">
                                                <path d="M6.5 0a.5.5 0 0 0 0 1H7v1.07A7.001 7.001 0 0 0 8 16a7 7 0 0 0 5.29-11.584l.013-.012.354-.354.353.354a.5.5 0 1 0 .707-.707l-1.414-1.415a.5.5 0 1 0-.707.707l.354.354-.354.354-.012.012A6.97 6.97 0 0 0 9 2.071V1h.5a.5.5 0 0 0 0-1zm2 5.6V9a.5.5 0 0 1-.5.5H4.5a.5.5 0 0 1 0-1h3V5.6a.5.5 0 1 1 1 0"/>
                                            </svg>
                                        </span>
                                        <span class="font-semibold">{{ \Carbon\Carbon::parse($evenement->starts_at)->translatedFormat('H\hi') }}</span>
                                    </div>
                                </div>

                                <div class="flex flex-col md:flex-row items-center gap-2 text-sm">
                                    <span class="text-gray-400">Début dans :</span>
                                    <span class="font-semibold px-3 py-1 rounded-lg bg-gray-700 text-yellow-500 countdown shadow-inner"
                                        data-date="{{ $evenement->starts_at }}">
                                        Chargement...
                                    </span>
                                </div>
                            </div>

                            <div class="w-full md:w-1/4 flex gap-3 md:items-center justify-center mt-4 md:mt-0">
                                <a href="{{ route('participant.event.detail', ['id' => $evenement->id]) }}"
                                class="bg-gradient-to-r from-yellow-500 via-yellow-600 to-yellow-800 text-white px-6 py-3 rounded-lg font-semibold shadow-md hover:opacity-90 transition w-full sm:w-auto px-5 py-2.5 text-center cursor-pointer">
                                    Détail
                                </a>
                                <a href="#"
                                class="bg-gray-700 text-white px-6 py-3 rounded-lg font-semibold shadow-md hover:bg-gray-600 transition w-full sm:w-auto px-5 py-2.5 text-center cursor-pointer">
                                    Album
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const countdowns = document.querySelectorAll('.countdown');

        countdowns.forEach(function (el) {
            const targetDate = new Date(el.dataset.date);

            function updateCountdown() {
                const now = new Date();
                const diff = targetDate - now;

                if (diff <= 0) {
                    el.textContent = 'En cours ou terminé';
                    el.classList.remove('text-green-400');
                    el.classList.add('text-red-400');
                    return;
                }

                const days = Math.floor(diff / (1000 * 60 * 60 * 24));
                const hours = Math.floor((diff / (1000 * 60 * 60)) % 24);
                const minutes = Math.floor((diff / 1000 / 60) % 60);
                const seconds = Math.floor((diff / 1000) % 60);

                el.textContent = `${days}j ${hours}h ${minutes}m ${seconds}s`;
            }

            updateCountdown();
            setInterval(updateCountdown, 1000);
        });
    });
</script>

@endsection
