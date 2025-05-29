@extends('layouts.participant.app')

@section('content')

<div class="max-w-4xl mx-auto py-6 px-4 sm:px-6 text-gray-300 space-y-6 relative mb-16">
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

    <div id="messagesContainer">
    @foreach ($messages as $message)
        <div class="flex {{ $message->is_sender ? 'justify-end' : 'justify-start' }} mb-4">
            <div class="flex items-start gap-2.5 max-w-[80%]">

                <div class="rounded-xl p-4 shadow-md text-sm leading-relaxed
                    {{ $message->is_sender ? 'bg-yellow-600 text-white rounded-tr-none' : 'bg-gray-700 text-gray-200 rounded-tl-none' }}">

                    <div class="flex items-center justify-between mb-1">
                        <span class="font-semibold text-xs">
                            {{ $message->is_sender ? 'Vous' : ($message->is_anonymous ? 'Anonyme - ' . substr(md5($message->sender_id), 0, 6) : $message->sender_name) }}
                        </span>
                        <span class="text-xs text-gray-300 ml-4">{{ $message->created_at->format('H:i') }}</span>
                    </div>

                    <p class="mb-2 whitespace-pre-wrap">{{ $message->content }}</p>

                    <div class="text-[0.7rem] text-gray-300 italic">
                        {{ $message->is_sender ? 'Envoyé' : ($message->is_read ? 'Lu' : 'Non lu') }}
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    </div>

    <form id="messageForm" method="POST" action="{{ route('participant.message.store') }}" class="sm:left-64 inset-x-0 border-t border-gray-700 px-4 py-4 space-y-3">
        @csrf
        <input type="hidden" name="receiver_id" value="{{ $receiverId }}">
        <input type="hidden" name="thread_key" value="{{ $thread_key }}">

        <div class="flex items-center gap-2">
            <textarea
                name="content"
                rows="2"
                class="flex-1 resize-none rounded-md border border-gray-600 bg-gray-800 text-gray-200 text-sm px-3 py-2 focus:ring-2 focus:ring-yellow-600 focus:outline-none"
                placeholder="Écrire un message...">{{ old('content') }}</textarea>
        </div>

        <div class="flex items-center gap-2 text-sm text-gray-400">
            <input type="checkbox" id="is_anonymous" name="is_anonymous" class="form-checkbox text-yellow-600 rounded"
                {{ old('is_anonymous') ? 'checked' : '' }}>
            <label for="is_anonymous">Envoyer anonymement</label>
        </div>

        <button id="sendButton"
            type="submit"
            class="text-sm px-4 py-2 rounded-lg transition font-semibold shadow">
            Envoyer
        </button>

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
                submitBtn.classList.remove('bg-yellow-600', 'hover:bg-yellow-700', 'text-white');
                submitBtn.classList.add('bg-gray-600', 'text-gray-300', 'cursor-not-allowed');
            } else {
                submitBtn.classList.remove('bg-gray-600', 'text-gray-300', 'cursor-not-allowed');
                submitBtn.classList.add('bg-yellow-600', 'hover:bg-yellow-700', 'text-white');
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
            </svg> Envoi...`;

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
                        <div class="rounded-xl p-4 shadow-md text-sm leading-relaxed bg-yellow-600 text-white rounded-tr-none">
                            <div class="flex items-center justify-between mb-1">
                                <span class="font-semibold text-xs">${senderName}</span>
                                <span class="text-xs text-gray-300 ml-4">${heureFormatee}</span>
                            </div>
                            <p class="mb-2 whitespace-pre-wrap">${formData.get('content')}</p>
                            <div class="text-[0.7rem] text-gray-300 italic">Envoyé</div>
                        </div>
                        <img class="w-8 h-8 rounded-full" src="{{ asset('images/user.png') }}" alt="Avatar">
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
