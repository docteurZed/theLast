<?php

namespace App\Services;

use App\Models\Publication;
use App\Models\PublicationComment;
use App\Models\PublicationLike;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PublicationService
{
    public function __construct(
        protected CloudinaryService $cloudinary
    ) {}

    public function list(): Collection
    {
        return Publication::orderBy('created_at', 'desc')->get();
    }

    public function create(Request $data): Publication
    {
        $payload = $data->only(['content', 'user_id']);

        if ($data->hasFile('image') && $data->file('image')->isValid()) {
            $filePath = $data->file('image')->getRealPath();
            $uploadResult = $this->cloudinary->upload($filePath, [
                'folder' => 'images',
            ]);

            $payload['image'] = $uploadResult['secure_url'] ?? null;
        }

        return Publication::create($payload);
    }

    public function toggleLike(int $publicationId): array
    {
        $user = Auth::user();
        $publication = Publication::findOrFail($publicationId);

        $existingLike = PublicationLike::where('user_id', $user->id)
            ->where('publication_id', $publication->id)
            ->first();

        if ($existingLike) {
            $existingLike->delete();
            $liked = false;
        } else {
            PublicationLike::create([
                'user_id' => $user->id,
                'publication_id' => $publication->id,
            ]);
            $liked = true;
        }

        return [
            'liked' => $liked,
            'publication' => $publication->loadCount('publication_likes'),
        ];
    }

    public function AddComment(Request $data): PublicationComment
    {
        return PublicationComment::create([
            'publication_id' => $data->publication_id,
            'user_id' => Auth::user()->id,
            'content' => $data->content,
        ]);
    }

    public function delete(int $post_id): bool
    {
        $post = Publication::where('id', $post_id)
                    ->where('user_id', Auth::user()->id)
                    ->first();

        if (!$post) {
            return false;
        }

        // if ($post->image) {
        //     $publicId = $this->cloudinary->extractPublicId($post->image);
        //     $this->cloudinary->delete($publicId);
        // }

        $post->delete();
        return true;
    }

}
