<?php

namespace App\Http\Controllers\Participant;

use App\Http\Controllers\Controller;
use App\Http\Requests\PublicationRequest;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCommentRequest;
use App\Models\PublicationComment;
use App\Services\PublicationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PublicationController extends Controller
{
    protected PublicationService $service;

    public function __construct(PublicationService $service)
    {
        $this->service = $service;
    }

    // public function index(): View
    // {
    //     return view('publications.index', [
    //         'publications' => $this->service->list(),
    //     ]);
    // }

    public function store(PublicationRequest $request): RedirectResponse
    {
        $this->service->create($request);
        return back()->with('success', 'Publication créée avec succès.');
    }

    public function toggleLike(int $id)
    {
        $result = $this->service->toggleLike($id);

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

        $this->service->addComment($request);

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

