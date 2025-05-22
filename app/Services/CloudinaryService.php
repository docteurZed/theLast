<?php

namespace App\Services;

use Cloudinary\Api\Upload\UploadApi;
use Cloudinary\Api\Admin\AdminApi;
use Illuminate\Http\UploadedFile;
use Exception;

class CloudinaryService
{
    protected UploadApi $uploadApi;

    public function __construct()
    {
        $this->uploadApi = new UploadApi();
    }

    /**
     * Upload a file to Cloudinary and return the secure URL
     *
     * @param UploadedFile $file
     * @param string $folder
     * @return string
     * @throws Exception
     */
    public function upload(UploadedFile $file, string $folder = 'uploads'): string
    {
        try {
            $result = $this->uploadApi->upload($file->getRealPath(), [
                'folder' => $folder,
                'use_filename' => true,
                'resource_type' => 'image',
            ]);

            return $result['secure_url'] ?? '';
        } catch (\Exception $e) {
            throw new Exception("Échec de l'upload de l'image : " . $e->getMessage());
        }
    }

    /**
     * Delete a file from Cloudinary using its public ID
     *
     * @param string $publicId
     * @return bool
     */
    public function delete(string $publicId): bool
    {
        try {
            $result = $this->uploadApi->destroy($publicId);
            return ($result['result'] ?? '') === 'ok';
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Extract the public_id from a Cloudinary URL
     *
     * @param string $url
     * @return string
     */
    public function extractPublicId(string $url): string
    {
        $part = explode('/upload/', $url)[1] ?? '';

        // Remove version prefix like v1234567890/
        $part = preg_replace('/^v\d+\//', '', $part);

        // Remove file extension
        return pathinfo($part, PATHINFO_FILENAME);
    }

    /**
     * Delete file from Cloudinary by full URL (helper)
     *
     * @param string $url
     * @return bool
     */
    public function deleteFromUrl(string $url): bool
    {
        $publicId = $this->extractPublicId($url);
        return $this->delete($publicId);
    }
}
