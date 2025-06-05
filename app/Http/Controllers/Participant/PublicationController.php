<?php

namespace App\Http\Controllers\Participant;

use App\Http\Controllers\Controller;
use App\Http\Requests\PublicationRequest;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCommentRequest;
use App\Models\Publication;
use App\Models\PublicationComment;
use App\Models\User;
use App\Notifications\PublicationNotification;
use App\Notifications\UserActivityNotification;
use App\Services\PublicationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class PublicationController extends Controller
{
    protected PublicationService $service;

    public function __construct(PublicationService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return view('participant.post.index', [
            'publications' => $this->service->list(),
            'users' => User::where('role', '!=', 'admin')
                            ->where('id', '!=', Auth::user()->id)
                            ->get(['id', 'first_name', 'name'])
        ]);
    }

    public function store(PublicationRequest $request): RedirectResponse
    {
        $publication = $this->service->create($request);
        $users = User::where('id', '!=', Auth::user()->id)->get();
        foreach ($users as $user) {
            $user->notify(new PublicationNotification(
                type: 'publication',
                message: ucfirst($publication->user->first_name) . ' ' . ucfirst($publication->user->name) . " a fait une publication.",
                url: url(route('participant.publication.index')),
                emailSubject: 'Quelqu’un a fait une publication.',
                emailIntro: ucfirst($publication->user->first_name) . ' ' . ucfirst($publication->user->name) . " vient de faire une publication."
            ));
        }
        if ($publication->users->count() != 0) {
            foreach ($publication->users as $user) {
                $user->notify(new UserActivityNotification(
                    type: 'publication',
                    message: ucfirst($publication->user->first_name) . ' ' . ucfirst($publication->user->name) . " vous a mentionné dans une publication.",
                    url: url(route('participant.publication.index')),
                    emailSubject: 'Quelqu’un a vous a mentionné dans une publication.',
                    emailIntro: ucfirst($publication->user->first_name) . ' ' . ucfirst($publication->user->name) . " vient de vous mentionner dans une publication."
                ));
            }
        }
        return back()->with('success', 'Publication créée avec succès.');
    }

    public function toggleLike(int $id)
    {
        $result = $this->service->toggleLike($id);
        $publication = Publication::findOrFail($id);
        $user = Auth::user();

        if($user->id != $publication->user->id) {
            $publication->user->notify(new UserActivityNotification(
                type: 'like',
                message: ucfirst($user->first_name) . ' ' . ucfirst($user->name) . " a aimé votre publication.",
                url: url(route('participant.publication.index')),
                emailSubject: 'Quelqu’un a aimé votre publication.',
                emailIntro: ucfirst($user->first_name) . ' ' . ucfirst($user->name) . " vient de liker votre publication."
            ));
        }

        return response()->json([
            'liked' => $result['liked'],
            'likes_count' => $result['publication']->likes_count,
        ]);
    }

    public function addComment(Request $request): RedirectResponse
    {
        $request->validate([
            'publication_id' => 'required|exists:publications,id',
            'content' => 'required|string',
        ], [
            'publication_id.required' => 'La publication est obligatoire.',
            'publication_id.exists' => 'La publication sélectionnée n’existe pas.',
            'content.required' => 'Le contenu du commentaire est obligatoire.',
        ]);

        $comment = $this->service->addComment($request);
        $user = Auth::user();

        if($user->id != $comment->publication->user->id) {
            $comment->publication->user->notify(new UserActivityNotification(
                type: 'comment',
                message: ucfirst($user->first_name) . ' ' . ucfirst($user->name) . " a commenté votre publication.",
                url: url(route('participant.publication.index')),
                emailSubject: 'Nouveau commentaire',
                emailIntro: ucfirst($user->first_name) . ' ' . ucfirst($user->name) . " a laissé un commentaire sur votre publication."
            ));
        }

        return back()->with('success', 'Commentaire ajouté.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $success = $this->service->delete($id);

        if (!$success) {
            return back()->with('error', 'Publication introuvable ou non autorisée.');
        }

        return back()->with('success', 'Publication supprimée avec succès.');
    }

    public function destroyComment($id)
    {
        $comment = PublicationComment::findOrFail($id);
        if ($comment->user_id !== Auth::user()->id) {
            return response()->json(['error' => 'Non autorisé'], 403);
        }
        $comment->delete();
        return response()->json(['success' => true]);
    }

}

