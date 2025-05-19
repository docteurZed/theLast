@extends('layouts.guest.app', [
    'header' => 'Contact',
])

@section('content')

<section class="section px-5 md:px-16 lg:px-24">
    <div class="fade-section py-12 mx-auto max-w-screen-xl">
        <!-- Header -->
        <div class="mb-12 text-center">
            <p class="mb-2 font-semibold bg-gradient-to-r from-yellow-600 to-yellow-800 bg-clip-text text-transparent">{{ $sections['contact']->name }}</p>
            <h2 class="text-4xl font-extrabold text-white">{{ $sections['contact']->title }}</h2>
            <p class="mt-3 text-gray-400">{{ $sections['contact']->description }}</p>
        </div>

        <div class="md:grid grid-cols-3 gap-4 md:gap-8">

            <div class="col-span-1 my-3 flex flex-col items-center gap-4 w-full md:px-4">
                <div class="flex flex-col items-center text-center border border-gray-700 px-2 py-3 rounded-lg bg-gray-800 w-full">
                    <svg class="w-10 h-10 text-yellow-600 mb-3" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M6 2a1 1 0 000 2h1v1a1 1 0 102 0V4h2v1a1 1 0 102 0V4h1a1 1 0 100-2H6zM3 7a2 2 0 012-2h10a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V7zm2 0v9h10V7H5z"/>
                    </svg>
                    <h3 class="font-bold text-lg mb-1 text-white">Numéro de téléphone</h3>
                    <p class="font-semibold text-gray-400">{{ $setting->phone ?? env('APP_PHONE_NUMBER') }}</p>
                </div>
                <!-- Heure -->
                <div class="flex flex-col items-center text-center border border-gray-700 px-2 py-3 rounded-lg bg-gray-800 w-full">
                    <svg class="w-10 h-10 text-yellow-600 mb-3" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 2a8 8 0 100 16 8 8 0 000-16zm1 8V6a1 1 0 10-2 0v5a1 1 0 00.293.707l2.5 2.5a1 1 0 001.414-1.414L11 10z"/>
                    </svg>
                    <h3 class="font-bold text-lg mb-1 text-white">Email</h3>
                    <p class="font-semibold text-gray-400">{{ $setting->email ?? env('MAIL_FROM_ADDRESS') }}</p>
                </div>
            </div>

            <div class="col-span-2 mt-8 md:mt-0">
                <form method="POST" action="{{ route('contact.store') }}">
                    @csrf
                    <div class="font-semibold">
                        <div class="sm:grid grid-cols-2 gap-3">
                            <div class="mb-6 col-span-2">
                                <label for="name" class="block mb-2 text-lg text-white">
                                    Nom et prénom.s
                                    <span class="text-red-600">*</span>
                                </label>
                                <input type="text" id="name" name="name" class="border rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-yellow-600 focus:border-yellow-600 focus:outline-none @error('name') border-red-600 @enderror" placeholder="Ex : John Doe" value="{{ old('name') }}" required />
                                @if ($errors->has('name'))
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $errors->first('name') }}
                                </p>
                                @endif
                            </div>
                            <div class="mb-6">
                                <label for="phone" class="block mb-2 text-lg text-white">
                                    Numéro de téléphone
                                    <span class="text-red-600">*</span>
                                </label>
                                <input type="tel" id="phone" name="phone" class="border rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-yellow-600 focus:border-yellow-600 focus:outline-none @error('phone') border-red-600 @enderror" placeholder="Ex : 90909090" value="{{ old('phone') }}" required />
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
                                <input type="email" id="email" name="email" class="border rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-yellow-600 focus:border-yellow-600 focus:outline-none @error('email') border-red-600 @enderror" placeholder="Ex : docteur@docteur.com" value="{{ old('email') }}" required />
                                @if ($errors->has('email'))
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $errors->first('email') }}
                                </p>
                                @endif
                            </div>
                            <div class="mb-6 col-span-2">
                                <label for="message" class="block mb-2 text-lg text-white">
                                    Message
                                    <span class="text-red-600">*</span>
                                </label>
                                <textarea id="message" name="message" class="border rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-yellow-600 focus:border-yellow-600 focus:outline-none @error('message') border-red-600 @enderror" placeholder="Votre message" required>
                                    {{ old('message') }}
                                </textarea>
                                @if ($errors->has('message'))
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $errors->first('message') }}
                                </p>
                                @endif
                            </div>
                        </div>

                        <button type="submit" class="bg-gradient-to-r from-yellow-500 via-yellow-600 to-yellow-800 text-white px-6 py-3 rounded-lg font-semibold shadow-md hover:opacity-90 transition w-full sm:w-auto px-5 py-2.5 text-center cursor-pointer">
                            Envoyer
                        </button>
                    </div>
                </form>
            </div>

        </div>

    </div>
</section>

@endsection
