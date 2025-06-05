<nav class="fixed top-0 z-50 w-full border-b bg-gray-900 border-gray-800">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start rtl:justify-end">
                <a href="{{ route('participant.dashboard') }}" class="flex ms-2 md:me-24">
                    <span class="self-center text-3xl sm:text-4xl font-bold whitespace-nowrap text-white">
                        the<span class="bg-gradient-to-r from-yellow-800 via-yellow-600 to-yellow-500 bg-clip-text text-transparent">Last</span>
                </a>
            </div>
            <div class="flex items-center">
                <div class="flex items-center ms-3">
                    <div class="flex items-center space-x-4">
                        <div class="relative inline-block shrink-0">
                            <a href="{{ route('participant.notification.notif') }}" class="cursor-pointer focus:ring-4 focus:ring-gray-700 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6 text-white" viewBox="0 0 16 16">
                                    <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2m.995-14.901a1 1 0 1 0-1.99 0A5 5 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901"/>
                                </svg>
                            </a>
                            <span class="absolute -top-1 -right-1 bg-red-500 w-2 h-2 rounded-full"></span>
                        </div>
                        <button type="button" class="flex text-sm rounded-full focus:ring-4 focus:ring-gray-700 cursor-pointer" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                            <span class="sr-only">Open user menu</span>
                            @if (isset(Auth::user()->profile_photo))
                            <img src="{{ Auth::user()->profile_photo }}" alt="Photo de profil" class="w-8 h-8 rounded-full">
                            @else
                            <img src="{{ asset('images/user.png') }}" alt="Photo de profil" class="w-8 h-8 rounded-full">
                            @endif
                        </button>
                    </div>
                    <div class="z-50 hidden my-4 text-base list-none divide-y rounded-sm shadow-sm bg-gray-800 divide-gray-700" id="dropdown-user">
                        <ul class="py-1" role="none">
                            <li>
                                <a href="{{ route('participant.profile.index') }}" class="flex items-center px-4 py-2 text-sm font-semibold text-gray-400 hover:bg-gray-600 group" role="menuitem">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-5 h-5 transition duration-75" viewBox="0 0 16 16">
                                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                                    </svg>
                                    <span class="ms-2">Profile</span>
                                </a>
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="post" class="w-full">
                                    @csrf
                                    <button type="submit" class="flex items-center px-4 py-2 text-sm font-semibold text-red-500 hover:bg-red-800 hover:text-red-200 group w-full" role="menuitem">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-5 h-5 transition duration-75" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"/>
                                            <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
                                        </svg>
                                        <span class="ms-2">Déconnexion</span>
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full border-r sm:translate-x-0 border-gray-800" aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-gray-900">
        <ul class="space-y-2 font-medium">
            <li>
                <a href="{{ route('participant.dashboard') }}" class="flex items-center px-2 py-3 rounded-lg {{ request()->routeIs('participant.dashboard') ? 'bg-yellow-600 text-white' : 'text-gray-400' }} hover:bg-yellow-800 font-semibold group">
                    <svg class="w-5 h-5 transition duration-75" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                        <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                        <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
                    </svg>
                    <span class="ms-3">Tableau de bord</span>
                </a>
            </li>
            <li>
                <a href="{{ route('participant.galery.index') }}" class="flex items-center px-2 py-3 rounded-lg {{ request()->routeIs('participant.galery.*') ? 'bg-yellow-600 text-white' : 'text-gray-400' }} text-gray-400 hover:bg-yellow-800 font-semibold group">
                    <svg class="w-5 h-5 transition duration-75" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3"/>
                        <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2M14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1M2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1z"/>
                    </svg>
                    <span class="ms-3">Promo</span>
                </a>
                <a href="{{ route('participant.post.index') }}" class="flex items-center px-2 py-3 rounded-lg {{ request()->routeIs('participant.post.*') ? 'bg-yellow-600 text-white' : 'text-gray-400' }} hover:bg-yellow-800 font-semibold group">
                    <svg class="w-5 h-5 transition duration-75" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M0 13a1.5 1.5 0 0 0 1.5 1.5h13A1.5 1.5 0 0 0 16 13V6a1.5 1.5 0 0 0-1.5-1.5h-13A1.5 1.5 0 0 0 0 6zM2 3a.5.5 0 0 0 .5.5h11a.5.5 0 0 0 0-1h-11A.5.5 0 0 0 2 3m2-2a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7A.5.5 0 0 0 4 1"/>
                    </svg>
                    <span class="ms-3">Publication</span>
                </a>
                <a href="{{ route('participant.vote.index') }}" class="flex items-center px-2 py-3 rounded-lg {{ request()->routeIs('participant.vote.*') ? 'bg-yellow-600 text-white' : 'text-gray-400' }} text-gray-400 hover:bg-yellow-800 font-semibold group">
                    <svg class="w-5 h-5 transition duration-75" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                    </svg>
                    <span class="ms-3">Votes</span>
                </a>
            </li>
            <ul class="pt-4 mt-4 space-y-2 font-medium border-t border-gray-800">
                <a href="{{ route('participant.profile.index') }}" class="flex items-center px-2 py-3 rounded-lg {{ request()->routeIs('participant.profile.*') ? 'bg-yellow-600 text-white' : 'text-gray-400' }} hover:bg-yellow-800 font-semibold group">
                    <svg class="w-5 h-5 transition duration-75" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                    </svg>
                    <span class="ms-3">Profil</span>
                </a>
                <a href="{{ route('participant.notification.index') }}" class="flex items-center px-2 py-3 rounded-lg text-gray-400 hover:bg-yellow-800 font-semibold group">
                    <svg class="w-5 h-5 transition duration-75" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H4.414a1 1 0 0 0-.707.293L.854 15.146A.5.5 0 0 1 0 14.793zm3.5 1a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1zm0 2.5a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1zm0 2.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1z"/>
                    </svg>
                    <span class="ms-3">Messages</span>
                </a>
                <form action="{{ route('logout') }}" method="post" class="w-full">
                    @csrf
                    <button type="submit" class="flex items-center px-2 py-3 rounded-lg text-red-500 hover:bg-red-800 hover:text-white font-semibold group w-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-5 h-5 transition duration-75" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"/>
                            <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
                        </svg>
                        <span class="ms-3">Déconnexion</span>
                    </button>
                </form>
            </ul>
        </ul>
    </div>
</aside>
