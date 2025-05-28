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
            $filePath = $data->file('image')->getRealPath();
            $uploadResult = $this->cloudinary->upload($filePath, [
                'folder' => 'images',
            ]);

            $payload['image'] = $uploadResult['secure_url'] ?? null;
        }

        return Slide::create($payload);
    }

    public function update(Request $data, int $id): Slide
    {
        $slide = Slide::findOrFail($id);
        $payload = $data->only(['name']);

        if ($data->hasFile('image') && $data->file('image')->isValid()) {
            if ($slide->image) {
                $publicId = $this->cloudinary->extractPublicId($slide->image);
                $this->cloudinary->delete($publicId);
            }

            $filePath = $data->file('image')->getRealPath();
            $uploadResult = $this->cloudinary->upload($filePath, [
                'folder' => 'images',
            ]);

            $payload['image'] = $uploadResult['secure_url'] ?? null;
        }

        $slide->update($payload);
        return $slide;
    }

    public function delete(int $id): void
    {
        $slide = Slide::findOrFail($id);
        if ($slide->image) {
            $publicId = $this->cloudinary->extractPublicId($slide->image);
            $this->cloudinary->delete($publicId);
        }
        $slide->delete();
    }
}
