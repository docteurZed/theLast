@extends('layouts.participant.app')

@section('content')
<div class="max-w-4xl mx-auto sm:px-4 sm:py-4 space-y-10 text-gray-400 mb-16">
    <!-- Formulaire de création -->
    <div class="bg-gray-800 p-5 rounded-lg shadow space-y-4">
        <h2 class="text-xl font-semibold text-white">Créer une publication</h2>

        <textarea rows="3" class="w-full border rounded-md p-3" placeholder="Exprimez-vous..."></textarea>

        <div class="flex items-center justify-between">
            <label class="cursor-pointer text-sm font-semibold">
                <input type="file" multiple class="hidden" accept="image/*,video/*">
                📎 Ajouter photo/vidéo
            </label>

            <button class="bg-yellow-600 hover:bg-yellow-700 text-white font-medium px-4 py-2 rounded-md">
                Publier
            </button>
        </div>
    </div>

    <!-- Publication exemple -->
    <div x-data="{ showAllComments: false }" class="bg-white dark:bg-gray-800 rounded-lg shadow space-y-4 mb-5">
        <div class="flex items-center gap-4 p-5 border-b border-gray-700">
            <img src="{{ asset('images/user.png') }}" class="w-10 h-10 rounded-full object-cover" alt="Avatar">
            <div>
                <p class="font-semibold text-gray-900 dark:text-white">Jean Dupont</p>
                <span class="text-sm text-yellow-700">il y a 2 heures</span>
            </div>
        </div>

        <p class="px-5 py-4">
            Magnifique coucher de soleil 🌇
        </p>

        <img src="{{ asset('images/bg.jpg') }}" alt="Publication" class="w-full object-cover max-h-[400px]">

        <div class="flex justify-between items-center px-5 py-3 font-semibold">
            <div class="flex items-center gap-4 text-sm">
                <button class="hover:text-yellow-600 cursor-pointer">👍 J'aime</button>
                <button class="hover:text-yellow-600 cursor-pointer">💬 Commenter</button>
            </div>
            <a href="{{ asset('images/bg.jpg') }}" download class="text-sm text-gray-500 hover:text-yellow-600">⬇️ Télécharger</a>
        </div>

        <!-- Commentaires -->
        <div class="mt-4 border-t border-gray-700 p-4 space-y-3">
            <!-- Commentaires masqués -->
            <template x-if="showAllComments">
                <div class="space-y-3">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('images/user.png') }}" class="w-8 h-8 rounded-full object-cover" alt="Avatar">
                        <div>
                            <p class="text-sm font-semibold text-yellow-500">Julie</p>
                            <p class="text-sm">J'adore cette photo 😍</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <img src="{{ asset('images/user.png') }}" class="w-8 h-8 rounded-full object-cover" alt="Avatar">
                        <div>
                            <p class="text-sm font-semibold text-yellow-500">Lucas</p>
                            <p class="text-sm">Très belle lumière !</p>
                        </div>
                    </div>
                </div>
            </template>

            <!-- Dernier commentaire toujours visible -->
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/user.png') }}" class="w-8 h-8 rounded-full object-cover" alt="Avatar">
                <div>
                    <p class="text-sm font-semibold text-yellow-500">Claire</p>
                    <p class="text-sm">Superbe vue Lorem ipsum dolor sit...</p>
                </div>
            </div>

            <!-- Bouton pour afficher les autres -->
            <button x-show="!showAllComments" @click="showAllComments = true"
                class="w-full text-sm font-semibold text-center text-yellow-500 hover:underline mt-2">
                Voir tous les commentaires
            </button>

            <!-- Formulaire de commentaire -->
            <div class="flex items-center gap-3 border-t border-gray-700 pt-4">
                <img src="{{ asset('images/user.png') }}" class="w-8 h-8 rounded-full object-cover" alt="Avatar">
                <div class="flex w-full">
                    <input type="text" placeholder="Ajouter un commentaire..."
                        class="flex-1 border border-gray-700 rounded-l-md px-4 py-2 text-white bg-gray-900 focus:outline-none focus:ring-2 focus:ring-yellow-600">

                    <button class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 text-sm font-medium rounded-r-md">
                        Envoyer
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

@endsection
