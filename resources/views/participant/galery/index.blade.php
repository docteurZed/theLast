@extends('layouts.participant.app')

@section('content')

<div class="max-w-4xl mx-auto sm:p-6 space-y-6 text-gray-400 mb-16">

    @if (Session::has('success'))
    <div id="alert-1" class="flex items-center p-4 mb-4 bg-gray-800 text-green-400 rounded-xl" role="alert">
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
        <div id="alert-1" class="flex items-center p-4 mb-4 bg-gray-800 text-red-400 rounded-xl" role="alert">
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

    <div class="w-full">
        <input type="text" id="user-search" placeholder="Rechercher un nom ou une bio..."
            class="w-full p-3 rounded-md bg-gray-800 border border-gray-600 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-yellow-600">
    </div>

    <div id="user-list" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($users as $user)
        <div class="user-card bg-gray-800 rounded-lg shadow space-y-3">
            <div class="flex flex-col items-center gap-4 text-center p-5">
                @if (isset($user->profile_photo))
                <img src="{{ $user->profile_photo }}" alt="Photo de profil"  class="w-20 h-20 mx-auto rounded-full object-cover">
                @else
                <img src="{{ asset('images/user.png') }}" alt="Photo de profil"  class="w-20 h-20 mx-auto rounded-full object-cover">
                @endif
                <h3 class="text-lg font-semibold text-white">{{ ucfirst($user->first_name) }} {{ ucfirst($user->name) }}</h3>
                <p class="text-sm text-gray-400">{{ $user->bio }}</p>
            </div>
            <div class="grid grid-cols-3 gap-3 text-sm border-t border-gray-700">
                <button id="like-btn-{{ $user->id }}" class="hover:bg-gray-700 transition py-4 px-3 text-center flex flex-col gap-2 items-center {{ Auth::user()->hasLiked($user) ? 'text-yellow-600' : '' }} rounded-bl-lg" onclick="sendLike({{ $user->id }})">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-5 h-5" viewBox="0 0 16 16">
                        <path d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2 2 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a10 10 0 0 0-.443.05 9.4 9.4 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a9 9 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.2 2.2 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.9.9 0 0 1-.121.416c-.165.288-.503.56-1.066.56z"/>
                    </svg>
                    <span class="text-xs font-semibold">J’aime</span>
                </button>
                <button class="hover:bg-gray-700 transition py-4 px-3 text-white text-center flex flex-col gap-2 items-center" data-modal-target="message-modal-{{ $user->id }}" data-modal-toggle="message-modal-{{ $user->id }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-5 h-5" viewBox="0 0 16 16">
                        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z"/>
                    </svg>
                    <span class="text-xs font-semibold">Message</span>
                </button>
                <button class="hover:bg-gray-700 transition py-4 px-3 text-white text-center flex flex-col gap-2 items-center" data-modal-target="vote-modal-{{ $user->id }}" data-modal-toggle="vote-modal-{{ $user->id }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-5 h-5" viewBox="0 0 16 16">
                        <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z"/>
                    </svg>
                    <span class="text-xs font-semibold">Vote</span>
                </button>
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
                                    <input type="checkbox" id="anonyme-{{ $user->id }}" name="is_anonymous" class="form-checkbox text-yellow-600 bg-gray-800 border-gray-600">
                                    <label for="anonyme-{{ $user->id }}" class="text-gray-400 font-semibold">Envoyer anonymement</label>
                                </div>

                                <textarea rows="4" class="w-full rounded-md bg-gray-700 border border-gray-600 p-3 text-sm text-white resize-none" name="content" placeholder="Votre message..."></textarea>
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
                            <p class="text-gray-400">Aucune catégorie enrégistrée</p>
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
        @endforeach
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('user-search');
        const userCards = document.querySelectorAll('.user-card');

        searchInput.addEventListener('input', function () {
            const search = this.value.trim().toLowerCase();

            userCards.forEach(card => {
                const name = card.querySelector('h3').textContent.toLowerCase();

                if (name.includes(search)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });

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
                btn.classList.toggle('text-yellow-600');
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
