@extends('layouts.participant.app')

@section('content')

<div class="max-w-4xl mx-auto sm:p-6 space-y-4 text-gray-400 mb-20">
    @forelse ($discussions as $disc)
        <a href="{{ route('participant.notification.show', ['threadKey' => $disc->thread_key]) }}">
            <div class="flex items-center {{ !$disc->all_read ? 'bg-gray-700 border border-white' : 'bg-gray-800' }} mb-4 rounded-xl shadow-xl p-5 cursor-pointer">
                <div class="relative inline-block shrink-0">
                    <img class="w-12 h-12 rounded-full" src="{{ asset('images/user.png') }}" alt="user"/>

                    @if (!$disc->all_read && $disc->unread_count > 0)
                        <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs font-bold w-5 h-5 flex items-center justify-center rounded-full">
                            {{ $disc->unread_count }}
                        </span>
                    @endif
                </div>

                <div class="ms-3 text-sm">
                    <div class="text-sm font-bold text-white mb-1">
                        {{ $disc->interlocutor }}
                        @if($disc->is_self_anonymous)
                            <span class="italic font-medium text-gray-300">(vous êtes anonyme)</span>
                        @endif
                    </div>
                    <div class="text-sm font-semibold text-gray-300">
                        {{ $disc->last_message }}
                    </div>
                    <span class="text-xs font-medium text-yellow-600">{{ $disc->elapsed }}</span>
                </div>
            </div>
        </a>
    @empty
        <p class="text-gray-400 text-sm text-center py-16">Aucune discussion en cours.</p>
    @endforelse
</div>

@endsection
