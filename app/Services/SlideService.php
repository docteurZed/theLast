<?php

namespace App\Services;

use App\Models\Slide;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Services\CloudinaryService;

class SlideService
{
    protected CloudinaryService $cloudinary;

    public function __construct(CloudinaryService $cloudinary)
    {
        $this->cloudinary = $cloudinary;
    }

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
            if ($slide->image) {
                $this->cloudinary->deleteFromUrl($slide->image);
            }

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
