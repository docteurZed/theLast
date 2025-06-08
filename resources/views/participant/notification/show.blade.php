@extends('layouts.participant.app', [
    'noSidebar' => true,
    'noBottombar' => true,
    'noPadding' => true,
    'noMargin' => true,
])

@section('content')

<nav class="fixed top-0 left-0 z-50 w-full border-b bg-gray-900 border-gray-800">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between mr-3">
            <div class="flex items-center gap-3">
                <div class="text-white">
                    <a href="{{ route('participant.notification.index') }}" class="">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-10 h-10 rounded-full hover:bg-gray-800 focus:ring-4 p-2" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
                        </svg>
                    </a>
                </div>
                @php

                @endphp
                <div class="inline-flex items-center">
                    @if (isset($sender['profile_photo']))
                    <img src="{{ $sender['profile_photo'] }}" alt="Photo de profil" class="w-8 h-8 rounded-full">
                    @else
                    <img src="{{ asset('images/user.png') }}" alt="Photo de profil" class="w-8 h-8 rounded-full">
                    @endif
                    <span class="text-white font-semibold ms-3">{{ $sender['first_name'] . ' ' . $sender['name'] }}</span>
                </div>
            </div>
            <div class="flex items-center ms-3">
                <div class="flex items-center space-x-4">
                    <button type="button" class="flex text-sm rounded-full focus:ring-4 focus:ring-gray-700 cursor-pointer text-white" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6" viewBox="0 0 16 16">
                            <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
                        </svg>
                    </button>
                </div>
                <div class="z-50 hidden my-4 text-base list-none divide-y rounded-sm shadow-sm bg-gray-800 divide-gray-700" id="dropdown-user">
                    <ul class="py-1" role="none">
                        <li>
                            <button type="button" class="flex items-center px-4 py-2 text-sm font-semibold text-gray-400 hover:bg-gray-700 group w-full" role="menuitem" data-modal-target="delete-modal" data-modal-toggle="delete-modal">
                                Supprimer
                            </button>
                        </li>
                    </ul>
                </div>
                <div id="delete-modal" tabindex="-1" class="hidden fixed top-0 left-0 right-0 z-80 flex items-center justify-center w-full p-4 overflow-x-hidden overflow-y-auto h-full bg-gray-950 bg-opacity-50">
                    <div class="relative w-full max-w-xl max-h-full">
                        <div class="relative bg-gray-800 rounded-lg shadow">
                            <div class="p-5 flex items-center border-b border-gray-700 mb-4">
                                <button type="button" class="absolute top-3 right-2.5 text-gray-400 hover:text-white bg-transparent hover:bg-gray-700 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="delete-modal">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 8.586l4.95-4.95a1 1 0 111.414 1.414L11.414 10l4.95 4.95a1 1 0 01-1.414 1.414L10 11.414l-4.95 4.95a1 1 0 01-1.414-1.414L8.586 10 3.636 5.05a1 1 0 011.414-1.414L10 8.586z" clip-rule="evenodd" /></svg>
                                </button>
                                <h3 class="text-xl font-semibold text-white">Suppression</h3>
                            </div>

                            <div class="space-y-4 p-5">
                                <p class="text-center text-white font-semibold text-xl">Au lieu de profiter de cette expérience, c'est supprimer la discussion qui t'intéresse toi... 😔</p>
                            </div>

                            <div class="flex justify-end gap-2 p-5 border-t border-gray-700">
                                <button type="button" data-modal-hide="delete-modal" class="bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold shadow-md hover:bg-gray-500 transition w-full sm:w-auto px-5 py-2.5 text-center cursor-pointer">Annuler</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<div class="max-w-4xl mx-auto py-6 px-4 text-gray-300 relative my-16">

    <div id="messagesContainer">
    @foreach ($messages as $message)
        <div class="flex {{ $message->is_sender ? 'justify-end' : 'justify-start' }} mb-4">
            <div class="flex items-start gap-2.5 max-w-[80%]">
                <div class="rounded-xl min-w-40 p-4 shadow-md text-sm leading-relaxed
                    {{ $message->is_sender ? 'bg-yellow-500 text-white rounded-tr-none' : 'bg-gray-700 text-gray-200 rounded-tl-none' }}">

                    <p class="mb-2 whitespace-pre-wrap">{{ $message->content }}</p>

                    <div class="flex items-center justify-between mb-1">
                        <p class="italic text-gray-200">{{ !$message->is_sender ? '' : ($message->is_read ? 'Lu' : 'Non lu') }}</p>
                        <p class="text-xs text-gray-200">{{ $message->created_at->format('H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    </div>

    <form id="messageForm" method="POST" action="{{ route('participant.message.store') }}" class="fixed bottom-0 left-0 z-50 w-full h-20 border-t bg-gray-900 border-gray-800 p-4">
        @csrf
        <input type="hidden" name="receiver_id" value="{{ $receiverId }}">
        <input type="hidden" name="thread_key" value="{{ $thread_key }}">

        <div class="flex items-center gap-2">
            <textarea
                name="content"
                rows="1"
                class="rounded-md border border-gray-600 bg-gray-800 text-gray-200 text-sm focus:ring-2 focus:ring-yellow-600 focus:outline-none w-7/8 h-12"
                placeholder="Votre message...">{{ old('content') }}</textarea>

            <button id="sendButton"
                type="submit"
                class="text-sm rounded-md transition font-semibold shadow flex items-center justify-center h-12 w-1/8 cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5"/>
                </svg>
            </button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('messageForm');
        const textarea = form.querySelector('textarea[name="content"]');
        const submitBtn = form.querySelector('button[type="submit"]');
        const messagesContainer = document.getElementById('messagesContainer');

        // Fonction de validation du textarea
        const validateTextarea = () => {
            const isEmpty = textarea.value.trim() === '';
            submitBtn.disabled = isEmpty;

            if (isEmpty) {
                submitBtn.classList.remove('bg-gradient-to-r', 'from-yellow-500', 'via-yellow-600', 'to-yellow-800', 'text-white', 'hover:opacity-90');
                submitBtn.classList.add('bg-gray-600', 'text-gray-300', 'cursor-not-allowed');
            } else {
                submitBtn.classList.remove('bg-gray-600', 'text-gray-300', 'cursor-not-allowed');
                submitBtn.classList.add('bg-gradient-to-r', 'from-yellow-500', 'via-yellow-600', 'to-yellow-800', 'text-white', 'hover:opacity-90');
            }
        };

        // Mettre à jour le bouton à chaque frappe
        textarea.addEventListener('input', validateTextarea);
        validateTextarea(); // Initial state

        form.addEventListener('submit', async function (e) {
            e.preventDefault();

            const formData = new FormData(form);
            const token = document.querySelector('input[name="_token"]').value;

            // Affichage de l'état de chargement
            const originalText = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = `<svg class="animate-spin h-4 w-4 mr-2 inline" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10"
                        stroke="currentColor" stroke-width="4" fill="none"></circle>
                <path class="opacity-75" fill="currentColor"
                      d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
            </svg>`;

            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json',
                    },
                    body: formData
                });

                if (!response.ok) {
                    const errorData = await response.json();
                    return;
                }

                const newMessage = await response.json();

                const now = new Date();
                const heure = now.getHours().toString().padStart(2, '0');
                const minute = now.getMinutes().toString().padStart(2, '0');
                const heureFormatee = `${heure}:${minute}`;
                const senderName = formData.get('is_anonymous') ? 'Anonyme - ...' : 'Vous';

                const messageHTML = `
                <div class="flex justify-end mb-4">
                    <div class="flex items-start gap-2.5 max-w-[80%]">
                        <div class="rounded-xl min-w-40 p-4 shadow-md text-sm leading-relaxed bg-yellow-600 text-white rounded-tr-none">
                            <p class="mb-2 whitespace-pre-wrap">${formData.get('content')}</p>

                            <div class="flex items-center justify-between mb-1">
                                <p class="italic text-gray-400">Non lu</p>
                                <p class="text-xs text-gray-300">${heureFormatee}</p>
                            </div>
                        </div>
                    </div>
                </div>`;

                messagesContainer.insertAdjacentHTML('beforeend', messageHTML);
                form.reset();
                validateTextarea();
            } catch (error) {
                console.error("Erreur lors de l'envoi du message", error);
            } finally {
                // Restaurer l'état du bouton
                submitBtn.innerHTML = originalText;
                validateTextarea();
            }
        });
    });
</script>
@endsection
