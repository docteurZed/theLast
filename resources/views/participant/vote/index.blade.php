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

    <div class="bg-gray-800 border border-gray-700 mb-5 p-5 flex justify-between items-center rounded-md">
        <p class="text-xl font-semibold ms-3 text-yellow-600">
            Mes votes
        </p>
        <button class="bg-gradient-to-r from-yellow-500 via-yellow-600 to-yellow-800 text-white px-6 py-3 rounded-lg font-semibold shadow-md hover:opacity-90 transition text-center cursor-pointer" data-modal-target="my-vote-modal" data-modal-toggle="my-vote-modal">Découvrir</button>
        <div id="my-vote-modal" tabindex="-1" class="hidden fixed top-0 left-0 right-0 z-50 flex items-center justify-center w-full p-4 overflow-x-hidden overflow-y-auto h-full bg-gray-950 bg-opacity-50 mb-16">
            <div class="relative w-full max-w-xl max-h-full">
                <div class="relative bg-gray-800 rounded-lg shadow">
                    <div class="p-5 flex items-center border-b border-gray-700 mb-4">
                        <button type="button" class="absolute top-3 right-2.5 text-gray-400 hover:text-white bg-transparent hover:bg-gray-700 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="my-vote-modal">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 8.586l4.95-4.95a1 1 0 111.414 1.414L11.414 10l4.95 4.95a1 1 0 01-1.414 1.414L10 11.414l-4.95 4.95a1 1 0 01-1.414-1.414L8.586 10 3.636 5.05a1 1 0 011.414-1.414L10 8.586z" clip-rule="evenodd" /></svg>
                        </button>
                        <h3 class="text-xl font-semibold text-white">Découvrir vos votes</h3>
                    </div>

                    <div class="p-5 flex w-full justify-center items-center relative overflow-x-auto">
                        <table class="w-full text-sm text-center text-gray-400">
                            <thead class="bg-gray-700 text-white">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Catégorie</th>
                                    <th scope="col" class="px-6 py-3">Nombre de votes</th>
                                </tr>
                            </thead>
                            @php
                                $userVotesByCategory = Auth::user()->votesReceived
                                                        ->groupBy('vote_category_id')
                                                        ->map(function ($votes) {
                                                            return [
                                                                'category' => $votes->first()->category->name,
                                                                'count' => $votes->count(),
                                                            ];
                                                        });

                                $userVotesByCategory = $userVotesByCategory ?? collect();
                            @endphp
                            <tbody>
                                @forelse ($userVotesByCategory as $index => $data)
                                <tr class="{{ !$loop->last ? 'border-b' : '' }} border-gray-700">
                                    <td class="px-6 py-3 font-semibold">{{ $data['category'] }}</td>
                                    <td class="px-6 py-3 font-bold text-yellow-600">{{ $data['count'] }}</td>
                                </tr>
                                @empty
                                <tr class="border-gray-700">
                                    <td colspan="2" class="px-6 py-3 italic">Aucun vote enrégistré</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="flex justify-end gap-2 p-5 border-t border-gray-700">
                        <button type="button" data-modal-hide="my-vote-modal" class="bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold shadow-md hover:bg-gray-500 transition w-full sm:w-auto px-5 py-2.5 text-center cursor-pointer">Retour</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @forelse($categories as $category)
    <div class="bg-gray-800 space-y-4 rounded-md shadow-md mb-4">
        <div class="p-5 border-b border-gray-700 text-yellow-600 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-5 h-5" viewBox="0 0 16 16">
                <path d="M2 2v13.5a.5.5 0 0 0 .74.439L8 13.069l5.26 2.87A.5.5 0 0 0 14 15.5V2a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2"/>
            </svg>
            <h3 class="text-2xl font-semibold ms-3">{{ $category->name }}</h3>
        </div>

        @php
            $userVote = Auth::user()->votesCast->where('vote_category_id', $category->id)->first();
            $defaultCandidate = $userVote?->candidate;
        @endphp

        <form method="POST" action="{{ route('participant.vote.store') }}">
            @csrf
            <input type="hidden" name="vote_category_id" value="{{ $category->id }}">

            <div class="relative p-5"
                    x-data="{
                        open: false,
                        search: '',
                        selected: {{ json_encode($defaultCandidate ? ['id' => $defaultCandidate->id, 'nom' => ucfirst($defaultCandidate->first_name) . ' ' . ucfirst($defaultCandidate->name)] : null) }}
                    }"
                    @click.away="open = false">

                <label class="block font-semibold text-gray-400 mb-2">Choisir un participant :</label>

                <div @click="open = !open"
                     class="bg-gray-800 border border-gray-700 text-white rounded-md p-2 cursor-pointer flex justify-between items-center">
                    <span x-text="selected ? selected.nom : 'Cliquez pour choisir'"></span>
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>

                <div x-show="open" class="absolute z-10 w-7/8 bg-gray-800 border border-gray-700 rounded-md mt-1 shadow-lg overflow-hidden" x-transition>
                    <input type="text" x-model="search" placeholder="Rechercher..." class="w-full p-2 bg-gray-700 text-white border-b border-gray-600 placeholder-gray-400">
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

                <input type="hidden" name="candidat_id" :value="selected ? selected.id : ''">
            </div>

            <div class="flex justify-end p-5">
                <button type="submit" class="bg-gradient-to-r from-yellow-500 via-yellow-600 to-yellow-800 text-white px-6 py-3 rounded-lg font-semibold shadow-md hover:opacity-90 transition w-full sm:w-auto px-5 py-2.5 text-center cursor-pointer">
                    Voter
                </button>
            </div>
        </form>

        @if (!empty($candidatesGroupedByCategory[$category->id]))
        <div class="border-t border-gray-700 py-5 px-8">
            <div class="text-lg font-semibold text-white mb-3 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-5 h-5" viewBox="0 0 16 16">
                    <path d="M3.5 2.5a.5.5 0 0 0-1 0v8.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L3.5 11.293zm3.5 1a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5M7.5 6a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1z"/>
                </svg>
                <span class="ms-3">
                    Top 3 de la catégorie
                </span>
            </div>
            <ol class="space-y-3 pl-4 list-decimal text-sm text-gray-400 px-4">
                @foreach($candidatesGroupedByCategory[$category->id] as $candidate)
                <li>
                    <div class="flex justify-between items-center gap-2 sm:gap-4 sm:mr-20 md:mr-32 lg:mr-56">
                        <span>{{ ucfirst($candidate['first_name']) }} {{ ucfirst($candidate['name']) }}</span>
                        <span class="text-yellow-600 font-semibold flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-3 h-3" viewBox="0 0 16 16">
                                <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z"/>
                            </svg>
                            <span class="ms-2">{{ $candidate['votes_count'] }} vote{{ $candidate['votes_count'] > 1 ? 's' : '' }}</span>
                        </span>
                    </div>
                </li>
                @endforeach
            </ol>
        </div>
        @endif
    </div>
    @empty
    <div class="my-12 text-center">
        <p class="text-gray-400 text-xl font-bold">Aucune catégorie</p>
    </div>
    @endforelse
</div>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection
