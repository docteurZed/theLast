<section class="text-center px-5 md:px-16 lg:px-24 mx-auto max-w-screen-xl py-24 lg:py-36">
    <div class="fade-section">
        <div class="mt-8 md:mt-0 flex flex-col justify-center">
            <h1 class="mb-4 text-2xl font-extrabold tracking-tight leading-none text-white md:text-3xl">
                {{ $header }}
            </h1>
            <nav class="flex mx-auto" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}" class="inline-flex items-center text-lg font-semibold text-white hover:text-yellow-600">
                            Accueil
                        </a>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                            <span class="ms-1 text-lg font-semibold text-yellow-600 md:ms-2">
                                {{ $header }}
                            </span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</section>