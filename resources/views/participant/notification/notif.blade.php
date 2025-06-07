@extends('layouts.participant.app', [
    'noPadding' => true,
])

@section('content')

<div class="w-full text-gray-400 mb-16">

    @if ($notifications->isNotEmpty())
        @forelse ($notifications as $msg)
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

            <a href="{{ $msg->data['url'] ?? '#' }}" class="block w-full cursor-pointer {{ !$loop->last ? 'border-b border-gray-800' : '' }}">
                <div id="section-{{ $msg->id }}"
                    class="w-full flex items-center p-5 cursor-pointer border-l-4 {{ $styles }}">
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
        @empty
        <p class="text-gray-400 italic text-center">Aucune notification enrégistrée</p>
        @endforelse
    @endif

</div>

@endsection
