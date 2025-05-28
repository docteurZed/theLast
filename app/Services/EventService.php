<?php

namespace App\Services;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Collection;

class EventService
{
    public function __construct(
        protected CloudinaryService $cloudinary
    ) {}

    public function list(): Collection
    {
        return Event::all();
    }

    public function create(Request $data): Event
    {
        $payload = $data->only([
            'name', 'starts_at', 'location',
            'location_latitude', 'location_longitude',
            'dress_code',
            'primary_color_name', 'primary_color_hex',
            'secondary_color_name', 'secondary_color_hex'
        ]);

        if ($data->hasFile('primary_image') && $data->file('primary_image')->isValid()) {
            $filePath = $data->file('primary_image')->getRealPath();
            $uploadResult = $this->cloudinary->upload($filePath, [
                'folder' => 'images',
            ]);

            $payload['primary_image'] = $uploadResult['secure_url'] ?? null;
        }

        if ($data->hasFile('secondary_image') && $data->file('secondary_image')->isValid()) {
            $filePath = $data->file('secondary_image')->getRealPath();
            $uploadResult = $this->cloudinary->upload($filePath, [
                'folder' => 'images',
            ]);

            $payload['secondary_image'] = $uploadResult['secure_url'] ?? null;
        }

        return Event::create($payload);
    }

    public function update(Request $data, int $id): Event
    {
        $event = Event::findOrFail($id);

        $payload = $data->only([
            'name', 'starts_at', 'location',
            'location_latitude', 'location_longitude',
            'dress_code',
            'primary_color_name', 'primary_color_hex',
            'secondary_color_name', 'secondary_color_hex'
        ]);

        if ($data->hasFile('primary_image') && $data->file('primary_image')->isValid()) {
            // if ($event->primary_image) {
            //     $publicId = $this->cloudinary->extractPublicId($event->primary_image);
            //     $this->cloudinary->delete($publicId);
            // }
            $filePath = $data->file('primary_image')->getRealPath();
            $uploadResult = $this->cloudinary->upload($filePath, [
                'folder' => 'images',
            ]);

            $payload['primary_image'] = $uploadResult['secure_url'] ?? null;
        }

        if ($data->hasFile('secondary_image') && $data->file('secondary_image')->isValid()) {
            // if ($event->secondary_image) {
            //     $publicId = $this->cloudinary->extractPublicId($event->secondary_image);
            //     $this->cloudinary->delete($publicId);
            // }
            $filePath = $data->file('secondary_image')->getRealPath();
            $uploadResult = $this->cloudinary->upload($filePath, [
                'folder' => 'images',
            ]);

            $payload['secondary_image'] = $uploadResult['secure_url'] ?? null;
        }

        $event->update($payload);

        return $event;
    }

    public function delete(int $id): void
    {
        $event = Event::findOrFail($id);
        // if ($event->primary_image) {
        //     $publicId = $this->cloudinary->extractPublicId($event->primary_image);
        //     $this->cloudinary->delete($publicId);
        // }
        // if ($event->secondary_image) {
        //     $publicId = $this->cloudinary->extractPublicId($event->secondary_image);
        //     $this->cloudinary->delete($publicId);
        // }
        $event->delete();
    }
}
