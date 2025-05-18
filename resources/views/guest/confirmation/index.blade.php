@extends('layouts.auth.app', [
    'text' => 'Entrez vos informations nécessaires pour vous confirmer votre participation.'
])

@section('form')

<form method="POST" action="{{ route('confirmation.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="font-semibold">
        <div class="mb-6">
            <label for="name" class="block mb-2 text-lg text-white">
                Nom
                <span class="text-red-600">*</span>
            </label>
            <input type="text" id="name" name="name" class="border rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-yellow-600 focus:border-yellow-600 focus:outline-none @error('name') border-red-600 @enderror" placeholder="Doe" value="{{ old('name') }}" required />
            @if ($errors->has('name'))
            <p class="mt-2 text-sm text-red-600">
                {{ $errors->first('name') }}
            </p>
            @endif
        </div>
        <div class="mb-6">
            <label for="first_name" class="block mb-2 text-lg text-white">
                Prénom.s
                <span class="text-red-600">*</span>
            </label>
            <input type="text" id="first_name" name="first_name" class="border rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-yellow-600 focus:border-yellow-600 focus:outline-none @error('first_name') border-red-600 @enderror" placeholder="John" value="{{ old('first_name') }}" required />
            @if ($errors->has('first_name'))
            <p class="mt-2 text-sm text-red-600">
                {{ $errors->first('first_name') }}
            </p>
            @endif
        </div>
        <div class="mb-6">
            <label for="phone" class="block mb-2 text-lg text-white">
                Numéro de téléphone
                <span class="text-red-600">*</span>
            </label>
            <input type="tel" id="phone" name="phone" class="border rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-yellow-600 focus:border-yellow-600 focus:outline-none @error('phone') border-red-600 @enderror" placeholder="90909090" value="{{ old('phone') }}" required />
            @if ($errors->has('phone'))
            <p class="mt-2 text-sm text-red-600">
                {{ $errors->first('phone') }}
            </p>
            @endif
        </div>
        <div class="mb-6">
            <label for="email" class="block mb-2 text-lg text-white">
                Email
                <span class="text-red-600">*</span>
            </label>
            <input type="email" id="email" name="email" class="border rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-yellow-600 focus:border-yellow-600 focus:outline-none @error('email') border-red-600 @enderror" placeholder="docteur@docteur.com" value="{{ old('email') }}" required />
            @if ($errors->has('email'))
            <p class="mt-2 text-sm text-red-600">
                {{ $errors->first('email') }}
            </p>
            @endif
        </div>

        <div class="mb-6">
            <label class="block mb-2 text-lg text-white">
                Photo
            </label>
            <div class="flex items-center justify-center w-full mb-6">
                <label for="profile_photo" class="flex flex-col items-center justify-center w-full h-32 border-1 rounded-lg cursor-pointer bg-gray-700 border-gray-600 hover:bg-gray-600">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                        <svg class="w-5 h-5 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                        </svg>
                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Cliquer pour téléverser</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG ou JPEG</p>
                    </div>
                    <input name="profile_photo" id="profile_photo" type="file" class="hidden" accept=".jpg,.png,.jpeg" />
                </label>
            </div>
            @if ($errors->has('profile_photo'))
            <p class="mt-2 text-sm text-red-600">
                {{ $errors->first('profile_photo') }}
            </p>
            @endif
        </div>

        <button type="submit" class="bg-gradient-to-r from-yellow-500 via-yellow-600 to-yellow-800 text-white px-6 py-3 rounded-lg font-semibold shadow-md hover:opacity-90 transition w-full sm:w-auto px-5 py-2.5 text-center cursor-pointer">
            Inscription
        </button>
    </div>
</form>

@endsection

