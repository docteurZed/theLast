<footer class="bg-gray-950 p-4 md:px-12 border-t border-gray-600">
    <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
        <div class="sm:flex sm:items-center sm:justify-between">
            <a href="{{ route('home') }}" class="flex items-center mb-4 sm:mb-0 space-x-3 rtl:space-x-reverse">
                <span class="self-center text-3xl font-bold whitespace-nowrap text-white">
                    the<span class="bg-gradient-to-r from-yellow-800 via-yellow-600 to-yellow-500 bg-clip-text text-transparent">Last</span>
                </span>
            </a>
            <ul class="flex flex-wrap items-center mb-6 text-sm font-semibold sm:mb-0 text-gray-400">
                <li>
                    <a href="{{ route('home') }}" class="hover:underline me-4 md:me-6">Accueil</a>
                </li>
                <li>
                    <a href="{{ route('about') }}" class="hover:underline me-4 md:me-6">A propos</a>
                </li>
                <li>
                    <a href="{{ route('contact') }}" class="hover:underline">Contact</a>
                </li>
            </ul>
        </div>
        <hr class="my-6 sm:mx-auto border-gray-700 lg:my-8" />
        <span class="block text-sm sm:text-center text-gray-400 font-semibold">© {{ now()->year }} <a href="{{ route('home') }}" class="hover:underline text-yellow-600">{{ env('APP_NAME') }}</a>. Tout droit réservé.</span>
    </div>
</footer>