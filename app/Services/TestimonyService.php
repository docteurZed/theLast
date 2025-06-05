<?php

namespace App\Services;

use App\Models\Testimony;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class TestimonyService
{
    public function __construct(
        protected CloudinaryService $cloudinary
    ) {}

    public function list(): Collection
    {
        return Testimony::all();
    }

    public function create(Request $data): Testimony
    {
        $payload = $data->only(['name', 'testimony']);

        if ($data->hasFile('image') && $data->file('image')->isValid()) {
            $filePath = $data->file('image')->getRealPath();
            $uploadResult = $this->cloudinary->upload($filePath, [
                'folder' => 'images',
            ]);

            $payload['image'] = $uploadResult['secure_url'] ?? null;
        }

        return Testimony::create($payload);
    }

    public function update(Request $data, $id): Testimony
    {
        $testimony = Testimony::findOrFail($id);
        $payload = $data->only(['name', 'testimony']);

        if ($data->hasFile('image') && $data->file('image')->isValid()) {
            if ($testimony->image) {
                $publicId = $this->cloudinary->extractPublicId($testimony->image);
                $this->cloudinary->delete($publicId);
            }

            $filePath = $data->file('image')->getRealPath();
            $uploadResult = $this->cloudinary->upload($filePath, [
                'folder' => 'images',
            ]);

            $payload['image'] = $uploadResult['secure_url'] ?? null;
        }

        $testimony->update($payload);
        return $testimony;
    }

    public function delete($id): void
    {
        $testimony = Testimony::findOrFail($id);
        if ($testimony->image) {
            $publicId = $this->cloudinary->extractPublicId($testimony->image);
            $this->cloudinary->delete($publicId);
        }
        $testimony->delete();
    }
}
