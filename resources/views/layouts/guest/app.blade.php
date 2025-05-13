<!DOCTYPE html>
<html lang="{{ env('APP_LOCALE') }}">
    <head>

        @include('layouts.guest._head')

    </head>
    <body class="bg-gray-900">

        <header class="w-full bg-center bg-no-repeat bg-[url('https://flowbite.s3.amazonaws.com/docs/jumbotron/conference.jpg')] bg-gray-900 bg-blend-multiply">
            <nav id="navbar" class="w-full fixed top-0 z-20 transition-colors duration-300">
                <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-5 md:px-16">
                    <a href="{{ route('home') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
                        <span class="self-center text-4xl font-bold whitespace-nowrap text-white">
                            the<span class="bg-gradient-to-r from-yellow-800 via-yellow-600 to-yellow-500 bg-clip-text text-transparent">Last</span>
                        </span>
                    </a>
                    <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                        <a href="{{ route('login') }}" type="button" class="text-white focus:ring-2 focus:outline-none focus:ring-yellow-500 font-semibold rounded-lg text-sm px-5 py-3 text-center bg-gradient-to-r from-yellow-500 via-yellow-600 to-yellow-800 hover:opacity-90 transition">
                            Connexion
                        </a>
                        <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm rounded-lg md:hidden focus:outline-none focus:ring-2 text-gray-400 hover:bg-gray-700 focus:ring-gray-600" aria-controls="navbar-sticky" aria-expanded="false">
                            <span class="sr-only">Open main menu</span>
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                            </svg>
                        </button>
                    </div>
                    <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
                        <ul class="flex flex-col p-4 md:p-0 mt-4 font-semibold border rounded-lg md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 bg-yellow-700 md:bg-transparent border-yellow-600">
                            <li>
                                <a href="{{ route('home') }}" class="block py-2 px-3 {{ request()->routeIs('home') ? 'text-white bg-yellow-600 rounded-sm md:bg-transparent md:text-yellow-600 md:p-0' : 'rounded-sm md:hover:bg-transparent md:p-0 md:hover:text-yellow-500 text-white hover:bg-yellow-800 hover:text-white border-yellow-500' }}">Accueil</a>
                            </li>
                            <li>
                                <a href="{{ route('about') }}" class="block py-2 px-3 {{ request()->routeIs('about') ? 'text-white bg-yellow-600 rounded-sm md:bg-transparent md:text-yellow-600 md:p-0' : 'rounded-sm md:hover:bg-transparent md:p-0 md:hover:text-yellow-500 text-white hover:bg-yellow-800 hover:text-white border-yellow-500' }}">A propos</a>
                            </li>
                            <li>
                                <a href="{{ route('contact') }}" class="block py-2 px-3 {{ request()->routeIs('contact') ? 'text-white bg-yellow-600 rounded-sm md:bg-transparent md:text-yellow-600 md:p-0' : 'rounded-sm md:hover:bg-transparent md:p-0 md:hover:text-yellow-500 text-white hover:bg-yellow-800 hover:text-white border-yellow-500' }}">Contact</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            @if (isset($home))
                @include('layouts.guest._home-hero')
            @else
                @include('layouts.guest._hero')
            @endif

        </header>

        @yield('content')

        @include('layouts.guest._footer')

        @include('layouts.guest._script')

    </body>
</html>
