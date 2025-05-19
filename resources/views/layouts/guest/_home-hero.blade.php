<section class="px-5 md:px-16 lg:px-24 mx-auto max-w-screen-xl py-24 lg:py-48">
    <div class="fade-section md:grid grid-cols-5 gap-4">
        <div class="col-span-3 mt-8 md:mt-0">
            <p class="mb-2 font-semibold fs-12 bg-gradient-to-r from-yellow-600 to-yellow-800 bg-clip-text text-transparent">{{ $sections['hero']->name }}</p>
            <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-white md:text-5xl">{{ $sections['hero']->title }}</h1>
            <p class="mb-8 lg:mb-12 text-lg font-normal text-gray-300 lg:text-xl">{{ $sections['hero']->description }}</p>

            <!-- Décompte stylisé avec cercles -->
            <div class="grid grid-cols-4 space-x-4 text-yellow-600 font-bold text-xl sm:text-2xl md:text-4xl">

                <!-- Bloc unité -->
                <div class="relative w-20 h-20 md:w-24 md:h-24 flex items-center justify-center">
                    <div class="absolute w-full h-full rounded-full border-2 border-dashed border-yellow-600 animate-spin-slow"></div>
                    <div class="flex flex-col items-center z-10">
                        <span id="days">00</span>
                        <span class="text-sm text-white mt-1">Jours</span>
                    </div>
                </div>

                <div class="relative w-20 h-20 md:w-24 md:h-24 flex items-center justify-center">
                    <div class="absolute w-full h-full rounded-full border-2 border-dashed border-yellow-600 animate-spin-slow"></div>
                    <div class="flex flex-col items-center z-10">
                        <span id="hours">00</span>
                        <span class="text-sm text-white mt-1">Heures</span>
                    </div>
                </div>

                <div class="relative w-20 h-20 md:w-24 md:h-24 flex items-center justify-center">
                    <div class="absolute w-full h-full rounded-full border-2 border-dashed border-yellow-600 animate-spin-slow"></div>
                    <div class="flex flex-col items-center z-10">
                        <span id="minutes">00</span>
                        <span class="text-sm text-white mt-1">Minutes</span>
                    </div>
                </div>

                <div class="relative w-20 h-20 md:w-24 md:h-24 flex items-center justify-center">
                    <div class="absolute w-full h-full rounded-full border-2 border-dashed border-yellow-600 animate-spin-slow"></div>
                    <div class="flex flex-col items-center z-10">
                        <span id="seconds">00</span>
                        <span class="text-sm text-white mt-1">Secondes</span>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>