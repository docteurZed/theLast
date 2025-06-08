@extends('layouts.participant.app', [
    'noPadding' => true,
])

@section('content')
<div class="text-gray-400 mb-20">
    <!-- Bannière -->
    <div class="relative h-24 sm:h-40 h-56 w-full">
        <img src="{{ $user->banner_image ?? asset('images/banner-default.jpg') }}" class="w-full h-full object-cover" alt="Bannière">

        <!-- Photo de profil superposée -->
        <div class="absolute -bottom-12 left-1/2 transform -translate-x-1/2 z-10">
            <img src="{{ $user->profile_photo ?? asset('images/user.png') }}"
                class="w-24 h-24 md:w-32 md:h-32 rounded-full border-4 border-gray-800 shadow-lg object-cover" alt="Photo de profil">
        </div>
    </div>

    @if (Session::has('success'))
        <div id="alert-1" class="flex items-center p-4 bg-gray-800 text-green-400 rounded-xl mt-16 mx-6" role="alert">
            <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <div class="ms-3 text-sm font-semibold">
                {{ Session::get('success') }}
            </div>
            <button type="button" class="ms-auto -mx-1.5 -my-1.5 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 inline-flex items-center justify-center h-8 w-8 bg-gray-800 text-green-400 hover:bg-green-700" data-dismiss-target="#alert-1" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>
        @elseif ($errors->any())
            @foreach ($errors->all() as $error)
            <div id="alert-1" class="flex items-center p-4 bg-gray-800 text-red-400 rounded-xl mt-16 mx-6" role="alert">
                <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="sr-only">Info</span>
                <div class="ms-3 text-sm font-semibold">
                    {{ $error }}
                </div>
                <button type="button" class="ms-auto -mx-1.5 -my-1.5 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 inline-flex items-center justify-center h-8 w-8 bg-gray-800 text-red-400 hover:bg-red-700" data-dismiss-target="#alert-1" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
            </div>
            @endforeach
        @endif

    <!-- Informations principales -->
    <div class="mt-16 text-center px-4">
        <h2 class="text-2xl md:text-3xl font-bold text-white">{{ ucfirst($user->first_name) }} {{ ucfirst($user->name) }}</h2>
        <p class="text-sm text-gray-400 mt-2 md:mt-4 text-gray-200 mx-4 md:mx-8">{{ $user->bio }}</p>

        <div class="flex justify-center space-x-4 mt-4">
            @if ($user->social_links->isNotEmpty() && $user->id != Auth::user()->id)
                <div class="w-full flex justify-center items-center gap-4 mt-4">
                    @foreach ($user->social_links as $link)
                        @switch($link->platform)
                            @case('facebook')
                                <a href="{{ $link->url }}" target="_blank" class="hover:text-blue-500 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-5 h-5" viewBox="0 0 16 16">
                                        <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"/>
                                    </svg>
                                </a>
                                @break
                            @case('x')
                                <a href="{{ $link->url }}" target="_blank" class="hover:text-blue-400 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-5 h-5" viewBox="0 0 16 16">
                                        <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z"/>
                                    </svg>
                                </a>
                                @break
                            @case('linkedin')
                                <a href="{{ $link->url }}" target="_blank" class="hover:text-blue-300 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-5 h-5" viewBox="0 0 16 16">
                                        <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854zm4.943 12.248V6.169H2.542v7.225zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248S2.4 3.226 2.4 3.934c0 .694.521 1.248 1.327 1.248zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016l.016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225z"/>
                                    </svg>
                                </a>
                                @break
                            @case('instagram')
                                <a href="{{ $link->url }}" target="_blank" class="hover:text-pink-500 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-5 h-5" viewBox="0 0 16 16">
                                        <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334"/>
                                    </svg>
                                </a>
                                @break
                            @case('whatsapp')
                                <a href="{{ $link->url }}" target="_blank" class="hover:text-green-500 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-5 h-5" viewBox="0 0 16 16">
                                        <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/>
                                    </svg>
                                </a>
                                @break
                            @case('tiktok')
                                <a href="{{ $link->url }}" target="_blank" class="hover:text-gray-950 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-5 h-5" viewBox="0 0 16 16">
                                        <path d="M9 0h1.98c.144.715.54 1.617 1.235 2.512C12.895 3.389 13.797 4 15 4v2c-1.753 0-3.07-.814-4-1.829V11a5 5 0 1 1-5-5v2a3 3 0 1 0 3 3z"/>
                                    </svg>
                                </a>
                                @break
                        @endswitch
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <!-- Actions -->
    <div class="flex flex-wrap justify-center gap-4 mt-6">
        <button id="like-btn-{{ $user->id }}" class="flex items-center gap-2 border px-4 py-2 rounded-lg hover:bg-gray-700 transition cursor-pointer {{ Auth::user()->hasLiked($user) ? 'text-yellow-500 border-yellow-500' : 'text-white border-gray-500' }}" onclick="sendLike({{ $user->id }})">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="h-4 w-4" viewBox="0 0 16 16">
                <path d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2 2 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a10 10 0 0 0-.443.05 9.4 9.4 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a9 9 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.2 2.2 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.9.9 0 0 1-.121.416c-.165.288-.503.56-1.066.56z"/>
            </svg>
            <span class="text-sm font-semibold">J'aime</span>
        </button>
        <button class="flex items-center gap-2 text-white border border-gray-600 px-4 py-2 rounded-lg hover:bg-gray-700 transition cursor-pointer" data-modal-target="message-modal-{{ $user->id }}" data-modal-toggle="message-modal-{{ $user->id }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="h-4 w-4" viewBox="0 0 16 16">
                <path d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0m4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0m3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
                <path d="m2.165 15.803.02-.004c1.83-.363 2.948-.842 3.468-1.105A9 9 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.4 10.4 0 0 1-.524 2.318l-.003.011a11 11 0 0 1-.244.637c-.079.186.074.394.273.362a22 22 0 0 0 .693-.125m.8-3.108a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6-3.004 6-7 6a8 8 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a11 11 0 0 0 .398-2"/>
            </svg>
            <span class="text-sm font-semibold">Message</span>
        </button>
        <button class="flex items-center gap-2 text-white border border-gray-600 px-4 py-2 rounded-lg hover:bg-gray-700 transition cursor-pointer" data-modal-target="vote-modal-{{ $user->id }}" data-modal-toggle="vote-modal-{{ $user->id }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="h-4 w-4" viewBox="0 0 16 16">
                <path d="M2.5.5A.5.5 0 0 1 3 0h10a.5.5 0 0 1 .5.5q0 .807-.034 1.536a3 3 0 1 1-1.133 5.89c-.79 1.865-1.878 2.777-2.833 3.011v2.173l1.425.356c.194.048.377.135.537.255L13.3 15.1a.5.5 0 0 1-.3.9H3a.5.5 0 0 1-.3-.9l1.838-1.379c.16-.12.343-.207.537-.255L6.5 13.11v-2.173c-.955-.234-2.043-1.146-2.833-3.012a3 3 0 1 1-1.132-5.89A33 33 0 0 1 2.5.5m.099 2.54a2 2 0 0 0 .72 3.935c-.333-1.05-.588-2.346-.72-3.935m10.083 3.935a2 2 0 0 0 .72-3.935c-.133 1.59-.388 2.885-.72 3.935M3.504 1q.01.775.056 1.469c.13 2.028.457 3.546.87 4.667C5.294 9.48 6.484 10 7 10a.5.5 0 0 1 .5.5v2.61a1 1 0 0 1-.757.97l-1.426.356a.5.5 0 0 0-.179.085L4.5 15h7l-.638-.479a.5.5 0 0 0-.18-.085l-1.425-.356a1 1 0 0 1-.757-.97V10.5A.5.5 0 0 1 9 10c.516 0 1.706-.52 2.57-2.864.413-1.12.74-2.64.87-4.667q.045-.694.056-1.469z"/>
            </svg>
            <span class="text-sm font-semibold">Voter</span>
        </button>
        <button class="flex items-center gap-2 text-white border border-gray-600 px-4 py-2 rounded-lg hover:bg-gray-700 transition cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="h-4 w-4" viewBox="0 0 16 16">
                <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z"/>
            </svg>
            <span class="text-sm font-semibold">Noter</span>
        </button>
    </div>

    <!-- Détails -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-10 px-4 md:px-8">

        @if ($user->educations->isNotEmpty())
        <div class="bg-gray-800 rounded-lg shadow-sm">
            <h3 class="text-2xl font-extrabold flex items-center gap-2 border-b border-gray-700 p-4 text-yellow-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-5 h-5" viewBox="0 0 16 16">
                    <path d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917z"/>
                    <path d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466z"/>
                </svg>
                Formations
            </h3>
            @foreach ($user->educations as $education)
                @php
                    $start_date = \Carbon\Carbon::parse($education->start_date)->translatedFormat('Y');
                    $end_date = \Carbon\Carbon::parse($education->end_date)->translatedFormat('Y') ?? null;
                @endphp
            <div class="px-4 py-6 {{ !$loop->last ? 'border-b' : '' }} border-dashed border-gray-700">
                <div class="font-bold text-xl text-white mb-2 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-4 h-4" viewBox="0 0 16 16">
                        <path d="m8 0 1.669.864 1.858.282.842 1.68 1.337 1.32L13.4 6l.306 1.854-1.337 1.32-.842 1.68-1.858.282L8 12l-1.669-.864-1.858-.282-.842-1.68-1.337-1.32L2.6 6l-.306-1.854 1.337-1.32.842-1.68L6.331.864z"/>
                        <path d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1z"/>
                    </svg>
                    {{ $education->degree }}
                </div>
                <div class="flex justify-between items-center mb-2 font-semibold">
                    <p class="text-gray-200">{{ $education->institution }}</p>
                    <p class="md:mr-8 text-sm text-yellow-600">
                        {{ $start_date }}
                        {{ isset($end_date) && $end_date != $start_date ? ' - ' . $end_date : ''  }}
                    </p>
                </div>
                <p class="text-sm">{{ $education->description }}</p>
            </div>
            @endforeach
        </div>
        @endif

        @if ($user->experiences->isNotEmpty())
        <div class="bg-gray-800 rounded-lg shadow-sm">
            <h3 class="text-2xl font-extrabold flex items-center gap-2 border-b border-gray-700 p-4 text-yellow-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-5 h-5" viewBox="0 0 16 16">
                    <path d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v1.384l7.614 2.03a1.5 1.5 0 0 0 .772 0L16 5.884V4.5A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5"/>
                    <path d="M0 12.5A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5V6.85L8.129 8.947a.5.5 0 0 1-.258 0L0 6.85z"/>
                </svg>
                Expériences
            </h3>
            @foreach ($user->experiences as $experience)
                @php
                    $start_date = \Carbon\Carbon::parse($experience->start_date)->translatedFormat('Y');
                    $end_date = \Carbon\Carbon::parse($experience->end_date)->translatedFormat('Y') ?? null;
                @endphp
            <div class="px-4 py-6 {{ !$loop->last ? 'border-b' : '' }} border-dashed border-gray-700">
                <div class="font-bold text-xl text-white mb-2 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-4 h-4" viewBox="0 0 16 16">
                        <path d="M2 2v13.5a.5.5 0 0 0 .74.439L8 13.069l5.26 2.87A.5.5 0 0 0 14 15.5V2a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2"/>
                    </svg>
                    {{ $experience->title }}
                </div>
                <div class="flex justify-between items-center mb-2 font-semibold">
                    <p class="text-gray-200">{{ $experience->company }}</p>
                    <p class="md:mr-8 text-sm text-yellow-600">
                        {{ $start_date }}
                        {{ isset($end_date) && $end_date != $start_date ? ' - ' . $end_date : ''  }}
                    </p>
                </div>
                <p class="text-sm">{{ $experience->description }}</p>
            </div>
            @endforeach
        </div>
        @endif

        @if ($user->achievements->isNotEmpty())
        <div class="bg-gray-800 rounded-lg shadow-sm">
            <h3 class="text-2xl font-extrabold flex items-center gap-2 border-b border-gray-700 p-4 text-yellow-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-5 h-5" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 0c-.69 0-1.843.265-2.928.56-1.11.3-2.229.655-2.887.87a1.54 1.54 0 0 0-1.044 1.262c-.596 4.477.787 7.795 2.465 9.99a11.8 11.8 0 0 0 2.517 2.453c.386.273.744.482 1.048.625.28.132.581.24.829.24s.548-.108.829-.24a7 7 0 0 0 1.048-.625 11.8 11.8 0 0 0 2.517-2.453c1.678-2.195 3.061-5.513 2.465-9.99a1.54 1.54 0 0 0-1.044-1.263 63 63 0 0 0-2.887-.87C9.843.266 8.69 0 8 0m2.146 5.146a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793z"/>
                </svg>
                Réalisations
            </h3>
            @foreach ($user->achievements as $achievement)
            <div class="px-4 py-6 {{ !$loop->last ? 'border-b' : '' }} border-dashed border-gray-700">
                <div class="flex justify-between items-center mb-2 font-semibold">
                    <p class="text-white text-xl flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-4 h-4" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                        </svg>
                        {{ $achievement->title }}
                    </p>
                    <p class="md:mr-8 text-sm text-yellow-600">
                        {{ \Carbon\Carbon::parse($achievement->date)->translatedFormat('Y') }}
                    </p>
                </div>
                <p class="text-sm">{{ $achievement->description }}</p>
            </div>
            @endforeach
        </div>
        @endif

        @if ($user->skills->isNotEmpty())
        <div class="bg-gray-800 rounded-lg shadow-sm">
            <h3 class="text-2xl font-extrabold flex items-center gap-2 border-b border-gray-700 p-4 text-yellow-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-5 h-5" viewBox="0 0 16 16">
                    <path d="M7.068.727c.243-.97 1.62-.97 1.864 0l.071.286a.96.96 0 0 0 1.622.434l.205-.211c.695-.719 1.888-.03 1.613.931l-.08.284a.96.96 0 0 0 1.187 1.187l.283-.081c.96-.275 1.65.918.931 1.613l-.211.205a.96.96 0 0 0 .434 1.622l.286.071c.97.243.97 1.62 0 1.864l-.286.071a.96.96 0 0 0-.434 1.622l.211.205c.719.695.03 1.888-.931 1.613l-.284-.08a.96.96 0 0 0-1.187 1.187l.081.283c.275.96-.918 1.65-1.613.931l-.205-.211a.96.96 0 0 0-1.622.434l-.071.286c-.243.97-1.62.97-1.864 0l-.071-.286a.96.96 0 0 0-1.622-.434l-.205.211c-.695.719-1.888.03-1.613-.931l.08-.284a.96.96 0 0 0-1.186-1.187l-.284.081c-.96.275-1.65-.918-.931-1.613l.211-.205a.96.96 0 0 0-.434-1.622l-.286-.071c-.97-.243-.97-1.62 0-1.864l.286-.071a.96.96 0 0 0 .434-1.622l-.211-.205c-.719-.695-.03-1.888.931-1.613l.284.08a.96.96 0 0 0 1.187-1.186l-.081-.284c-.275-.96.918-1.65 1.613-.931l.205.211a.96.96 0 0 0 1.622-.434zM12.973 8.5H8.25l-2.834 3.779A4.998 4.998 0 0 0 12.973 8.5m0-1a4.998 4.998 0 0 0-7.557-3.779l2.834 3.78zM5.048 3.967l-.087.065zm-.431.355A4.98 4.98 0 0 0 3.002 8c0 1.455.622 2.765 1.615 3.678L7.375 8zm.344 7.646.087.065z"/>
                </svg>
                Compétences
            </h3>
            @foreach ($user->skills as $skill)
            <div class="px-4 py-6 {{ !$loop->last ? 'border-b' : '' }} border-dashed border-gray-700">
                <div class="flex gap-2 items-center mb-2 font-semibold text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-3 h-3" viewBox="0 0 16 16">
                        <path d="M8 16A8 8 0 1 1 8 0a8 8 0 0 1 0 16M1 8a7 7 0 0 0 7 7 3.5 3.5 0 1 0 0-7 3.5 3.5 0 1 1 0-7 7 7 0 0 0-7 7"/>
                    </svg>
                    {{ $skill->name }}
                </div>
            </div>
            @endforeach
        </div>
        @endif

    </div>
