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
                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
            </svg>
            <span class="text-sm font-semibold group-hover:text-yellow-600 {{ request()->routeIs('participant.vote.*') ? 'text-yellow-600' : 'text-gray-400' }}">Votes</span>
        </a>
        <a href="{{ route('participant.notification.index') }}" class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-800 group {{ request()->routeIs('participant.notification.*') ? 'bg-gray-800' : '' }}">
            <svg class="w-5 h-5 mb-2 {{ request()->routeIs('participant.notification.*') ? 'text-yellow-600' : 'text-gray-400' }} group-hover:text-yellow-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H4.414a1 1 0 0 0-.707.293L.854 15.146A.5.5 0 0 1 0 14.793zm3.5 1a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1zm0 2.5a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1zm0 2.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1z"/>
            </svg>
            <span class="text-sm font-semibold group-hover:text-yellow-600 {{ request()->routeIs('participant.notification.*') ? 'text-yellow-600' : 'text-gray-400' }}">Messages</span>
        </a>
    </div>
</div>
