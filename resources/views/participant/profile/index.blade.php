@extends('layouts.participant.app', [
    'noPadding' => true,
])

@section('content')
<div class="text-gray-400 mb-16">
    @php
        $user = Auth::user();
    @endphp
    <div class="relative h-24 sm:h-40 h-56 w-full">
        <img src="{{ $user->banner_image ?? asset('images/banner-default.jpg') }}" class="w-full h-full object-cover" alt="Bannière">
        <form action="{{ route('participant.profile.update.banner', ['id' => $user->id]) }}" method="POST" enctype="multipart/form-data" class="absolute top-4 right-4">
            @csrf
            @method('PUT')
            <label for="banner-upload" class="cursor-pointer bg-gray-900/50 text-white text-sm font-semibold px-3 py-1 rounded hover:bg-gray-900/70 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="h-4 w-4" viewBox="0 0 16 16">
                    <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                        <path d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1m9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0"/>
                </svg>
                Modifier
            </label>
            <input type="file" id="banner-upload" name="banner_image" class="hidden" accept=".png,.jpg,.jpeg" onchange="this.form.submit()">
        </form>

        <div class="absolute -bottom-16 left-1/2 transform -translate-x-1/2 z-10">
            <form action="{{ route('participant.profile.update.profile_photo', ['id' => $user->id]) }}" method="POST" enctype="multipart/form-data" class="relative">
                @csrf
                @method('PUT')
                <img src="{{ $user->profile_photo ?? asset('images/user.png') }}" class="w-24 h-24 md:w-32 md:h-32 rounded-full border-4 border-gray-900 shadow-lg object-cover" alt="Photo de profil">
                <label for="photo-upload" class="absolute bottom-0 right-0 bg-black/60 text-white p-1 rounded-full cursor-pointer hover:bg-black">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="h-5 w-5 m-1" viewBox="0 0 16 16">
                        <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                        <path d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1m9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0"/>
                      </svg>
                </label>
                <input type="file" id="photo-upload" name="profile_photo" class="hidden" accept=".png,.jpg,.jpeg" onchange="this.form.submit()">
            </form>
        </div>
    </div>

    <div class="space-y-10 max-w-4xl mx-auto mt-16 mx-4 p-4">

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

        <div class="mb-5 p-4 bg-gray-800 rounded-xl shadow flex items-center space-x-4 border border-gray-700 w-full"
        role="alert">

            <div class="relative flex-shrink-0 w-16 h-16">
                <svg class="transform -rotate-90 w-16 h-16" viewBox="0 0 36 36">
                @php
                    $percentage = $user->score->score ?? 20;
                    $strokeColor = $percentage > 75 ? 'text-green-500' : ($percentage > 40 ? 'text-yellow-500' : 'text-red-500');
                    $strokeDasharray = 100;
                    $strokeDashoffset = 100 - $percentage;
                @endphp
                <circle
                    class="text-gray-300"
                    stroke-width="4"
                    stroke="currentColor"
                    fill="none"
                    cx="18"
                    cy="18"
                    r="15.9155"
                />
                <circle
                    class="{{ $strokeColor }}"
                    stroke-width="4"
                    stroke-linecap="round"
                    stroke="currentColor"
                    fill="none"
                    cx="18"
                    cy="18"
                    r="15.9155"
                    stroke-dasharray="{{ $strokeDasharray }}"
                    stroke-dashoffset="{{ $strokeDashoffset }}"
                />
                </svg>
                <div class="absolute inset-0 flex items-center justify-center font-semibold text-lg text-white">
                {{ $percentage }}%
                </div>
            </div>

            <div class="flex-1">
                @if ($percentage < 80)
                <p class="text-gray-400 font-semibold">
                    Votre profil est rempli à {{ $percentage }}%. Complétez-le pour améliorer votre visibilité !
                </p>
                @else
                <p class="text-gray-400 font-semibold">
                    Votre profil est rempli à {{ $percentage }}%. Très intéressant ! Toutes nos félicitations.
                </p>
                @endif
            </div>
        </div>

        <form action="{{ route('participant.profile.update', ['id' => $user->id]) }}" method="post" class="border border-gray-800 rounded-md p-4">
            @csrf
            @method('PUT')
            <h2 class="text-2xl font-bold text-yellow-600 mb-3">Informations personnelles</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="name" class="block mb-2 text-lg font-semibold">Nom <span class="text-red-500">*</span></label>
                    <input type="text" id="name" name="name" class="border rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-yellow-600 focus:border-yellow-600 focus:outline-none @error('name') border-red-600 @enderror" value="{{ old('name', $user->name) }}" required />
                </div>

                <div>
                    <label for="first_name" class="block mb-2 text-lg font-semibold">Prénom.s <span class="text-red-500">*</span></label>
                    <input type="text" id="first_name" name="first_name" class="border rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-yellow-600 focus:border-yellow-600 focus:outline-none @error('first_name') border-red-600 @enderror" value="{{ old('first_name', $user->first_name) }}" required />
                </div>

                <div>
                    <label for="phone" class="block mb-2 text-lg font-semibold">Numéro de téléphone <span class="text-red-500">*</span></label>
                    <input type="text" id="phone" name="phone" class="border rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-yellow-600 focus:border-yellow-600 focus:outline-none @error('phone') border-red-600 @enderror" value="{{ old('phone', $user->phone) }}" required />
                </div>

                <div>
                    <label for="email" class="block mb-2 text-lg font-semibold">Adresse email <span class="text-red-500">*</span></label>
                    <input type="email" id="email" name="email" class="border rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-yellow-600 focus:border-yellow-600 focus:outline-none @error('email') border-red-600 @enderror" value="{{ old('email', $user->email) }}" readonly />
                </div>

                <div class="sm:col-span-2">
                    <label for="bio" class="block mb-2 text-lg font-semibold">Bio</label>
                    <textarea id="bio" name="bio" class="border rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-yellow-600 focus:border-yellow-600 focus:outline-none @error('bio') border-red-600 @enderror">{{ old('bio', $user->bio) }}</textarea>
                </div>

                <div class="mt-4 sm:col-span-2">
                    <button type="submit" class="bg-gradient-to-r from-yellow-500 via-yellow-600 to-yellow-800 text-white px-6 py-3 rounded-lg font-semibold shadow-md hover:opacity-90 transition w-full sm:w-auto px-5 py-2.5 text-center cursor-pointer">
                        Mettre à jour
                    </button>
                </div>
            </div>
        </form>

        <form action="{{ route('participant.profile.media.store') }}" method="post" class="border border-gray-800 rounded-md p-4">
            @csrf
            @method('PUT')
            <h2 class="text-2xl font-bold text-yellow-600 mb-3">Réseaux sociaux</h2>

            @php
                $socials = ['facebook', 'tiktok', 'linkedin', 'whatsapp', 'instagram', 'x'];
                $links = [];
                foreach ($user->social_links as $value) {
                    $links[$value->platform] = $value->url;
                }
            @endphp

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @foreach($socials as $network)
                    <div>
                        <label for="links[{{ $network }}]" class="block mb-2 text-lg font-semibold capitalize">{{ $network }} <span class="text-red-500">*</span></label>
                        <input type="url"
                            id="links[{{ $network }}]"
                            name="links[{{ $network }}]"
                            class="border rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-yellow-600 focus:border-yellow-600 focus:outline-none @error('links.' . $network) border-red-600 @enderror"
                            value="{{ old('links.' . $network, $links[$network] ?? '') }}"
                            placeholder="https://{{ $network }}.com/..." />
                    </div>
                @endforeach

                <div class="mt-4 sm:col-span-2">
                    <button type="submit"
                            class="bg-gradient-to-r from-yellow-500 via-yellow-600 to-yellow-800 text-white px-6 py-3 rounded-lg font-semibold shadow-md hover:opacity-90 transition w-full sm:w-auto text-center cursor-pointer">
                        Mettre à jour
                    </button>
                </div>
            </div>
        </form>

        <div class="border border-gray-800 rounded-md p-4"
            x-data="formationManager()"
            x-ref="formationComponent"
            x-init="init($refs.formationComponent)"
            data-formations='@json($user->educations)'>
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-bold text-yellow-600">Formations</h2>
                <button type="button" @click="add()" class="text-sm text-yellow-400 hover:underline font-semibold">+ Ajouter</button>
            </div>

            <template x-for="(item, index) in formations" :key="item.temp_id">
                <form :action="item.id ? `/participant/education/${item.id}/update` : '/participant/education/store'" method="POST" class="bg-gray-800 rounded-md p-4 mt-4 grid grid-cols-1 sm:grid-cols-2 gap-4 border border-gray-700 mt-4">
                    @csrf
                    <template x-if="item.id">
                        <input type="hidden" name="_method" value="PUT">
                    </template>
                    <input type="hidden" name="user_id" value="{{ $user->id }}">

                    <div class="sm:col-span-2 flex items-center justify-between mb-4 text-lg">
                        <p class="font-bold text-white" x-text="item.id ? 'Formation enregistrée' : 'Nouvelle formation'"></p>
                        <button type="button" @click="deleteFormation(index)" class="block text-red-400 hover:text-red-600 text-sm font-semibold">Supprimer</button>
                    </div>

                    <div>
                        <label class="block mb-2 text-lg font-semibold">Centre de formation <span class="text-red-500">*</span></label>
                        <input type="text" name="institution" x-model="item.institution"
                            class="border rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 text-white focus:ring-yellow-600 focus:border-yellow-600 focus:outline-none @error('institution') border-red-600 @enderror" required>
                    </div>

                    <div>
                        <label class="block mb-2 text-lg font-semibold">Attestation/Diplôme <span class="text-red-500">*</span></label>
                        <input type="text" name="degree" x-model="item.degree"
                            class="border rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 text-white focus:ring-yellow-600 focus:border-yellow-600 focus:outline-none @error('degree') border-red-600 @enderror" required>
                    </div>

                    <div>
                        <label class="block mb-2 text-lg font-semibold">Début</label>
                        <input type="date" name="start_date" x-model="item.start_date"
                            class="border rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 text-white focus:ring-yellow-600 focus:border-yellow-600 focus:outline-none @error('start_date') border-red-600 @enderror">
                    </div>

                    <div>
                        <label class="block mb-2 text-lg font-semibold">Fin</label>
                        <input type="date" name="end_date" x-model="item.end_date"
                            class="border rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 text-white focus:ring-yellow-600 focus:border-yellow-600 focus:outline-none @error('end_date') border-red-600 @enderror">
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block mb-2 text-lg font-semibold">Détail</label>
                        <textarea name="description" x-model="item.description"
                            class="border rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 text-white focus:ring-yellow-600 focus:border-yellow-600 focus:outline-none @error('structure') border-red-600 @enderror"></textarea>
                    </div>

                    <div class="mt-4 sm:col-span-2">
                        <button type="submit"
                            class="bg-gradient-to-r from-yellow-500 via-yellow-600 to-yellow-800 text-white px-6 py-3 rounded-lg font-semibold shadow-md hover:opacity-90 transition w-full sm:w-auto text-center cursor-pointer">
                            Mettre à jour
                        </button>
                    </div>
                </form>
            </template>
        </div>

        <div class="border border-gray-800 rounded-md p-4"
            x-data="experienceManager()"
            x-ref="experienceComponent"
            x-init="init($refs.experienceComponent)"
            data-experiences='@json($user->experiences)'>
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-bold text-yellow-600">Experiences</h2>
                <button type="button" @click="add()" class="text-sm text-yellow-400 hover:underline font-semibold">+ Ajouter</button>
            </div>

            <template x-for="(item, index) in experiences" :key="item.temp_id">
                <form :action="item.id ? `/participant/experience/${item.id}/update` : '/participant/experience/store'" method="POST" class="bg-gray-800 rounded-md p-4 mt-4 grid grid-cols-1 sm:grid-cols-2 gap-4 border border-gray-700 mt-4">
                    @csrf
                    <template x-if="item.id">
                        <input type="hidden" name="_method" value="PUT">
                    </template>
                    <input type="hidden" name="user_id" value="{{ $user->id }}">

                    <div class="sm:col-span-2 flex items-center justify-between mb-4 text-lg">
                        <p class="font-bold text-white" x-text="item.id ? 'Expérience enregistrée' : 'Nouvelle expérience'"></p>
                        <button type="button" @click="deleteExperience(index)" class="block text-red-400 hover:text-red-600 text-sm font-semibold">Supprimer</button>
                    </div>

                    <div>
                        <label class="block mb-2 text-lg font-semibold">Structure <span class="text-red-500">*</span></label>
                        <input type="text" name="company" x-model="item.company"
                            class="border rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 text-white focus:ring-yellow-600 focus:border-yellow-600 focus:outline-none @error('company') border-red-600 @enderror" required>
                    </div>

                    <div>
                        <label class="block mb-2 text-lg font-semibold">Expérience <span class="text-red-500">*</span></label>
                        <input type="text" name="title" x-model="item.title"
                            class="border rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 text-white focus:ring-yellow-600 focus:border-yellow-600 focus:outline-none @error('title') border-red-600 @enderror" required>
                    </div>

                    <div>
                        <label class="block mb-2 text-lg font-semibold">Début <span class="text-red-500">*</span></label>
                        <input type="date" name="start_date" x-model="item.start_date"
                            class="border rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 text-white focus:ring-yellow-600 focus:border-yellow-600 focus:outline-none @error('start_date') border-red-600 @enderror" required>
                    </div>

                    <div>
                        <label class="block mb-2 text-lg font-semibold">Fin</label>
                        <input type="date" name="end_date" x-model="item.end_date"
                            class="border rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 text-white focus:ring-yellow-600 focus:border-yellow-600 focus:outline-none @error('end_date') border-red-600 @enderror">
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block mb-2 text-lg font-semibold">Détail</label>
                        <textarea name="description" x-model="item.description"
                            class="border rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 text-white focus:ring-yellow-600 focus:border-yellow-600 focus:outline-none @error('description') border-red-600 @enderror"></textarea>
                    </div>

                    <div class="mt-4 sm:col-span-2">
                        <button type="submit"
                            class="bg-gradient-to-r from-yellow-500 via-yellow-600 to-yellow-800 text-white px-6 py-3 rounded-lg font-semibold shadow-md hover:opacity-90 transition w-full sm:w-auto text-center cursor-pointer">
                            Mettre à jour
                        </button>
                    </div>
                </form>
            </template>
        </div>

        <div class="border border-gray-800 rounded-md p-4"
            x-data="achievementManager()"
            x-ref="achievementComponent"
            x-init="init($refs.achievementComponent)"
            data-achievements='@json($user->achievements)'>
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-bold text-yellow-600">Réalisations</h2>
                <button type="button" @click="add()" class="text-sm text-yellow-400 hover:underline font-semibold">+ Ajouter</button>
            </div>

            <template x-for="(item, index) in achievements" :key="item.temp_id">
                <form :action="item.id ? `/participant/achievement/${item.id}/update` : '/participant/achievement/store'" method="POST" class="bg-gray-800 rounded-md p-4 mt-4 grid grid-cols-1 sm:grid-cols-2 gap-4 border border-gray-700 mt-4">
                    @csrf
                    <template x-if="item.id">
                        <input type="hidden" name="_method" value="PUT">
                    </template>
                    <input type="hidden" name="user_id" value="{{ $user->id }}">

                    <div class="sm:col-span-2 flex items-center justify-between mb-4 text-lg">
                        <p class="font-bold text-white" x-text="item.id ? 'Réalisation enregistrée' : 'Nouvelle réalisation'"></p>
                        <button type="button" @click="deleteAchievement(index)" class="block text-red-400 hover:text-red-600 text-sm font-semibold">Supprimer</button>
                    </div>

                    <div>
                        <label class="block mb-2 text-lg font-semibold">Réalisation <span class="text-red-500">*</span></label>
                        <input type="text" name="title" x-model="item.title"
                            class="border rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 text-white focus:ring-yellow-600 focus:border-yellow-600 focus:outline-none @error('title') border-red-600 @enderror" required>
                    </div>

                    <div>
                        <label class="block mb-2 text-lg font-semibold">Date</label>
                        <input type="date" name="date" x-model="item.date"
                            class="border rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 text-white focus:ring-yellow-600 focus:border-yellow-600 focus:outline-none @error('date') border-red-600 @enderror">
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block mb-2 text-lg font-semibold">Détail</label>
                        <textarea name="description" x-model="item.description"
                            class="border rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 text-white focus:ring-yellow-600 focus:border-yellow-600 focus:outline-none @error('description') border-red-600 @enderror"></textarea>
                    </div>

                    <div class="mt-4 sm:col-span-2">
                        <button type="submit"
                            class="bg-gradient-to-r from-yellow-500 via-yellow-600 to-yellow-800 text-white px-6 py-3 rounded-lg font-semibold shadow-md hover:opacity-90 transition w-full sm:w-auto text-center cursor-pointer">
                            Mettre à jour
                        </button>
                    </div>
                </form>
            </template>
        </div>

        <div class="border border-gray-800 rounded-md p-4"
            x-data="skillManager()"
            x-ref="skillComponent"
            x-init="init($refs.skillComponent)"
            data-skills='@json($user->skills)'>
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-bold text-yellow-600">Compétences</h2>
                <button type="button" @click="add()" class="text-sm text-yellow-400 hover:underline font-semibold">+ Ajouter</button>
            </div>

            <template x-for="(item, index) in skills" :key="item.temp_id">
                <form :action="item.id ? `/participant/skill/${item.id}/update` : '/participant/skill/store'" method="POST" class="bg-gray-800 rounded-md p-4 mt-4 grid grid-cols-1 sm:grid-cols-2 gap-4 border border-gray-700 mt-4">
                    @csrf
                    <template x-if="item.id">
                        <input type="hidden" name="_method" value="PUT">
                    </template>
                    <input type="hidden" name="user_id" value="{{ $user->id }}">

                    <div class="sm:col-span-2 flex items-center justify-between mb-4 text-lg">
                        <p class="font-bold text-white" x-text="item.id ? 'Compétence enregistrée' : 'Nouvelle compétence'"></p>
                        <button type="button" @click="deleteSkill(index)" class="block text-red-400 hover:text-red-600 text-sm font-semibold">Supprimer</button>
                    </div>

                    <div>
                        <label class="block mb-2 text-lg font-semibold">Compétence <span class="text-red-500">*</span></label>
                        <input type="text" name="name" x-model="item.name"
                            class="border rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 text-white focus:ring-yellow-600 focus:border-yellow-600 focus:outline-none @error('name') border-red-600 @enderror" required>
                    </div>

                    <div class="mt-4 sm:col-span-2">
                        <button type="submit"
                            class="bg-gradient-to-r from-yellow-500 via-yellow-600 to-yellow-800 text-white px-6 py-3 rounded-lg font-semibold shadow-md hover:opacity-90 transition w-full sm:w-auto text-center cursor-pointer">
                            Mettre à jour
                        </button>
                    </div>
                </form>
            </template>
        </div>

        <form action="{{ route('password.update') }}" method="post" class="border border-gray-800 rounded-md p-4">
            @csrf
            @method('PUT')
            <h2 class="text-2xl font-bold text-yellow-600 mb-3">Sécurité</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="sm:col-span-2">
                    <label for="current_password" class="block mb-2 text-lg font-semibold">Mot de passe actuel <span class="text-red-500">*</span></label>
                    <input type="password" id="current_password" name="current_password" class="border rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-yellow-600 focus:border-yellow-600 focus:outline-none @error('current_password') border-red-600 @enderror" value="{{ old('current_password') }}" required />
                </div>

                <div>
                    <label for="password" class="block mb-2 text-lg font-semibold">Nouveau mot de passe actuel <span class="text-red-500">*</span></label>
                    <input type="password" id="password" name="password" class="border rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-yellow-600 focus:border-yellow-600 focus:outline-none @error('password') border-red-600 @enderror" value="{{ old('password') }}" required />
                </div>

                <div>
                    <label for="password_confirmation" class="block mb-2 text-lg font-semibold">Confirmer le mot de passe actuel <span class="text-red-500">*</span></label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="border rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-yellow-600 focus:border-yellow-600 focus:outline-none @error('password_confirmation') border-red-600 @enderror" value="{{ old('password_confirmation') }}" required />
                </div>

                <div class="mt-4">
                    <button type="submit" class="bg-gradient-to-r from-yellow-500 via-yellow-600 to-yellow-800 text-white px-6 py-3 rounded-lg font-semibold shadow-md hover:opacity-90 transition w-full sm:w-auto px-5 py-2.5 text-center cursor-pointer">
                        Mettre à jour
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script>
    function formationManager() {
        return {
            formations: [],
            init(el) {
                const raw = el.dataset.formations;
                const parsed = JSON.parse(raw);

                this.formations = parsed.map(f => ({
                    id: f.id,
                    institution: f.institution,
                    degree: f.degree,
                    start_date: f.start_date,
                    end_date: f.end_date,
                    description: f.description,
                    temp_id: 'form_' + f.id
                }))
            },
            add() {
                this.formations.push({
                    id: null,
                    institution: '',
                    degree: '',
                    start_date: '',
                    end_date: '',
                    description: '',
                    temp_id: Date.now() + '_' + Math.random().toString(36).substr(2, 9)
                });
            },
            deleteFormation(index) {
                const formation = this.formations[index];
                if (formation.id) {
                    if (confirm("Supprimer définitivement cette formation ?")) {
                        fetch(`/participant/education/${formation.id}/destroy`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            }
                        }).then(response => {
                            if (response.ok) {
                                this.formations.splice(index, 1);
                            } else {
                                alert("Erreur lors de la suppression.");
                            }
                        });
                    }
                } else {
                    this.formations.splice(index, 1);
                }
            }
        }
    }

    function experienceManager() {
        return {
            experiences: [],
            init(el) {
                const raw = el.dataset.experiences;
                const parsed = JSON.parse(raw);

                this.experiences = parsed.map(f => ({
                    id: f.id,
                    company: f.company,
                    title: f.title,
                    start_date: f.start_date,
                    end_date: f.end_date,
                    description: f.description,
                    temp_id: 'form_' + f.id
                }))
            },
            add() {
                this.experiences.push({
                    id: null,
                    company: '',
                    title: '',
                    start_date: '',
                    end_date: '',
                    description: '',
                    temp_id: Date.now() + '_' + Math.random().toString(36).substr(2, 9)
                });
            },
            deleteExperience(index) {
                const experience = this.experiences[index];
                if (experience.id) {
                    if (confirm("Supprimer définitivement cette experience ?")) {
                        fetch(`/participant/experience/${experience.id}/destroy`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            }
                        }).then(response => {
                            if (response.ok) {
                                this.experiences.splice(index, 1);
                            } else {
                                alert("Erreur lors de la suppression.");
                            }
                        });
                    }
                } else {
                    this.experiences.splice(index, 1);
                }
            }
        }
    }

    function achievementManager() {
        return {
            achievements: [],
            init(el) {
                const raw = el.dataset.achievements;
                const parsed = JSON.parse(raw);

                this.achievements = parsed.map(f => ({
                    id: f.id,
                    title: f.title,
                    date: f.date,
                    description: f.description,
                    temp_id: 'form_' + f.id
                }))
            },
            add() {
                this.achievements.push({
                    id: null,
                    title: '',
                    date: '',
                    description: '',
                    temp_id: Date.now() + '_' + Math.random().toString(36).substr(2, 9)
                });
            },
            deleteAchievement(index) {
                const achievement = this.achievements[index];
                if (achievement.id) {
                    if (confirm("Supprimer définitivement cette réalisation ?")) {
                        fetch(`/participant/achievement/${achievement.id}/destroy`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            }
                        }).then(response => {
                            if (response.ok) {
                                this.achievements.splice(index, 1);
                            } else {
                                alert("Erreur lors de la suppression.");
                            }
                        });
                    }
                } else {
                    this.achievements.splice(index, 1);
                }
            }
        }
    }

    function skillManager() {
        return {
            skills: [],
            init(el) {
                const raw = el.dataset.skills;
                const parsed = JSON.parse(raw);

                this.skills = parsed.map(f => ({
                    id: f.id,
                    name: f.name,
                    temp_id: 'form_' + f.id
                }))
            },
            add() {
                this.skills.push({
                    id: null,
                    name: '',
                    temp_id: Date.now() + '_' + Math.random().toString(36).substr(2, 9)
                });
            },
            deleteSkill(index) {
                const skill = this.skills[index];
                if (skill.id) {
                    if (confirm("Supprimer définitivement cette compétence ?")) {
                        fetch(`/participant/skill/${skill.id}/destroy`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            }
                        }).then(response => {
                            if (response.ok) {
                                this.skills.splice(index, 1);
                            } else {
                                alert("Erreur lors de la suppression.");
                            }
                        });
                    }
                } else {
                    this.skills.splice(index, 1);
                }
            }
        }
    }
</script>
@endsection