</div>

<div id="vote-modal-{{ $user->id }}" tabindex="-1" class="hidden fixed top-0 left-0 right-0 z-50 flex items-center justify-center w-full p-4 overflow-x-hidden overflow-y-auto h-full bg-gray-950 bg-opacity-50">
    <div class="relative w-full max-w-xl max-h-full">
        <div class="relative bg-gray-800 rounded-lg shadow">
            <div class="p-5 flex items-center border-b border-gray-700 mb-4">
                <button type="button" class="absolute top-3 right-2.5 text-gray-400 hover:text-white bg-transparent hover:bg-gray-700 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="vote-modal-{{ $user->id }}">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 8.586l4.95-4.95a1 1 0 111.414 1.414L11.414 10l4.95 4.95a1 1 0 01-1.414 1.414L10 11.414l-4.95 4.95a1 1 0 01-1.414-1.414L8.586 10 3.636 5.05a1 1 0 011.414-1.414L10 8.586z" clip-rule="evenodd" /></svg>
                </button>
                <h3 class="text-xl font-semibold text-white">Votre vote</h3>
            </div>

            <form action="{{ route('participant.vote.multipleStore') }}" method="post">
                @csrf
            <div class="space-y-4 p-5">
                <p class="text-gray-400 font-semibold">Choisissez une ou plusieurs catégories :</p>

                <input type="hidden" name="candidat_id" value="{{ $user->id }}">

                <div class="space-y-2">
                    @forelse ($categories as $category)
                    <label class="flex items-center gap-2 text-gray-400">
                        <input type="checkbox" class="form-checkbox text-yellow-600 bg-gray-800 border-gray-600" name="categories[]" value="{{ $category->id }}">
                        {{ $category->name }}
                    </label>
                    @empty
                    <p class="text-gray-400 italic">Aucune catégorie enrégistrée</p>
                    @endforelse
                </div>
            </div>
            <div class="flex justify-end gap-2 p-5 border-t border-gray-700">
                <button type="button" data-modal-hide="vote-modal-{{ $user->id }}" class="bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold shadow-md hover:bg-gray-500 transition w-full sm:w-auto px-5 py-2.5 text-center cursor-pointer">Annuler</button>
                <button type="submit" class="bg-gradient-to-r from-yellow-500 via-yellow-600 to-yellow-800 text-white px-6 py-3 rounded-lg font-semibold shadow-md hover:opacity-90 transition w-full sm:w-auto px-5 py-2.5 text-center cursor-pointer">
                    Envoyer
                </button>
            </div>
            </form>
        </div>
    </div>
