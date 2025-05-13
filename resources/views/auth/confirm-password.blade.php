@extends('layouts.auth.app', [
    'text' => 'Renseignez votre mot de passe pour plus de sécurité.'
])

@section('form')

<form method="POST" action="{{ route('password.confirm') }}">
    @csrf
    <div class="font-semibold">
        <div class="mb-6">
            <label for="password" class="block mb-2 text-lg text-white">Mot de passe</label>
            <input type="password" id="password" name="password" class="border rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-yellow-600 focus:border-yellow-600 focus:outline-none @error('password') border-red-600 @enderror" placeholder="•••••••••" required />
            @if ($errors->has('password'))
            <p class="mt-2 text-sm text-red-600">
                {{ $errors->first('password') }}
            </p>
            @endif
        </div>
        <button type="submit" class="bg-gradient-to-r from-yellow-500 via-yellow-600 to-yellow-800 text-white px-6 py-3 rounded-lg font-semibold shadow-md hover:opacity-90 transition w-full sm:w-auto px-5 py-2.5 text-center cursor-pointer">
            Confirmation du mot de passe
        </button>
    </div>
</form>

@endsection



