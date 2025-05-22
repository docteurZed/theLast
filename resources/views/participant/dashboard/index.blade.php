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

    @php
        $notifications = Auth::user()->notifications->filter(function ($notification) {
            return $notification->created_at > \Carbon\Carbon::create(2025, 5, 22, 15, 0, 0);
        })->sortByDesc('created_at');
    @endphp

    @if ($notifications->isNotEmpty())
        @foreach ($notifications as $msg)
            @php
                $type = $msg->data['type'] ?? 'default';

                // Définir les styles et icônes selon le type
                $styles = match ($type) {
                    'like' => 'border-red-700',
                    'comment' => 'border-blue-700',
                    'message' => 'border-green-700',
                    'vote' => 'border-yellow-700',
                    default => 'border-gray-600',
                };

                $icons = match ($type) {
                    'like' => 'M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 18.657l-6.828-6.829a4 4 0 010-5.656z',
                    'comment' => 'M2 5a2 2 0 012-2h12a2 2 0 012 2v9a2 2 0 01-2 2H6l-4 4V5z',
                    'message' => 'M2.003 5.884l8 4.8a1 1 0 00.994 0l8-4.8A1 1 0 0018 5H2a1 1 0 00.003.884z M2 8.118V14a1 1 0 001 1h14a1 1 0 001-1V8.118l-7.5 4.5L2 8.118z',
                    'vote' => 'M10 2a8 8 0 100 16 8 8 0 000-16zm1 12H9v-2h2v2zm0-4H9V6h2v4z',
                    default => 'M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z',
                };
            @endphp

            <a href="{{ $msg->data['url'] }}" class="block w-full cursor-pointer">
                <div id="section-{{ $msg->id }}"
                    class="flex items-center bg-gray-800 mb-4 rounded-xl shadow-xl p-5 cursor-pointer border-l-4 {{ $styles }}">
                    <div class="relative inline-block shrink-0">
                        <span class="inline-flex items-center justify-center w-8 h-8 bg-white rounded-full">
                            <svg class="w-4 h-4 text-gray-800" fill="currentColor" viewBox="0 0 24 24">
                                <path d="{{ $icons }}" />
                            </svg>
                        </span>
                    </div>

                    <div class="ms-3 text-sm">
                        <div class="text-sm font-semibold text-white">
                            {{ $msg->data['message'] }}
                        </div>
                        <span class="text-xs font-medium text-yellow-500 mt-2 block">
                            {{ $msg->created_at->diffForHumans() }}
                        </span>
                    </div>
                </div>
            </a>
        @endforeach
    @endif

</div>

@endsection