</div>

<div id="message-modal-{{ $user->id }}" tabindex="-1" class="hidden fixed top-0 left-0 right-0 z-50 flex items-center justify-center w-full p-4 overflow-x-hidden overflow-y-auto h-full bg-gray-950 bg-opacity-50">
    <div class="relative w-full max-w-xl max-h-full">
        <div class="relative bg-gray-800 rounded-lg shadow">
            <div class="p-5 flex items-center border-b border-gray-700 mb-4">
                <button type="button" class="absolute top-3 right-2.5 text-gray-400 hover:text-white bg-transparent hover:bg-gray-700 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="message-modal-{{ $user->id }}">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 8.586l4.95-4.95a1 1 0 111.414 1.414L11.414 10l4.95 4.95a1 1 0 01-1.414 1.414L10 11.414l-4.95 4.95a1 1 0 01-1.414-1.414L8.586 10 3.636 5.05a1 1 0 011.414-1.414L10 8.586z" clip-rule="evenodd" /></svg>
                </button>
                <h3 class="text-xl font-semibold text-white">Votre message</h3>
            </div>

            <form action="{{ route('participant.message.store') }}" method="post">
                @csrf

                <div class="space-y-4 p-5">

                        <input type="hidden" name="receiver_id" value="{{ $user->id }}">
                        <div class="flex items-center space-x-2">
                            <input type="checkbox" id="anonyme-{{ $user->id }}" name="is_anonymous" class="form-checkbox text-yellow-600 bg-gray-800 border-gray-600 shadow-sm focus:ring-yellow-600 ring-offset-yellow-800 focus:ring-2 bg-gray-700  checked:bg-yellow-600 checked:border-yellow-600">
                            <label for="anonyme-{{ $user->id }}" class="text-gray-400 font-semibold">Envoyer anonymement</label>
                        </div>

                        <textarea rows="4" class="w-full rounded-md bg-gray-700 border border-gray-600 p-3 text-sm text-white resize-none focus:outline-none focus:ring-2 focus:ring-yellow-600" name="content" placeholder="Votre message..."></textarea>
                </div>

                <div class="flex justify-end gap-2 p-5 border-t border-gray-700">
                    <button type="button" data-modal-hide="message-modal-{{ $user->id }}" class="bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold shadow-md hover:bg-gray-500 transition w-full sm:w-auto px-5 py-2.5 text-center cursor-pointer">Annuler</button>
                <button type="submit" class="bg-gradient-to-r from-yellow-500 via-yellow-600 to-yellow-800 text-white px-6 py-3 rounded-lg font-semibold shadow-md hover:opacity-90 transition w-full sm:w-auto px-5 py-2.5 text-center cursor-pointer">
                    Envoyer
                </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function sendLike(userId) {
        const baseUrl = "{{ route('participant.like.send', ['id' => 0]) }}";
        const url = baseUrl.replace('/0', `/${userId}`);

        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            const btn = document.getElementById(`like-btn-${userId}`);
            if (data.success) {
                if(data.likeStatut == 'added') {
                    btn.classList.remove('text-white', 'border-gray-500');
                    btn.classList.add('text-yellow-500', 'border-yellow-500');
                } else {
                    btn.classList.remove('text-yellow-500', 'border-yellow-500');
                    btn.classList.add('text-white', 'border-gray-500');
                }
            } else {
                console.log(data.message)
            }
        })
        .catch(error => {
            console.error('Erreur AJAX :', error);
        });
    }
</script>
@endsection
