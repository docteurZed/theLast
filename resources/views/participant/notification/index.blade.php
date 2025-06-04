@extends('layouts.participant.app')

@section('content')

<div class="max-w-4xl mx-auto text-gray-400 mb-20">
    @forelse ($discussions as $disc)
        <a href="{{ route('participant.notification.show', ['threadKey' => $disc->thread_key]) }}">
            <div class="flex items-center {{ !$disc->all_read ? 'bg-gray-700' : 'bg-gray-800' }} shadow-md p-5 cursor-pointer {{ !$loop->last ?? 'border border-gray-700' }}">
                <div class="relative inline-block shrink-0">
                    @if ($disc->is_interlocutor_anonymous)
                        <img class="w-12 h-12 rounded-full" src="{{ asset('images/user.png') }}" alt="user"/>
                    @else
                        <img class="w-12 h-12 rounded-full" src="{{ $disc->interlocutor_profile_photo ?? asset('images/user.png') }}" alt="user"/>
                    @endif

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
                            <span class="italic font-medium text-gray-300 text-sm">(vous êtes anonyme)</span>
                        @endif
                    </div>
                    <div class="text-sm font-normal text-gray-300">
                        {{ $disc->last_message }}
                    </div>
                    <span class="text-xs font-medium text-yellow-600">{{ $disc->elapsed }}</span>
                </div>
            </div>
        </a>
    @empty
        <p class="text-gray-400 text-sm text-center py-16">Aucune discussion en cours.</p>
    @endforelse

    <div class="fixed end-10 bottom-20 group">
        <button type="button" data-tooltip-target="tooltip-message" data-tooltip-placement="left" data-drawer-target="drawer-example" data-drawer-show="drawer-example" aria-controls="drawer-example" class="flex justify-center items-center w-[52px] h-[52px] rounded-full shadow-xs hover:text-white text-gray-300 bg-yellow-700 hover:bg-yellow-600">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H4.414a1 1 0 0 0-.707.293L.854 15.146A.5.5 0 0 1 0 14.793zm3.5 1a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1zm0 2.5a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1zm0 2.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1z"/>
            </svg>
            <span class="sr-only">Message</span>
        </button>
        <div id="tooltip-message" role="tooltip" class="absolute z-20 invisible inline-block w-auto px-3 py-2 text-sm font-seminold text-white transition-opacity duration-300 bg-gray-700 rounded-lg shadow-xs opacity-0 tooltip">
            Nouveau message
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>
    </div>

    <!-- drawer component -->
    <div id="drawer-example" class="fixed top-0 left-0 z-60 h-screen p-4 overflow-y-auto transition-transform -translate-x-full w-full bg-gray-900" tabindex="-1" aria-labelledby="drawer-label">
        <h5 id="drawer-label" class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400"><svg class="w-4 h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
          </svg>Message</h5>
        <button type="button" data-drawer-hide="drawer-example" aria-controls="drawer-example" class="text-gray-400 bg-transparent rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 flex items-center justify-center hover:bg-yellow-700 hover:text-white" >
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
            <span class="sr-only">Close menu</span>
        </button>

        <div class="mt-5">
            <div class="relative mb-5"
                    x-data="{
                        open: false,
                        search: '',
                    }"
                    @click.away="open = false">

                <div @click="open = !open"
                     class="bg-gray-800 border border-gray-700 text-white rounded-md p-2 cursor-pointer flex justify-between items-center">
                    <span class="text-gray-400">Choisir un destinataire</span>
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>

                <div x-show="open" class="absolute z-10 w-7/8 bg-gray-800 border border-gray-700 rounded-md mt-1 shadow-lg overflow-hidden" x-transition>
                    <input type="text" x-model="search" placeholder="Rechercher..." class="w-full p-2 bg-gray-800 text-white border-b border-gray-700 placeholder-gray-400">
                    <ul class="max-h-60 overflow-y-auto">
                        @foreach ($users as $p)
                        @php
                            $fullName = ucfirst($p->first_name) . ' ' . ucfirst($p->name);
                            $escapedFullName = str_replace("'", "\\'", $fullName);
                        @endphp
                        <li @click="selected = { id: {{ $p->id }}, nom: '{{ $escapedFullName }}' }; open = false"
                            x-show="'{{ strtolower($escapedFullName) }}'.includes(search.toLowerCase())"
                            class="px-4 py-2 hover:bg-yellow-600 font-semibold cursor-pointer text-sm text-white">
                            {{ $fullName }}
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="mb-5">
                <textarea id="content" name="content" class="border rounded-lg block w-full p-2.5 bg-gray-800 border-gray-700 placeholder-gray-400 text-white focus:ring-yellow-600 focus:border-yellow-600 focus:outline-none @error('content') border-red-600 @enderror" placeholder="Votre publication ici..." value="{{ old('content') }}" required></textarea>
            </div>

            <div class="flex items-center justify-center w-full mb-5">
                <label for="image" class="flex flex-col items-center justify-center w-full min-h-sm border rounded-lg cursor-pointer bg-gray-800 border-gray-700 hover:bg-gray-700">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6" id="preview-default">
                        <svg class="w-5 h-5 mb-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5
                                5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0
                                0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                        </svg>
                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                            <span class="font-semibold">Ajouter une image</span>
                        </p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG ou JPEG</p>
                    </div>
                    <!-- Miniature de l'image sélectionnée -->
                    <img id="image-preview" class="w-full h-full object-cover rounded-lg hidden" alt="Prévisualisation">
                    <input name="image" id="image" type="file" class="hidden" accept=".jpg,.png,.jpeg" />
                </label>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script>
    const input = document.getElementById('image');
    const previewImage = document.getElementById('image-preview');
    const defaultPreview = document.getElementById('preview-default');

    input.addEventListener('change', function () {
        const file = this.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                previewImage.setAttribute('src', e.target.result);
                previewImage.classList.remove('hidden');
                defaultPreview.classList.add('hidden'); // cacher l'icône et le texte par défaut
            };
            reader.readAsDataURL(file);
        } else {
            previewImage.classList.add('hidden');
            defaultPreview.classList.remove('hidden');
        }
    });
</script>


@endsection
