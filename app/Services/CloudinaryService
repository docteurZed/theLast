<?php

namespace App\Services;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\UploadedFile;

class CloudinaryService
{
    /**
     * Upload a file to Cloudinary and return the secure URL
     */
    public function upload(UploadedFile $file, string $folder = 'uploads'): string
    {
        $uploadedFile = Cloudinary::upload($file->getRealPath(), [
            'folder' => $folder
        ]);

        return $uploadedFile->getSecurePath();
    }

    /**
     * Delete a file from Cloudinary using its full URL
     */
    public function deleteFromUrl(string $url): bool
    {
        $publicId = $this->extractPublicId($url);
        $result = Cloudinary::destroy($publicId);
        return $result['result'] === 'ok';
    }

    /**
     * Extract the public_id from a Cloudinary URL
     */
    public function extractPublicId(string $url): string
    {
        // Supprimer tout avant `/upload/`
        $part = explode('/upload/', $url)[1] ?? '';

        // Supprimer la version (ex: v1710000000/)
        $part = preg_replace('/^v\d+\//', '', $part);

        // Supprimer l'extension (.jpg, .png, etc.)
        return pathinfo($part, PATHINFO_FILENAME);
    }
}
