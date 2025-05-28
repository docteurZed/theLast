<?php

namespace App\Services;

use App\Models\SpecialGuest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class SpecialGuestService
{
    public function __construct(
        protected CloudinaryService $cloudinary
    ) {}

    public function list(): Collection
    {
        return SpecialGuest::all();
    }

    public function create(Request $data): SpecialGuest
    {
        $payload = $data->only(['title', 'name', 'domain', 'description', 'role']);

        if ($data->hasFile('image') && $data->file('image')->isValid()) {
            $filePath = $data->file('image')->getRealPath();
            $uploadResult = $this->cloudinary->upload($filePath, [
                'folder' => 'images',
            ]);

            $payload['image'] = $uploadResult['secure_url'] ?? null;
        }

        return SpecialGuest::create($payload);
    }

    public function update(Request $data, $id): SpecialGuest
    {
        $guest = SpecialGuest::findOrFail($id);
        $payload = $data->only(['title', 'name', 'domain', 'description', 'role']);

        if ($data->hasFile('image') && $data->file('image')->isValid()) {
            // if ($guest->image) {
            //     $publicId = $this->cloudinary->extractPublicId($guest->image);
            //     $this->cloudinary->delete($publicId);
            // }

            $filePath = $data->file('image')->getRealPath();
            $uploadResult = $this->cloudinary->upload($filePath, [
                'folder' => 'images',
            ]);

            $payload['image'] = $uploadResult['secure_url'] ?? null;
        }

        $guest->update($payload);
        return $guest;
    }

    public function delete($id): void
    {
        $guest = SpecialGuest::findOrFail($id);
        // if ($guest->image) {
        //     $publicId = $this->cloudinary->extractPublicId($guest->image);
        //     $this->cloudinary->delete($publicId);
        // }
        $guest->delete();
    }
}
