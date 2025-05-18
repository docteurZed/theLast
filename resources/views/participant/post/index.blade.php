@extends('layouts.participant.app')

@section('content')
<div class="max-w-4xl mx-auto sm:px-4 sm:py-4 space-y-10 text-gray-400 mb-16">

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

    <!-- Formulaire de création -->
    <form method="POST" action="{{ route('participant.publication.store') }}" enctype="multipart/form-data"
        class="bg-gray-800 p-5 rounded-lg shadow space-y-4">
        @csrf
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

        <h2 class="text-xl font-semibold text-white">Créer une publication</h2>

        <textarea name="content" rows="3" class="w-full border rounded-md p-3 bg-gray-900 text-white"
            placeholder="Exprimez-vous...">{{ old('content') }}</textarea>

        <div class="flex items-center justify-between">
            <label class="cursor-pointer text-sm font-semibold">
                <input type="file" name="image" class="hidden" accept="image/*">
                📎 Ajouter une image
            </label>

            <button type="submit"
                class="bg-yellow-600 hover:bg-yellow-700 text-white font-medium px-4 py-2 rounded-md">
                Publier
            </button>
        </div>
    </form>

    <!-- Liste des publications -->
    @forelse($publications as $post)
    <div x-data="{ showAllComments: false }"
        class="bg-white dark:bg-gray-800 rounded-lg shadow space-y-4 mb-5">

        <!-- En-tête -->
        <div class="flex items-center gap-4 p-5 border-b border-gray-700">
            @if (isset($post->user->profile_photo))
            <img src="{{ asset('storage/public/' . basename($post->user->profile_photo)) }}" class="w-12 h-12 rounded-full object-cover" alt="Avatar">
            @else
            <img src="{{ asset('images/user.png') }}" class="w-10 h-10 rounded-full object-cover" alt="Avatar">
            @endif
            <div>
                <p class="font-semibold text-gray-900 dark:text-white">{{ $post->user->name }}</p>
                <span class="text-sm text-yellow-700">{{ $post->created_at->diffForHumans() }}</span>
            </div>
        </div>

        <!-- Contenu -->
        @if($post->content)
        <p class="px-5 py-2 text-white">{{ $post->content }}</p>
        @endif

        @if($post->image)
        <img src="{{ asset('storage/public/' . basename($post->image)) }}" class="w-full object-cover" alt="Image">
        @endif

        <!-- Actions -->
        <div class="flex justify-between items-center px-5 py-3 {{ !$post->image ? 'border-t border-gray-700' : '' }} font-semibold">
            <div class="flex items-center gap-4 text-sm">
                <button data-id="{{ $post->id }}"
                    class="like-button hover:text-yellow-600 cursor-pointer {{ $post->isLikedBy(auth()->user()) ? 'text-yellow-600' : 'text-gray-400' }}">
                    👍 J'aime (<span class="like-count">{{ $post->publication_likes->count() }}</span>)
                </button>
                <button @click="showAllComments = !showAllComments"
                    class="text-gray-500 hover:text-yellow-500 transition duration-150">
                    💬 <span class="comment-count">{{ $post->publication_comments->count() }}</span> commentaires
                </button>
            </div>
            @if(auth()->id() === $post->user_id)
            <form method="POST" action="{{ route('participant.publication.destroy', $post->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="text-red-500 hover:text-red-700 text-sm font-semibold">🗑 Supprimer</button>
            </form>
            @endif
        </div>

        <div x-show="showAllComments" x-transition class="comment-section mt-4 border-t border-gray-700 p-4 space-y-3" data-user-name="{{ ucfirst(Auth::user()->first_name) }} {{ ucfirst(Auth::user()->name) }}"
            data-user-photo="{{ Auth::user()->profile_photo ? asset('storage/public/' . basename(Auth::user()->profile_photo)) : asset('images/user.png') }}">

           <div class="comment-list space-y-4">
                @foreach($post->publication_comments as $comment)
                   <div class="flex items-center gap-3" data-created_at="{{ $comment->created_at->diffForHumans() }}" data-comment-id="{{ $comment->id }}">
                       @if (isset($comment->user->profile_photo))
                           <img src="{{ asset('storage/public/' . basename($comment->user->profile_photo)) }}" class="w-12 h-12 rounded-full object-cover" alt="Avatar">
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
                    class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 text-sm font-medium rounded-r-md">
                    Envoyer
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
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/dayjs@1/dayjs.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/dayjs@1/plugin/relativeTime.js"></script>
<script>
    dayjs.locale('fr');
    dayjs.extend(window.dayjs_plugin_relativeTime);
</script>
<script>
document.addEventListener('DOMContentLoaded', () => {

    // Gestion du like
    document.querySelectorAll('.like-button').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            const postId = this.dataset.id;

            axios.post(`/participant/publication/${postId}/like`)
                .then(response => {
                    this.classList.toggle('text-yellow-600');
                    this.classList.toggle('text-gray-400');

                    const countSpan = this.querySelector('.like-count');
                    if (countSpan) {
                        countSpan.textContent = response.data.likes_count;
                    }
                })
                .catch(error => {
                    console.error(error);
                    alert('Erreur lors du like.');
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
                const countSpan = commentSection.closest('.bg-white').querySelector('.comment-count');
                if (countSpan) {
                    const currentCount = parseInt(countSpan.textContent);
                    countSpan.textContent = currentCount + 1;
                }
            })
            .catch(error => {
                console.error(error);
                alert("Erreur lors de l'ajout du commentaire.");
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
