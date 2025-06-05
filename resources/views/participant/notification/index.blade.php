@extends('layouts.participant.app', [
    'noPadding' => true,
])

@section('content')

<div class="w-full text-gray-400 mb-20">

    @if (Session::has('success'))
    <div id="alert-1" class="flex items-center p-4 m-4 bg-gray-800 text-green-400 rounded-xl" role="alert">
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
        <div id="alert-1" class="flex items-center p-4 m-4 bg-gray-800 text-red-400 rounded-xl" role="alert">
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

    @forelse ($discussions as $disc)
        <div class="m-0 p-0">
            <a href="{{ route('participant.notification.show', ['threadKey' => $disc->thread_key]) }}">
                <div class="flex items-center {{ !$disc->all_read ? 'bg-gray-800' : '' }} p-5 cursor-pointer {{ !$loop->last ? 'border-b border-gray-700' : '' }}">
                    <div class="relative inline-block shrink-0 sm:mx-5">
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
        </div>
    @empty
        <p class="text-gray-400 text-sm text-center py-16">Aucune discussion en cours.</p>
    @endforelse

    <div class="fixed end-6 sm:end-16 bottom-28 sm:bottom-48 group">
        <button type="button" data-tooltip-target="tooltip-message" data-tooltip-placement="left" data-drawer-target="drawer-example" data-drawer-show="drawer-example" aria-controls="drawer-example" class="flex justify-center items-center w-[52px] h-[52px] rounded-full shadow-xs text-white bg-yellow-600 hover:bg-yellow-500">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H4.414a1 1 0 0 0-.707.293L.854 15.146A.5.5 0 0 1 0 14.793zm3.5 1a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1zm0 2.5a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1zm0 2.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1z"/>
            </svg>
            <span class="sr-only">Message</span>
        </button>
        <div id="tooltip-message" role="tooltip" class="absolute z-20 invisible inline-block w-auto px-3 py-2 text-sm font-semibold text-white transition-opacity duration-300 bg-gray-800 rounded-lg shadow-xs opacity-0 tooltip">
            Nouveau message
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>
    </div>

    <!-- drawer component -->
    <div id="drawer-example" class="fixed top-0 left-0 z-60 h-screen p-4 overflow-y-auto transition-transform -translate-x-full w-full sm:max-w-xl bg-gray-900 sm:border-r border-gray-800" tabindex="-1" aria-labelledby="drawer-label">
            <h5 id="drawer-label" class="inline-flex items-center gap-2 mb-5 text-base text-xl font-semibold text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-5 h-5 transition duration-75" viewBox="0 0 16 16">
                    <path d="M2 2A2 2 0 0 0 .05 3.555L8 8.414l7.95-4.859A2 2 0 0 0 14 2zm-2 9.8V4.698l5.803 3.546zm6.761-2.97-6.57 4.026A2 2 0 0 0 2 14h6.256A4.5 4.5 0 0 1 8 12.5a4.49 4.49 0 0 1 1.606-3.446l-.367-.225L8 9.586zM16 9.671V4.697l-5.803 3.546.338.208A4.5 4.5 0 0 1 12.5 8c1.414 0 2.675.652 3.5 1.671"/>
                    <path d="M15.834 12.244c0 1.168-.577 2.025-1.587 2.025-.503 0-1.002-.228-1.12-.648h-.043c-.118.416-.543.643-1.015.643-.77 0-1.259-.542-1.259-1.434v-.529c0-.844.481-1.4 1.26-1.4.585 0 .87.333.953.63h.03v-.568h.905v2.19c0 .272.18.42.411.42.315 0 .639-.415.639-1.39v-.118c0-1.277-.95-2.326-2.484-2.326h-.04c-1.582 0-2.64 1.067-2.64 2.724v.157c0 1.867 1.237 2.654 2.57 2.654h.045c.507 0 .935-.07 1.18-.18v.731c-.219.1-.643.175-1.237.175h-.044C10.438 16 9 14.82 9 12.646v-.214C9 10.36 10.421 9 12.485 9h.035c2.12 0 3.314 1.43 3.314 3.034zm-4.04.21v.227c0 .586.227.8.581.8.31 0 .564-.17.564-.743v-.367c0-.516-.275-.708-.572-.708-.346 0-.573.245-.573.791"/>
                </svg>
                Nouveau message
            </h5>
           <button type="button" data-drawer-hide="drawer-example" aria-controls="drawer-example" class="text-gray-400 hover:text-white bg-transparent rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 flex items-center justify-center hover:bg-gray-700" >
              <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
              </svg>
              <span class="sr-only">Close menu</span>
           </button>

        <div class="mt-5">
            <form action="{{ route('participant.message.store') }}" method="post">
                @csrf
                <input type="hidden" name="sender_id" value="{{ Auth::user()->id }}">
                <div class="relative mb-5"
                    x-data="{
                        open: false,
                        search: '',
                        selected: { id: '', nom: '' }
                    }"
                    @click.away="open = false">

                    <label for="receiver_id" class="block mb-2 text-lg font-semibold">Destinataire</label>

                    <div @click="open = !open"
                        class="bg-gray-800 border border-gray-700 text-white rounded-md p-2 cursor-pointer flex justify-between items-center">
                        <span class="text-gray-400" x-text="selected.nom || 'Cliquez pour choisir'"></span>
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>

                    <div x-show="open" class="absolute z-10 w-7/8 bg-gray-800 border border-gray-700 rounded-md mt-1 shadow-lg overflow-hidden" x-transition>
                        <input type="text" x-model="search" placeholder="Rechercher..." class="w-full p-2 bg-gray-700 text-white border-b border-gray-700 placeholder-gray-400">
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
                        <input type="hidden" name="receiver_id" :value="selected.id">
                    </div>
                </div>

                <div class="mb-5">
                    <label for="content" class="block mb-2 text-lg font-semibold">Message</label>
                    <textarea id="content" name="content" class="border rounded-lg block w-full p-2.5 bg-gray-800 border-gray-700 placeholder-gray-400 text-white focus:ring-yellow-600 focus:border-yellow-600 focus:outline-none @error('content') border-red-600 @enderror" placeholder="Votre message..." required>{{ old('content') }}</textarea>
                </div>

                <div class="mb-5">
                    <label for="is_anonymous" class="inline-flex items-center">
                        <input id="is_anonymous" type="checkbox" class="rounded border-gray-700 text-yellow-600 shadow-sm focus:ring-yellow-600 ring-offset-yellow-800 focus:ring-2 bg-gray-700  checked:bg-yellow-600 checked:border-yellow-600" name="is_anonymous">
                        <span class="ms-3 text-lg font-semibold">Rester anonyme</span>
                    </label>
                </div>

                <div class="mb-5">
                    <button type="submit" class="bg-gradient-to-r from-yellow-500 via-yellow-600 to-yellow-800 text-white px-6 py-3 rounded-lg font-semibold shadow-md hover:opacity-90 transition w-full sm:w-auto px-5 py-2.5 text-center cursor-pointer">
                        Envoyer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

@endsection
