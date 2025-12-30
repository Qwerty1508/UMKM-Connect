<?php

namespace App\Services;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class CloudinaryService
{
    /**
     * Upload file to Cloudinary
     */
    public function upload($file, string $folder = 'uploads'): string
    {
        $result = Cloudinary::upload($file->getRealPath(), [
            'folder' => 'umkm/' . $folder,
            'transformation' => [
                'quality' => 'auto',
                'fetch_format' => 'auto',
            ],
        ]);

        return $result->getSecurePath();
    }

    /**
     * Delete file from Cloudinary
     */
    public function delete(string $url): bool
    {
        try {
            // Extract public ID from URL
            $publicId = $this->extractPublicId($url);
            if ($publicId) {
                Cloudinary::destroy($publicId);
                return true;
            }
            return false;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Extract public ID from Cloudinary URL
     */
    protected function extractPublicId(string $url): ?string
    {
        // Parse the URL to get the path
        $parsed = parse_url($url);
        if (!isset($parsed['path'])) {
            return null;
        }

        // Remove version and file extension
        $path = $parsed['path'];
        $path = preg_replace('/^\/[^\/]+\/[^\/]+\/v\d+\//', '', $path);
        $path = preg_replace('/\.[^.]+$/', '', $path);

        return $path ?: null;
    }
}
