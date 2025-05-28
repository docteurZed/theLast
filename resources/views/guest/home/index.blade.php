@extends('layouts.guest.app', [
    'home' => true,
])

@section('content')

<section class="section px-5 md:px-16 lg:px-24">
    <div class="fade-section gap-16 items-center py-8 mx-auto max-w-screen-xl lg:grid lg:grid-cols-2 lg:py-16">
        <div class="font-light sm:text-lg text-gray-400">
            <p class="mb-2 font-semibold fs-12 bg-gradient-to-r from-yellow-600 to-yellow-800 bg-clip-text text-transparent">{{ $sections['about']->name }}</p>
            <h2 class="mb-5 text-3xl md:text-4xl tracking-tight font-extrabold text-white">{{ $sections['about']->title }}</h2>
            <p class="mb-3 font-medium">{{ $sections['about']->description }}</p>
            <div class="font-medium">
                <div class="mt-6">
                    <a href="{{ route('about') }}" class="inline-block bg-gradient-to-r from-yellow-500 via-yellow-600 to-yellow-800 text-white px-6 py-3 rounded-lg font-semibold shadow-md hover:opacity-90 transition">
                        En savoir plus
                    </a>
                </div>
            </div>
        </div>
        <div class="gap-4 mt-8 flex justify-center">
            <img class="w-full rounded-lg" src="{{ asset('images/about.jpg') }}" alt="office content 1">
        </div>
    </div>
</section>

