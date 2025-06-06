@extends('layouts.guest.app', [
    'header' => 'Contact',
])

@section('content')

<section class="section px-5 md:px-16 lg:px-24">
    <div class="fade-section py-12 mx-auto max-w-screen-xl">
        <!-- Header -->
        <div class="mb-12 text-center">
            <p class="mb-2 font-semibold bg-gradient-to-r from-yellow-600 to-yellow-800 bg-clip-text text-transparent">{{ $sections['contact']->name }}</p>
            <h2 class="text-3xl md:text-4xl font-extrabold text-white">{{ $sections['contact']->title }}</h2>
            <p class="mt-3 text-gray-400">{{ $sections['contact']->description }}</p>
        </div>

        <div class="md:grid grid-cols-3 gap-4 md:gap-8">

            <div class="col-span-1 my-3 flex flex-col items-center gap-4 w-full md:px-4">
                <div class="flex flex-col items-center text-center border border-gray-700 px-2 py-3 rounded-lg bg-gray-800 w-full">
                    <svg class="w-10 h-10 text-yellow-600 mb-3" fill="currentColor" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"/>
                    </svg>
                    <h3 class="font-bold text-lg mb-1 text-white">Numéro de téléphone</h3>
                    <p class="font-semibold text-gray-400">{{ $setting->phone ?? env('APP_PHONE_NUMBER') }}</p>
                </div>
                <!-- Heure -->
                <div class="flex flex-col items-center text-center border border-gray-700 px-2 py-3 rounded-lg bg-gray-800 w-full">
                    <svg class="w-10 h-10 text-yellow-600 mb-3" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M2 2A2 2 0 0 0 .05 3.555L8 8.414l7.95-4.859A2 2 0 0 0 14 2zm-2 9.8V4.698l5.803 3.546zm6.761-2.97-6.57 4.026A2 2 0 0 0 2 14h6.256A4.5 4.5 0 0 1 8 12.5a4.49 4.49 0 0 1 1.606-3.446l-.367-.225L8 9.586zM16 9.671V4.697l-5.803 3.546.338.208A4.5 4.5 0 0 1 12.5 8c1.414 0 2.675.652 3.5 1.671"/>
                        <path d="M15.834 12.244c0 1.168-.577 2.025-1.587 2.025-.503 0-1.002-.228-1.12-.648h-.043c-.118.416-.543.643-1.015.643-.77 0-1.259-.542-1.259-1.434v-.529c0-.844.481-1.4 1.26-1.4.585 0 .87.333.953.63h.03v-.568h.905v2.19c0 .272.18.42.411.42.315 0 .639-.415.639-1.39v-.118c0-1.277-.95-2.326-2.484-2.326h-.04c-1.582 0-2.64 1.067-2.64 2.724v.157c0 1.867 1.237 2.654 2.57 2.654h.045c.507 0 .935-.07 1.18-.18v.731c-.219.1-.643.175-1.237.175h-.044C10.438 16 9 14.82 9 12.646v-.214C9 10.36 10.421 9 12.485 9h.035c2.12 0 3.314 1.43 3.314 3.034zm-4.04.21v.227c0 .586.227.8.581.8.31 0 .564-.17.564-.743v-.367c0-.516-.275-.708-.572-.708-.346 0-.573.245-.573.791"/>
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
