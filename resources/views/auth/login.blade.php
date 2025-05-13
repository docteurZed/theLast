@extends('layouts.auth.app', [
    'text' => 'Entrez vos informations pour vous connecter.'
])

@section('form')

<form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="font-semibold">
        <div class="mb-6">
            <label for="email" class="block mb-2 text-lg text-white">Email</label>
            <input type="email" id="email" name="email" class="border rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-yellow-600 focus:border-yellow-600 focus:outline-none @error('email') border-red-600 @enderror" placeholder="docteur@docteur.com" value="{{ old('email') }}" required />
            @if ($errors->has('email'))
            <p class="mt-2 text-sm text-red-600">
                {{ $errors->first('email') }}
            </p>
            @endif
        </div>
        <div class="mb-6">
            <label for="password" class="block mb-2 text-lg text-white">Mot de passe</label>
            <input type="password" id="password" name="password" class="border rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-yellow-600 focus:border-yellow-600 focus:outline-none @error('password') border-red-600 @enderror" placeholder="•••••••••" required />
            @if ($errors->has('password'))
            <p class="mt-2 text-sm text-red-600">
                {{ $errors->first('password') }}
            </p>
            @endif
        </div>
        <div class="flex items-center justify-between mb-6">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-700 text-yellow-600 shadow-sm focus:ring-yellow-600 ring-offset-yellow-800 focus:ring-2 bg-gray-700  checked:bg-yellow-600 checked:border-yellow-600" name="remember">
                <span class="ms-2 text-sm text-gray-400">Se souvenir de moi</span>
            </label>
            @if (Route::has('password.request'))
            <a class="underline text-sm text-gray-400 hover:text-yellow-600 rounded-md" href="{{ route('password.request') }}">
                Mot de passe oublié ?
            </a>
            @endif
        </div>
        <button type="submit" class="bg-gradient-to-r from-yellow-500 via-yellow-600 to-yellow-800 text-white px-6 py-3 rounded-lg font-semibold shadow-md hover:opacity-90 transition w-full sm:w-auto px-5 py-2.5 text-center cursor-pointer">
            Connexion
        </button>
    </div>
</form>

@endsection
