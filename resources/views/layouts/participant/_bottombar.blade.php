<div class="sm:hidden fixed bottom-0 left-0 z-50 w-full h-16 border-t bg-gray-900 border-gray-800">
    <div class="grid h-full max-w-lg grid-cols-5 mx-auto font-medium">
        <a href="{{ route('participant.dashboard') }}" class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-800 group {{ request()->routeIs('participant.dashboard') ? 'bg-gray-800' : '' }}">
            <svg class="w-5 h-5 mb-2 {{ request()->routeIs('participant.dashboard') ? 'text-yellow-600' : 'text-gray-400' }} group-hover:text-yellow-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
            </svg>
            <span class="text-sm font-semibold group-hover:text-yellow-600 {{ request()->routeIs('participant.dashboard') ? 'text-yellow-600' : 'text-gray-400' }}">Accueil</span>
        </a>
        <a href="{{ route('participant.galery.index') }}" class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-800 group {{ request()->routeIs('participant.galery.*') ? 'bg-gray-800' : '' }}">
            <svg class="w-5 h-5 mb-2 {{ request()->routeIs('participant.galery.*') ? 'text-yellow-600' : 'text-gray-400' }} group-hover:text-yellow-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3"/>
                <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2M14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1M2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1z"/>
            </svg>
            <span class="text-sm font-semibold group-hover:text-yellow-600 {{ request()->routeIs('participant.galery.*') ? 'text-yellow-600' : 'text-gray-400' }}">Promo</span>
        </a>
        <a href="{{ route('participant.post.index') }}" class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-800 group {{ request()->routeIs('participant.profile.*') ? 'bg-gray-800' : '' }}">
            <svg class="w-5 h-5 mb-2 {{ request()->routeIs('participant.post.*') ? 'text-yellow-600' : 'text-gray-400' }} group-hover:text-yellow-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                <path d="M0 13a1.5 1.5 0 0 0 1.5 1.5h13A1.5 1.5 0 0 0 16 13V6a1.5 1.5 0 0 0-1.5-1.5h-13A1.5 1.5 0 0 0 0 6zM2 3a.5.5 0 0 0 .5.5h11a.5.5 0 0 0 0-1h-11A.5.5 0 0 0 2 3m2-2a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7A.5.5 0 0 0 4 1"/>
            </svg>
            <span class="text-sm font-semibold group-hover:text-yellow-600 {{ request()->routeIs('participant.post.*') ? 'text-yellow-600' : 'text-gray-400' }}">Publication</span>
        </a>
        <a href="{{ route('participant.vote.index') }}" class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-800 group {{ request()->routeIs('participant.vote.*') ? 'bg-gray-800' : '' }}">
            <svg class="w-5 h-5 mb-2 {{ request()->routeIs('participant.vote.*') ? 'text-yellow-600' : 'text-gray-400' }} group-hover:text-yellow-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                <path d="M2.5.5A.5.5 0 0 1 3 0h10a.5.5 0 0 1 .5.5q0 .807-.034 1.536a3 3 0 1 1-1.133 5.89c-.79 1.865-1.878 2.777-2.833 3.011v2.173l1.425.356c.194.048.377.135.537.255L13.3 15.1a.5.5 0 0 1-.3.9H3a.5.5 0 0 1-.3-.9l1.838-1.379c.16-.12.343-.207.537-.255L6.5 13.11v-2.173c-.955-.234-2.043-1.146-2.833-3.012a3 3 0 1 1-1.132-5.89A33 33 0 0 1 2.5.5m.099 2.54a2 2 0 0 0 .72 3.935c-.333-1.05-.588-2.346-.72-3.935m10.083 3.935a2 2 0 0 0 .72-3.935c-.133 1.59-.388 2.885-.72 3.935"/>
            </svg>
            <span class="text-sm font-semibold group-hover:text-yellow-600 {{ request()->routeIs('participant.vote.*') ? 'text-yellow-600' : 'text-gray-400' }}">Votes</span>
        </a>
        <a href="{{ route('participant.notification.index') }}" class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-800 group {{ request()->routeIs('participant.notification.*') ? 'bg-gray-800' : '' }}">
            <div class="relative">
                <svg class="w-5 h-5 mb-2 {{ request()->routeIs('participant.notification.*') ? 'text-yellow-600' : 'text-gray-400' }} group-hover:text-yellow-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M16 8c0 3.866-3.582 7-8 7a9 9 0 0 1-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7M5 8a1 1 0 1 0-2 0 1 1 0 0 0 2 0m4 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0m3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
                </svg>
                @if ($messageCount > 0)
                    <span class="absolute -top-1.5 -right-1.5 flex items-center justify-center bg-red-500 text-white text-xs font-bold w-4 h-4 rounded-full shadow-md">
                        {{ $messageCount }}
                    </span>
                @endif
            </div>
            <span class="text-sm font-semibold group-hover:text-yellow-600 {{ request()->routeIs('participant.notification.*') ? 'text-yellow-600' : 'text-gray-400' }}">Messages</span>
        </a>
    </div>
</div>