<section id="parallax-section" class="w-full bg-center bg-cover bg-[url('{{ asset('images/bg.jpg') }}')] bg-blend-multiply bg-gray-900/80">

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

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10 justify-center">
            @foreach ($guests as $guest)
            <div class="card rounded-xl p-6 shadow hover:shadow-lg transition">
                <img class="w-24 h-24 mx-auto rounded-full mb-4 object-cover" src="{{ $guest->image ?? asset('images/user.png') }}" alt="Invité 1">
                <h3 class="text-xl font-bold text-white">{{ ucfirst($guest->title) }}. {{ ucfirst($guest->name) }}</h3>
                <p class="text-sm text-yellow-600 font-semibold mb-2">{{ ucfirst($guest->role) }} • {{ ucfirst($guest->domain) }}</p>
                <p class="text-gray-400 text-sm">{{ ucfirst($guest->description) }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<section class="section px-5 md:px-16 lg:px-24 text-center">
    <div class="fade-section gap-16 items-center py-8 mx-auto max-w-screen-xl lg:py-16">
        <div class="font-light sm:text-lg text-gray-400">
            <p class="mb-2 font-semibold fs-12 bg-gradient-to-r from-yellow-600 to-yellow-800 bg-clip-text text-transparent">{{ $sections['galerie']->name }}</p>
            <h2 class="mb-5 lg:mb-8 text-3xl md:text-4xl tracking-tight font-extrabold text-white">{{ $sections['galerie']->title }}</h2>
            <p class="text-lg text-gray-400 mb-12">{{ $sections['galerie']->description }}</p>
            <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-8">
                <div>
                    <img class="h-auto max-w-full rounded-lg" src="{{ asset('images/img-01.jpg') }}" alt="">
                </div>
                <div>
                    <img class="h-auto max-w-full rounded-lg" src="{{ asset('images/img-02.jpg') }}" alt="">
                </div>
                <div>
                    <img class="h-auto max-w-full rounded-lg" src="{{ asset('images/img-03.jpg') }}" alt="">
                </div>
                <div>
                    <img class="h-auto max-w-full rounded-lg" src="{{ asset('images/img-04.jpg') }}" alt="">
                </div>
                <div>
                    <img class="h-auto max-w-full rounded-lg" src="{{ asset('images/img-05.jpg') }}" alt="">
                </div>
                <div>
                    <img class="h-auto max-w-full rounded-lg" src="{{ asset('images/img-06.jpg') }}" alt="">
                </div>
                <div>
                    <img class="h-auto max-w-full rounded-lg" src="{{ asset('images/img-07.jpg') }}" alt="">
                </div>
                <div>
                    <img class="h-auto max-w-full rounded-lg" src="{{ asset('images/img-08.jpg') }}" alt="">
                </div>
                <div>
                    <img class="h-auto max-w-full rounded-lg" src="{{ asset('images/img-09.jpg') }}" alt="">
                </div>
                <div>
                    <img class="h-auto max-w-full rounded-lg" src="{{ asset('images/img-10.jpg') }}" alt="">
                </div>
                <div>
                    <img class="h-auto max-w-full rounded-lg" src="{{ asset('images/img-11.jpg') }}" alt="">
                </div>
                <div>
                    <img class="h-auto max-w-full rounded-lg" src="{{ asset('images/img-12.jpg') }}" alt="">
                </div>
            </div>
        </div>
    </div>
</section>

@if ($testimonies->isNotEmpty())
<section class="{{ $testimonies->isNotEmpty() ? 'section' : '' }} px-5 md:px-16 lg:px-24 text-center bg-gray-950">
    <div class="fade-section gap-16 items-center py-8 mx-auto max-w-screen-xl lg:py-16">
        <div class="font-light sm:text-lg text-gray-400">
            <p class="mb-2 font-semibold fs-12 bg-gradient-to-r from-yellow-600 to-yellow-800 bg-clip-text text-transparent">{{ $sections['testimony']->name }}</p>
            <h2 class="mb-5 text-3xl md:text-4xl tracking-tight font-extrabold text-white">{{ $sections['testimony']->title }}</h2>
            <p class="mt-3 mb-5 lg:mb-8 text-gray-400">{{ $sections['testimony']->description }}</p>
            <!-- Swiper Container -->
            <div class="swiper mySwiper max-w-3xl mx-auto">
                <div class="swiper-wrapper">
                    <!-- Slide 1 -->
                    @foreach ($testimonies as $testimony)
                    <div class="swiper-slide card p-6 rounded-xl shadow">
                        <p class="text-gray-400 mb-4 italic">
                            "{{ $testimony->testimony }}"
                        </p>
                        <div class="flex items-center justify-center space-x-4">
                        <img src="{{ $testimony->image ?? asset('images/user.png') }}" class="w-12 h-12 rounded-full" alt="Etudiante 1">
                        <span class="font-semibold text-white">{{ ucfirst($testimony->name) }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endif

@if ($sponsors->isNotEmpty())
<section class="{{ $sponsors->isNotEmpty() ? 'section' : '' }} px-5 md:px-16 lg:px-24 text-center">
    <div class="fade-section fade-right gap-16 items-center py-8 mx-auto max-w-screen-xl lg:py-16">
        <div class="font-light sm:text-lg text-gray-400">
            <p class="mb-2 font-semibold fs-12 bg-gradient-to-r from-yellow-600 to-yellow-800 bg-clip-text text-transparent">{{ $sections['sponsor']->name }}</p>
            <h2 class="mb-5 lg:mb-8 text-3xl md:text-4xl tracking-tight font-extrabold text-white">{{ $sections['sponsor']->title }}</h2>
            <p class="mt-3 mb-5 lg:mb-8 text-gray-400">{{ $sections['sponsor']->description }}</p>
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
    const eventDate = "{{ \Carbon\Carbon::parse($setting->decompt_event_date)->format('Y-m-d') }}";
    const eventTime = "{{ \Carbon\Carbon::parse($setting->decompt_event_time)->format('H:i') }}";

    // Crée la date finale pour JavaScript
    const countDownDate = new Date(`${eventDate}T${eventTime}:00`).getTime();

    const countdown = setInterval(function () {
        const now = new Date().getTime();
        const distance = countDownDate - now;

        if (distance < 0) {
            clearInterval(countdown);
            document.querySelectorAll("#days, #hours, #minutes, #seconds").forEach(el => el.innerText = "00");
            return;
        }

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.getElementById("days").innerText = String(days).padStart(2, "0");
        document.getElementById("hours").innerText = String(hours).padStart(2, "0");
        document.getElementById("minutes").innerText = String(minutes).padStart(2, "0");
        document.getElementById("seconds").innerText = String(seconds).padStart(2, "0");
    }, 1000);

</script>

@endsection
