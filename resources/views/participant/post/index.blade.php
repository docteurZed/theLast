@extends('layouts.participant.app')

@section('content')
<div class="max-w-4xl mx-auto sm:p-6 space-y-6 text-gray-400 mb-16">

    @if (Session::has('success'))
    <div id="alert-1" class="flex items-center p-4 mb-4 bg-gray-800 text-green-400 rounded-xl" role="alert">
        <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
        </svg>
        <span class="sr-only">Info</span>
        <div class="ms-3 text-sm font-semibold">
            {{ Session::get('success') }}
        </div>
        <button type="button" class="ms-auto -mx-1.5 -my-1.5 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 inline-flex items-center justify-center h-8 w-8 bg-gray-800 text-green-400 hover:bg-green-700" data-dismiss-target="#alert-1" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
        </button>
    </div>
    @elseif ($errors->any())
        @foreach ($errors->all() as $error)
        <div id="alert-1" class="flex items-center p-4 mb-4 bg-gray-800 text-red-400 rounded-xl" role="alert">
            <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <div class="ms-3 text-sm font-semibold">
                {{ $error }}
            </div>
            <button type="button" class="ms-auto -mx-1.5 -my-1.5 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 inline-flex items-center justify-center h-8 w-8 bg-gray-800 text-red-400 hover:bg-red-700" data-dismiss-target="#alert-1" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>
        @endforeach
    @endif

    <div class="flex items-center justify-between w-full p-5  mb-5 border border-gray-700 bg-gray-800 rounded-xl">
        <p class="text-yellow-600 font-semibold">
            Quoi de neuf ?
        </p>
        <div>
            <button type="button" data-drawer-target="drawer-example" data-drawer-show="drawer-example" aria-controls="drawer-example" class="bg-gradient-to-r from-yellow-500 via-yellow-600 to-yellow-800 text-white px-6 py-3 rounded-lg font-semibold shadow-md hover:opacity-90 transition w-full sm:w-auto px-5 py-2.5 text-center cursor-pointer">
                Publier
            </button>
        </div>
    </div>

    {{-- <!-- Formulaire de création -->
    <form method="POST" action="{{ route('participant.publication.store') }}" enctype="multipart/form-data"
        class="bg-gray-800 p-5 rounded-lg shadow space-y-4">
        @csrf
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

        <h2 class="text-xl font-semibold text-white">Créer une publication</h2>

        <textarea name="content" rows="3" class="w-full border rounded-md p-3 bg-gray-900 text-white"
            placeholder="Exprimez-vous...">{{ old('content') }}</textarea>

        <div class="flex items-center justify-between">
            <label class="cursor-pointer text-sm font-semibold">
                <input type="file" name="image" class="hidden" accept="image/*" id="imageInput">
                📎 Ajouter une image
                <span id="fileName" class="text-xs block sm:inline text-gray-400 ml-2"></span>
            </label>

            <button type="submit"
                class="bg-gradient-to-r from-yellow-500 via-yellow-600 to-yellow-800 text-white px-6 py-3 rounded-lg font-semibold shadow-md hover:opacity-90 transition text-center font-semibold rounded-md">
                Publier
            </button>
        </div>
    </form> --}}

    <div id="drawer-example" class="fixed top-0 left-0 z-60 h-screen p-5 overflow-y-auto transition-transform -translate-x-full w-full sm:max-w-xl bg-gray-900 sm:border-r border-gray-800" tabindex="-1" aria-labelledby="drawer-label">
        <h5 id="drawer-label" class="inline-flex items-center mb-4 text-base font-semibold text-gray-400">
            Nouvelle publication
        </h5>
       <button type="button" data-drawer-hide="drawer-example" aria-controls="drawer-example" class="text-gray-400 hover:text-white bg-transparent rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 flex items-center justify-center hover:bg-gray-700" >
          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
          </svg>
          <span class="sr-only">Close menu</span>
       </button>

        <div class="mt-5">

            <form action="{{ route('participant.publication.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                <div class="mb-5">
                    <label for="content" class="block mb-2 text-lg font-semibold">Message <span class="text-red-500">*</span></label>
                    <textarea id="content" name="content" class="border rounded-lg block w-full p-2.5 bg-gray-800 border-gray-700 placeholder-gray-400 text-white focus:ring-yellow-600 focus:border-yellow-600 focus:outline-none @error('content') border-red-600 @enderror" placeholder="Votre publication ici...">{{ old('content') }}</textarea>
                </div>

                <div class="mb-5">
                    <p class="block mb-2 text-lg font-semibold">Ajouter une image <span class="text-sm italic">(facultatif)</span></p>
                    <div class="flex items-center justify-center w-full mb-5">
                        <label for="image" class="flex flex-col items-center justify-center w-full min-h-sm border rounded-lg cursor-pointer bg-gray-800 border-gray-700 hover:bg-gray-700">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6" id="preview-default">
                                <svg class="w-5 h-5 mb-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5
                                        5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0
                                        0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                </svg>
                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                                    <span class="font-semibold">Cliquer pour téléverser</span>
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG ou JPEG</p>
                            </div>
                            <!-- Miniature de l'image sélectionnée -->
                            <img id="image-preview" class="w-full h-full object-cover rounded-lg hidden" alt="Prévisualisation">
                            <input name="image" id="image" type="file" class="hidden" accept=".jpg,.png,.jpeg" />
                        </label>
                    </div>
                </div>

                <div class="relative mb-5"
                        x-data="{
                            open: false,
                            search: '',
                        }">

                    <p class="flex items-center justify-between mb-2 text-lg font-semibold">
                        <span>Taguer des amis ?</span>
                        <span>
                            <input type="checkbox" class="rounded border-gray-700 text-yellow-600 shadow-sm focus:ring-yellow-600 ring-offset-yellow-800 focus:ring-2 bg-gray-700  checked:bg-yellow-600 checked:border-yellow-600" @click="open = !open">
                        </span>
                    </p>

                    <div x-show="open" class="w-full bg-gray-800 border border-gray-700 rounded-md mt-1 overflow-hidden" x-transition>
                        <input type="text" x-model="search" placeholder="Rechercher..." class="w-full p-2 bg-gray-900 text-white placeholder-gray-400">
                        <ul class="max-h-64 overflow-y-auto">
                            @foreach ($users as $p)
                            @php
                                $fullName = ucfirst($p->first_name) . ' ' . ucfirst($p->name);
                                $escapedFullName = str_replace("'", "\\'", $fullName);
                            @endphp
                            <li x-show="'{{ strtolower($escapedFullName) }}'.includes(search.toLowerCase())"
                                class="px-4 py-2 hover:bg-gray-700 font-semibold cursor-pointer text-white flex items-center justify-between">
                                <span>{{ $fullName }}</span>
                                <span>
                                    <input id="is_anonymous" type="checkbox" class="rounded border-gray-700 text-yellow-600 shadow-sm focus:ring-yellow-600 ring-offset-yellow-800 focus:ring-2 bg-gray-700  checked:bg-yellow-600 checked:border-yellow-600" name="tagIds[]" value="{{ $p->id }}">
                                </span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="mb-5">
                    <button type="submit" class="bg-gradient-to-r from-yellow-500 via-yellow-600 to-yellow-800 text-white px-6 py-3 rounded-lg font-semibold shadow-md hover:opacity-90 transition w-full sm:w-auto px-5 py-2.5 text-center cursor-pointer">
                        Publier
                    </button>
                </div>
            </form>

        </div>
    </div>

    <!-- Liste des publications -->
    @forelse($publications as $post)
    <div x-data="{ showAllComments: false }"
        class="bg-gray-800 rounded-md shadow space-y-2 mb-5">

        <!-- En-tête -->
        <div class="flex items-center gap-4 p-5 border-b border-gray-700">
            @if (isset($post->user->profile_photo))
            <img src="{{ $post->user->profile_photo }}" class="w-12 h-12 rounded-full object-cover" alt="Avatar">
            @else
            <img src="{{ asset('images/user.png') }}" class="w-10 h-10 rounded-full object-cover" alt="Avatar">
            @endif
            <div>
                <p class="font-semibold text-white">{{ ucfirst($post->user->first_name) }} {{ ucfirst($post->user->name) }}
                    @if ($post->user->role == "admin")
                        <span class="text-gray-400 mx-2">•</span>
                        <span class="text-yellow-600 italic text-sm">Admin</span>
                    @endif
                </p>
                <span class="text-sm text-yellow-700">{{ $post->created_at->diffForHumans() }}</span>
                @if ($post->users->count() != 0)
                <p class="text-gray-400 text-sm font-semibold italic mt-2">
                    @foreach ($post->users as $user)
                        <span>@</span><span class="{{ $user->id == Auth::user()->id ? 'text-red-500' : '' }}">{{ $user->first_name }} {{ $user->name }}</span>{{ !$loop->last ? ', ' : '' }}
                    @endforeach
                </p>
                @endif
            </div>
        </div>

        <!-- Contenu -->
        @if($post->content)
        <p class="px-5 py-2 text-white">{{ $post->content }}</p>
        @endif

        @if($post->image)
        <img src="{{ $post->image }}" class="w-full object-cover" alt="Image">
        @endif

        <!-- Actions -->
        <div class="flex justify-between items-center px-5 py-3 {{ !$post->image ? 'border-t border-gray-700' : '' }} font-semibold">
            <div class="flex items-center gap-4 text-sm">
                <button data-id="{{ $post->id }}"
                    class="like-button hover:text-yellow-600 cursor-pointer {{ $post->isLikedBy(auth()->user()) ? 'text-yellow-600' : 'text-gray-400' }}">
                    👍<span class="hidden sm:inline"> J'aime</span> (<span class="like-count">{{ $post->publication_likes->count() }}</span>)
                    <svg class="spinner w-4 h-4 animate-spin hidden text-yellow-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="white" stroke-width="4"></circle>
                        <path class="opacity-75" fill="white" d="M4 12a8 8 0 018-8v8z"></path>
                    </svg>
                </button>
                <button @click="showAllComments = !showAllComments"
                    class="text-gray-500 hover:text-yellow-500 transition duration-150">
                    💬 <span class="comment-count">{{ $post->publication_comments->count() }}</span><span class="hidden sm:inline"> commentaires</span>
                </button>
            </div>
            @if(auth()->id() === $post->user_id)
            <form method="POST" action="{{ route('participant.publication.destroy', $post->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="text-red-500 hover:text-red-700 text-sm font-semibold">🗑<span class="hidden sm:inline"> Supprimer</span></button>
            </form>
            @endif
            @if ($post->image)
            <a href="{{ $post->image }}"
                download
                class="text-sm font-semibold text-white hover:bg-gray-400 transition">
                ⬇<span class="hidden sm:inline"> Télécharger l'image</span>
             </a>
            @endif
        </div>

        <div x-show="showAllComments" x-transition class="comment-section mt-4 border-t border-gray-700 p-4 space-y-3" data-user-name="{{ ucfirst(Auth::user()->first_name) }} {{ ucfirst(Auth::user()->name) }}"
            data-user-photo="{{ Auth::user()->profile_photo ?? asset('images/user.png') }}">

           <div class="comment-list space-y-4">
                @foreach($post->publication_comments as $comment)
                   <div class="flex items-center gap-3" data-created_at="{{ $comment->created_at->diffForHumans() }}" data-comment-id="{{ $comment->id }}">
                       @if (isset($comment->user->profile_photo))
                           <img src="{{ $comment->user->profile_photo }}" class="w-12 h-12 rounded-full object-cover" alt="Avatar">
                       @else
                           <img src="{{ asset('images/user.png') }}" class="w-12 h-12 rounded-full object-cover" alt="Avatar">
                       @endif
                       <div class="mb-2">
                           <p class="text-sm font-semibold text-yellow-500 mb-1">{{ ucfirst($comment->user->first_name) }} {{ ucfirst($comment->user->name) }}
                            <span class="text-gray-400 mx-2">•</span>
                            <span class="text-gray-400 italic font-normal">{{ $comment->created_at->diffForHumans() }}</span>
                           </p>

                           @if ($comment->user_id === Auth::id())
                                <button class="delete-comment text-xs text-red-500 hover:text-red-700" data-id="{{ $comment->id }}">
                                    Supprimer
                                </button>
                            @endif
                           <p class="text-sm">{{ $comment->content }}</p>
                       </div>
                   </div>
               @endforeach
           </div>

           <form class="comment-form flex items-center gap-3 pt-4">
               @csrf
               <input type="hidden" name="publication_id" value="{{ $post->id }}">
               <div class="flex w-full">
                <input type="text" name="content" placeholder="Ajouter un commentaire..."
                    class="flex-1 border border-gray-700 rounded-l-md px-4 py-2 text-white bg-gray-900 focus:outline-none focus:ring-2 focus:ring-yellow-600">

                <button type="submit"
                    class="bg-gradient-to-r from-yellow-500 via-yellow-600 to-yellow-800 text-white px-6 py-3 font-semibold hover:opacity-90 transition text-center px-4 py-2 text-sm rounded-r-md">
                    <span>Envoyer</span>
                    <svg class="spinner w-4 h-4 animate-spin hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="white" stroke-width="4"></circle>
                        <path class="opacity-75" fill="white" d="M4 12a8 8 0 018-8v8z"></path>
                    </svg>
                </button>
            </div>
           </form>

       </div>
    </div>
    @empty
        <div>

        </div>
    @endforelse
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<!-- Alpine.js v3 (CDN officiel) -->
{{-- <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<script src="https://cdn.jsdelivr.net/npm/dayjs@1/dayjs.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/dayjs@1/plugin/relativeTime.js" ></script>
<script>
    dayjs.locale('fr');
    dayjs.extend(window.dayjs_plugin_relativeTime);
</script>
<script>
document.addEventListener('DOMContentLoaded', () => {

    const input = document.getElementById('image');
    const previewImage = document.getElementById('image-preview')
    const defaultPreview = document.getElementById('preview-default');

    input.addEventListener('change', function () {
        const file = this.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                previewImage.setAttribute('src', e.target.result);
                previewImage.classList.remove('hidden');
                defaultPreview.classList.add('hidden'); // cacher l'icône et le texte par défaut
            };
            reader.readAsDataURL(file);
        } else {
            previewImage.classList.add('hidden');
            defaultPreview.classList.remove('hidden');
        }
    });

    // Gestion du like
    document.querySelectorAll('.like-button').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            const postId = this.dataset.id;
            const spinner = this.querySelector('.spinner');
            spinner.classList.remove('hidden');

            axios.post(`/participant/publication/${postId}/like`)
                .then(response => {
                    this.classList.toggle('text-yellow-600');
                    this.classList.toggle('text-gray-400');

                    // const countSpan = this.querySelector('.like-count');
                    // if (countSpan) {
                    //     countSpan.textContent = response.data.likes_count;
                    // }
                })
                .catch(error => {
                    console.error(error);
                    alert('Erreur lors du like.');
                })
                .finally(() => {
                    spinner.classList.add('hidden');
                });
        });
    });

    document.querySelectorAll('.comment-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            const input = this.querySelector('input[name="content"]');
            const postId = this.querySelector('input[name="publication_id"]').value;
            const content = input.value.trim();
            if (!content) return;

            const submitBtn = this.querySelector('button[type="submit"]');
            const spinner = submitBtn.querySelector('.spinner');
            spinner.classList.remove('hidden');

            axios.post(`{{ route('participant.publication.comment') }}`, {
                publication_id: postId,
                content: content,
            })
            .then(response => {
                const commentSection = this.closest('.comment-section');
                const commentList = commentSection.querySelector('.comment-list');

                const userName = commentSection.dataset.userName;
                const userPhoto = commentSection.dataset.userPhoto;

                const now = dayjs().fromNow(); // "il y a quelques secondes"

                const newComment = document.createElement('div');
                newComment.classList.add('flex', 'gap-4', 'mb-4');

                newComment.innerHTML = `
                    <img src="${userPhoto}" class="w-12 h-12 rounded-full object-cover" alt="Avatar">
                    <div class="mb-2">
                        <p class="text-sm font-semibold text-yellow-500 mb-1">
                            ${userName}
                            <span class="text-gray-400 mx-2">•</span>
                            <span class="text-gray-400 italic font-normal">${now}</span>
                        </p>
                        <p class="text-sm">${content}</p>
                    </div>
                `;

                commentList.appendChild(newComment);
                input.value = '';

                // Met à jour le compteur de commentaires
                // const countSpan = commentSection.closest('.bg-gray-800').querySelector('.comment-count');
                // if (countSpan) {
                //     const currentCount = parseInt(countSpan.textContent);
                //     countSpan.textContent = currentCount + 1;
                // }
            })
            .catch(error => {
                console.error(error);
                alert("Erreur lors de l'ajout du commentaire.");
            })
            .finally(() => {
                spinner.classList.add('hidden');
            });
        });
    });

    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('delete-comment')) {
            const commentId = e.target.dataset.id;

            if (!confirm("Voulez-vous vraiment supprimer ce commentaire ?")) return;

            axios.delete(`/participant/publication/comment/${commentId}/destroy`)
                .then(response => {
                    if (response.data.success) {
                        const commentDiv = e.target.closest('[data-comment-id]');
                        commentDiv.remove();


                    }
                })
                .catch(error => {
                    alert("Une erreur est survenue.");
                    console.error(error);
                });
        }
    });
});
</script>
@endsection

