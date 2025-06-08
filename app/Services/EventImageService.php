<?php

namespace App\Services;

use App\Models\EventImage;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class EventImageService
{
    public function __construct(
        protected CloudinaryService $cloudinary
    ) {}

    public function list(int $eventId): Collection
    {
        return EventImage::where('event_id', $eventId)->orderBy('starts_at')->get();
    }

    public function create(Request $data): EventImage
    {
        $payload = $data->only(['event_id', 'description']);

        $name = 'event-' . $data->event_id . '-' . uniqid();
        $payload['name'] = $name;

        if ($data->hasFile('path') && $data->file('path')->isValid()) {
            $filePath = $data->file('path')->getRealPath();
            $uploadResult = $this->cloudinary->upload($filePath, [
                'folder' => 'images',
            ]);

            $payload['path'] = $uploadResult['secure_url'] ?? null;
        }

        return EventImage::create($payload);
    }

    public function update(Request $data, int $id): EventImage
    {
        $image = EventImage::findOrFail($id);
        $payload = $data->only(['description', 'event_id']);

        if ($data->hasFile('path') && $data->file('path')->isValid()) {
            if ($image->path) {
                $publicId = $this->cloudinary->extractPublicId($image->path);
                $this->cloudinary->delete($publicId);
            }

            $filePath = $data->file('path')->getRealPath();
            $uploadResult = $this->cloudinary->upload($filePath, [
                'folder' => 'images',
            ]);

            $payload['path'] = $uploadResult['secure_url'] ?? null;
        }

        $image->update($payload);
        return $image;
    }

    public function delete(int $id): void
    {
        $image = EventImage::findOrFail($id);
        if ($image->path) {
            $publicId = $this->cloudinary->extractPublicId($image->path);
            $this->cloudinary->delete($publicId);
        }
        $image->delete();
    }
}
