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
    @endif

    <!-- Profile section -->
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-yellow-700 mb-5">Informations personnelles</h2>

        <form action="{{ route('participant.profile.update', ['id' => Auth::user()->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="flex items-center gap-2 sm:gap-6 mb-6">
                @if (isset(Auth::user()->profile_photo))
                <img src="{{ asset('storage/public/' . basename(Auth::user()->profile_photo)) }}" alt="Photo de profil" class="w-20 h-20 rounded-full object-cover">
                @else
                <img src="{{ asset('images/user.png') }}" alt="Photo de profil" class="w-20 h-20 rounded-full object-cover">
                @endif

                <div>
                    <label class="block mb-1 text-sm font-semibold">Changer<span class="hidden sm:inline"> la photo</span></label>
                    <input type="file" name="profile_photo" class="text-sm file:bg-yellow-600 file:text-white file:rounded-md file:px-3 file:py-1.5 file:border-none hover:file:bg-yellow-700" accept=".png,.jpg,.jpeg">
                    @if ($errors->has('profile_photo'))
                    <p class="mt-2 text-sm text-red-600">
                        {{ $errors->first('profile_photo') }}
                    </p>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="name" class="block mb-2 text-lg font-semibold">Nom</label>
                    <input type="text" id="name" name="name" class="border rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-yellow-600 focus:border-yellow-600 focus:outline-none @error('name') border-red-600 @enderror" value="{{ old('name', Auth::user()->name) }}" required />
                    @if ($errors->has('name'))
                    <p class="mt-2 text-sm text-red-600">
                        {{ $errors->first('name') }}
                    </p>
                    @endif
                </div>

                <div>
                    <label for="first_name" class="block mb-2 text-lg font-semibold">Prénom.s</label>
                    <input type="text" id="first_name" name="first_name" class="border rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-yellow-600 focus:border-yellow-600 focus:outline-none @error('first_name') border-red-600 @enderror" value="{{ old('first_name', Auth::user()->first_name) }}" required />
                    @if ($errors->has('first_name'))
                    <p class="mt-2 text-sm text-red-600">
                        {{ $errors->first('first_name') }}
                    </p>
                    @endif
                </div>

                <div>
                    <label for="phone" class="block mb-2 text-lg font-semibold">Numéro de téléphone</label>
                    <input type="text" id="phone" name="phone" class="border rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-yellow-600 focus:border-yellow-600 focus:outline-none @error('phone') border-red-600 @enderror" value="{{ old('phone', Auth::user()->phone) }}" required />
                    @if ($errors->has('phone'))
                    <p class="mt-2 text-sm text-red-600">
                        {{ $errors->first('phone') }}
                    </p>
                    @endif
                </div>

                <div>
                    <label for="email" class="block mb-2 text-lg font-semibold">Adresse email</label>
                    <input type="email" id="email" name="email" class="border rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-yellow-600 focus:border-yellow-600 focus:outline-none @error('email') border-red-600 @enderror" value="{{ old('email', Auth::user()->email) }}" readonly />
                    @if ($errors->has('email'))
                    <p class="mt-2 text-sm text-red-600">
                        {{ $errors->first('email') }}
                    </p>
                    @endif
                </div>

                <div class="sm:col-span-2">
                    <label for="bio" class="block mb-2 text-lg font-semibold">Bio</label>
                    <textarea id="bio" name="bio" class="border rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-yellow-600 focus:border-yellow-600 focus:outline-none @error('bio') border-red-600 @enderror">{{ old('bio', Auth::user()->bio) }}</textarea>
                    @if ($errors->has('bio'))
                    <p class="mt-2 text-sm text-red-600">
                        {{ $errors->first('bio') }}
                    </p>
                    @endif
                </div>

                <div class="mt-4 sm:col-span-2">
                    <button type="submit" class="bg-gradient-to-r from-yellow-500 via-yellow-600 to-yellow-800 text-white px-6 py-3 rounded-lg font-semibold shadow-md hover:opacity-90 transition w-full sm:w-auto px-5 py-2.5 text-center cursor-pointer">
                        Mettre à jour
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Security section -->
    <div class="">
        <h2 class="text-2xl font-bold text-yellow-700 mb-5">Sécurité</h2>

        <form action="{{ route('password.update') }}" method="post">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="sm:col-span-2">
                    <label for="current_password" class="block mb-2 text-lg font-semibold">Mot de passe actuel</label>
                    <input type="password" id="current_password" name="current_password" class="border rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-yellow-600 focus:border-yellow-600 focus:outline-none @error('current_password') border-red-600 @enderror" value="{{ old('current_password') }}" required />
                    @if ($errors->has('current_password'))
                    <p class="mt-2 text-sm text-red-600">
                        {{ $errors->first('current_password') }}
                    </p>
                    @endif
                </div>

                <div>
                    <label for="password" class="block mb-2 text-lg font-semibold">Nouveau mot de passe actuel</label>
                    <input type="password" id="password" name="password" class="border rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-yellow-600 focus:border-yellow-600 focus:outline-none @error('password') border-red-600 @enderror" value="{{ old('password') }}" required />
                    @if ($errors->has('password'))
                    <p class="mt-2 text-sm text-red-600">
                        {{ $errors->first('password') }}
                    </p>
                    @endif
                </div>

                <div>
                    <label for="password_confirmation" class="block mb-2 text-lg font-semibold">Confirmer le mot de passe actuel</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="border rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-yellow-600 focus:border-yellow-600 focus:outline-none @error('password_confirmation') border-red-600 @enderror" value="{{ old('password_confirmation') }}" required />
                    @if ($errors->has('password_confirmation'))
                    <p class="mt-2 text-sm text-red-600">
                        {{ $errors->first('password_confirmation') }}
                    </p>
                    @endif
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


@endsection