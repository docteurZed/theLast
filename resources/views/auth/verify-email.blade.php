@extends('layouts.auth.app', [
    'text' => 'Confirmer votre email.'
])

@section('form')

<form method="POST" action="{{ route('verification.send') }}">
    @csrf
    <div class="font-semibold">
        <button type="submit" class="bg-gradient-to-r from-yellow-500 via-yellow-600 to-yellow-800 text-white px-6 py-3 rounded-lg font-semibold shadow-md hover:opacity-90 transition w-full sm:w-auto px-5 py-2.5 text-center cursor-pointer">
            Confirmation de l'email
        </button>
    </div>
</form>

@endsection



