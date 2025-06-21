@extends('layouts.guest.app', [
    'header' => 'Message de la promo DS1 - DS2 2025 aux cadets',
    'noBreadcrumb' => true
])

@section('content')

<div class="max-w-4xl mx-auto p-4 sm:p-6 space-y-6 text-gray-400 my-8">
    <div class="border border-gray-700 bg-gray-800 p-6 rounded-xl shadow">
        @forelse ($messages as $message)
            <p class="text-gray-400 text-center mb-4 italic font-semibold">
                "
                {{ $message->message }}
                "
            </p>
            <div class="flex items-center justify-center space-x-4">
            <img src="{{ $message->user->profile_photo ?? asset('images/user.png') }}" class="w-7 h-7 md:w-12 md:h-12 rounded-full" alt="Image">
            <span class="font-bold text-white text-sm">{{ $message->user->first_name }} {{ $message->user->name }}</span>
            </div>
        @empty
            <p class="text-gray-400 text-center italic font-semibold">Aucun message enrégistré</p>
        @endforelse
    </div>
</div>

@endsection