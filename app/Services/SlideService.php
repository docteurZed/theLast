<?php

namespace App\Services;

use App\Models\Slide;
use App\Services\CloudinaryService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SlideService
{
    public function __construct(
        protected CloudinaryService $cloudinary
    ) {}

    public function list(): Collection
    {
        return Slide::all();
    }

    public function create(Request $data): Slide
    {
        $payload = $data->only(['name']);

        if ($data->hasFile('image') && $data->file('image')->isValid()) {
            $payload['image'] = $this->cloudinary->upload($data->file('image'), 'slides');
        }

        return Slide::create($payload);
    }

    public function update(Request $data, int $id): Slide
    {
        $slide = Slide::findOrFail($id);
        $payload = $data->only(['name']);

        if ($data->hasFile('image') && $data->file('image')->isValid()) {
            // Supprimer l'ancienne image sur Cloudinary
            if ($slide->image) {
                $this->cloudinary->deleteFromUrl($slide->image);
            }

            // Upload de la nouvelle image
            $payload['image'] = $this->cloudinary->upload($data->file('image'), 'slides');
        }

        $slide->update($payload);
        return $slide;
    }

    public function delete(int $id): void
    {
        $slide = Slide::findOrFail($id);
        if ($slide->image) {
            $this->cloudinary->deleteFromUrl($slide->image);
        }
        $slide->delete();
    }
}
