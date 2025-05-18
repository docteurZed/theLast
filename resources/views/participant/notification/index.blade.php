@extends('layouts.participant.app')

@section('content')

<div class="max-w-4xl mx-auto sm:p-6 space-y-4 text-gray-400 mb-20">
    @forelse ($messages as $msg)
    <div id="section-{{ $msg->id }}" class="flex items-center {{ !$msg->is_read ? 'bg-gray-700 border border-white' : 'bg-gray-800' }} mb-4 rounded-xl shadow-xl p-5 cursor-pointer" data-modal-target="message-modal-{{ $msg->id }}" data-modal-toggle="message-modal-{{ $msg->id }}" onclick="messageReadStatus({{ $msg->id }})">
        <div class="relative inline-block shrink-0">
            <img class="w-12 h-12 rounded-full" src="{{ asset('images/user.png') }}" alt="image"/>
            <span class="absolute bottom-0 right-0 inline-flex items-center justify-center w-6 h-6 bg-yellow-500 rounded-full">
                <svg class="w-3 h-3 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 18" fill="currentColor">
                    <path d="M18 4H16V9C16 10.0609 15.5786 11.0783 14.8284 11.8284C14.0783 12.5786 13.0609 13 12 13H9L6.846 14.615C7.17993 14.8628 7.58418 14.9977 8 15H11.667L15.4 17.8C15.5731 17.9298 15.7836 18 16 18C16.2652 18 16.5196 17.8946 16.7071 17.7071C16.8946 17.5196 17 17.2652 17 17V15H18C18.5304 15 19.0391 14.7893 19.4142 14.4142C19.7893 14.0391 20 13.5304 20 13V6C20 5.46957 19.7893 4.96086 19.4142 4.58579C19.0391 4.21071 18.5304 4 18 4Z" fill="currentColor"/>
                    <path d="M12 0H2C1.46957 0 0.960859 0.210714 0.585786 0.585786C0.210714 0.960859 0 1.46957 0 2V9C0 9.53043 0.210714 10.0391 0.585786 10.4142C0.960859 10.7893 1.46957 11 2 11H3V13C3 13.1857 3.05171 13.3678 3.14935 13.5257C3.24698 13.6837 3.38668 13.8114 3.55279 13.8944C3.71889 13.9775 3.90484 14.0126 4.08981 13.996C4.27477 13.9793 4.45143 13.9114 4.6 13.8L8.333 11H12C12.5304 11 13.0391 10.7893 13.4142 10.4142C13.7893 10.0391 14 9.53043 14 9V2C14 1.46957 13.7893 0.960859 13.4142 0.585786C13.0391 0.210714 12.5304 0 12 0Z" fill="currentColor"/>
                    </svg>
                <span class="sr-only">Message icon</span>
            </span>
        </div>
        <div class="ms-3 text-sm">
            @if ($msg->is_anonymous)
            <div class="text-sm font-bold italic text-white mb-2">Message anonyme</div>
            @else
            <div class="text-sm font-bold text-white mb-2">{{ ucfirst($msg->sender->first_name) }} {{ ucfirst($msg->sender->name) }}</div>
            @endif
            <div class="text-sm font-semibold">{{ Str::limit($msg->content, 50) }}</div>
            <span class="text-xs font-medium text-yellow-600">{{ $msg->created_at->diffForHumans() }}</span>
        </div>
    </div>

    <!-- Modal for each message -->
    <div id="message-modal-{{ $msg->id }}" tabindex="-1" aria-hidden="true"
        class="hidden fixed top-0 left-0 right-0 z-50 flex justify-center items-center w-full p-4 overflow-x-hidden overflow-y-auto h-full bg-gray-950 bg-opacity-60">
        <div class="relative w-full max-w-md max-h-full">
            <div class="relative bg-gray-800 rounded-lg shadow dark:bg-gray-800 p-6">
                <button type="button" class="absolute top-3 right-2.5 text-gray-400 hover:text-white bg-transparent hover:bg-gray-700 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                    data-modal-hide="message-modal-{{ $msg->id }}">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd"
                        d="M10 8.586l4.95-4.95a1 1 0 111.414 1.414L11.414 10l4.95 4.95a1 1 0 01-1.414 1.414L10 11.414l-4.95 4.95a1 1 0 01-1.414-1.414L8.586 10 3.636 5.05a1 1 0 011.414-1.414L10 8.586z"
                        clip-rule="evenodd"/></svg>
                </button>
                @if ($msg->is_anonymous)
                <h3 class="text-xl font-semibold italic text-white border-b border-gray-700 mb-4 pb-3">Anonyme</h3>
                @else
                <h3 class="text-xl font-semibold text-white border-b border-gray-700 mb-4 pb-3">{{ ucfirst($msg->sender->first_name) }} {{ ucfirst($msg->sender->name) }}</h3>
                @endif
                <p class="text-gray-400 text-sm whitespace-pre-line">{{ $msg->content }}</p>
            </div>
        </div>
    </div>
    @empty
    <p class="text-gray-400 text-sm text-center py-16">Aucun message reçu.</p>
    @endforelse
</div>

<script>

    function messageReadStatus(msgId) {

        const routeUrl = "{{ route('participant.message.updateStatut', ['id' => 'MSG_ID']) }}".replace('MSG_ID', msgId);

        fetch(routeUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            let section = document.getElementById('section-' + msgId);
            if (data.success) {
                section.classList.remove('bg-gray-700', 'border', 'border-white');
                section.classList.add('bg-gray-800');
            } else {
                console.log(data.message)
            }
        })
        .catch(error => {
            Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Une erreur s\'est produite lors du changement du statut',
                    showConfirmButton: false,
                    timer: 3000
                });z
        });
    }

</script>


@endsection
