<?php

namespace App\Services;

use App\Models\Sponsor;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class SponsorService
{
    public function __construct(
        protected CloudinaryService $cloudinary
    ) {}

    public function list(): Collection
    {
        return Sponsor::all();
    }

    public function create(Request $data): Sponsor
    {
        $payload = $data->only(['name', 'description']);

        if ($data->hasFile('image') && $data->file('image')->isValid()) {
            $filePath = $data->file('image')->getRealPath();
            $uploadResult = $this->cloudinary->upload($filePath, [
                'folder' => 'images',
            ]);

            $payload['image'] = $uploadResult['secure_url'] ?? null;
        }

        return Sponsor::create($payload);
    }

    public function update(Request $data, $id): Sponsor
    {
        $sponsor = Sponsor::findOrFail($id);
        $payload = $data->only(['name', 'description']);

        if ($data->hasFile('logo') && $data->file('logo')->isValid()) {
            // if ($sponsor->logo) {
            //     $publicId = $this->cloudinary->extractPublicId($sponsor->logo);
            //     $this->cloudinary->delete($publicId);
            // }

            $filePath = $data->file('logo')->getRealPath();
            $uploadResult = $this->cloudinary->upload($filePath, [
                'folder' => 'images',
            ]);

            $payload['logo'] = $uploadResult['secure_url'] ?? null;
        }

        $sponsor->update($payload);
        return $sponsor;
    }

    public function delete($id): void
    {
        $sponsor = Sponsor::findOrFail($id);
        // if ($sponsor->logo) {
        //     $publicId = $this->cloudinary->extractPublicId($sponsor->logo);
        //     $this->cloudinary->delete($publicId);
        // }
        $sponsor->delete();
    }
}
