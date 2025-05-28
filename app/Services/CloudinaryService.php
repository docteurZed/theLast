<?php

namespace App\Services;

use Cloudinary\Api\Upload\UploadApi;
use Illuminate\Http\UploadedFile;

class CloudinaryService
{
    protected UploadApi $uploader;

    public function __construct()
    {
        $this->uploader = new UploadApi();
    }

    /**
     * Upload a file to Cloudinary using the UploadApi class
     */
    public function upload(UploadedFile|string $file, string $publicId = null, string $folder = 'uploads'): string
    {
        $options = [
            'use_filename' => true,
            'overwrite' => true,
            'folder' => $folder,
        ];

        if ($publicId) {
            $options['public_id'] = $publicId;
        }

        $filePath = $file instanceof UploadedFile ? $file->getRealPath() : $file;

        $response = $this->uploader->upload($filePath, $options);

        return $response['secure_url'];
    }

    /**
     * Delete a file from Cloudinary using its public ID
     */
    public function delete(string $publicId): bool
    {
        $result = $this->uploader->destroy($publicId);
        return $result['result'] === 'ok';
    }

    /**
     * Extract the public ID from a Cloudinary URL
     */
    public function extractPublicId(string $url): string
    {
        $part = explode('/upload/', $url)[1] ?? '';
        $part = preg_replace('/^v\d+\//', '', $part);
        return pathinfo($part, PATHINFO_FILENAME);
    }

    /**
     * Delete an asset from a Cloudinary URL
     */
    public function deleteFromUrl(string $url): bool
    {
        $publicId = $this->extractPublicId($url);
        return $this->delete($publicId);
    }
}
