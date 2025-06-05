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
                <img src="{{ asset('storage/public/' . basename($slide->image)) }}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
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

</div>

@endsection
