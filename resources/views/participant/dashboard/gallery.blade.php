@extends('layouts.participant.app')

@section('content')

<div class="max-w-4xl mx-auto sm:p-6 space-y-6 text-gray-400 mb-16">

    <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-4 md:gap-6">
        @forelse ($images as $image)
        <div class="flex flex-col items-center w-full gap-2">
            <img class="h-auto max-w-full rounded-lg" src="{{ $image->path }}" alt="">
            <span class="text-sm text-center text-white">{{ $image->description }}</span>
        </div>
        @empty
        <p class="text-gray-400 italic text-center w-full">Aucune image enrégistrée pour cet événement</p>
        @endforelse
    </div>

</div>

@endsection
