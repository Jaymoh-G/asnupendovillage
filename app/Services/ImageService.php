<?php

namespace App\Services;

use App\Models\Image;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageService
{
    /**
     * Upload and process images
     */
    public function uploadImages($files, $model, $directory = 'uploads')
    {
        if (!is_array($files)) {
            $files = [$files];
        }

        $uploadedImages = [];

        foreach ($files as $file) {
            if ($file instanceof UploadedFile) {
                $uploadedImages[] = $this->processAndStoreImage($file, $model, $directory);
            }
        }

        return $uploadedImages;
    }

    /**
     * Process and store a single image
     */
    protected function processAndStoreImage(UploadedFile $file, $model, $directory = 'uploads')
    {
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs($directory, $filename, 'public');

        // Create thumbnail if it's an image
        if (str_starts_with($file->getMimeType(), 'image/')) {
            $this->createThumbnail($path, $directory);
        }

        return $model->images()->create([
            'filename' => $filename,
            'original_name' => $file->getClientOriginalName(),
            'path' => $path,
            'mime_type' => $file->getMimeType(),
            'size' => $file->getSize(),
            'alt_text' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
        ]);
    }

    /**
     * Create thumbnail for an image
     */
    protected function createThumbnail($imagePath, $directory)
    {
        try {
            $fullPath = Storage::disk('public')->path($imagePath);
            $pathInfo = pathinfo($imagePath);
            $thumbnailPath = $pathInfo['dirname'] . '/thumbnails/' . $pathInfo['basename'];
            $thumbnailFullPath = Storage::disk('public')->path($thumbnailPath);

            // Create thumbnails directory if it doesn't exist
            Storage::disk('public')->makeDirectory($pathInfo['dirname'] . '/thumbnails');

            // Create thumbnail using GD or Imagick
            $this->resizeImage($fullPath, $thumbnailFullPath, 300, 300);
        } catch (\Exception $e) {
            // Log error but don't fail the upload
            \Illuminate\Support\Facades\Log::error('Thumbnail creation failed: ' . $e->getMessage());
        }
    }

    /**
     * Resize image using available extensions
     */
    protected function resizeImage($sourcePath, $destinationPath, $width, $height)
    {
        $imageInfo = getimagesize($sourcePath);
        if (!$imageInfo) {
            return false;
        }

        $sourceWidth = $imageInfo[0];
        $sourceHeight = $imageInfo[1];
        $mimeType = $imageInfo['mime'];

        // Calculate new dimensions maintaining aspect ratio
        $ratio = min($width / $sourceWidth, $height / $sourceHeight);
        $newWidth = round($sourceWidth * $ratio);
        $newHeight = round($sourceHeight * $ratio);

        // Create new image
        $newImage = imagecreatetruecolor($newWidth, $newHeight);

        // Load source image
        $sourceImage = $this->loadImage($sourcePath, $mimeType);
        if (!$sourceImage) {
            return false;
        }

        // Resize
        imagecopyresampled($newImage, $sourceImage, 0, 0, 0, 0, $newWidth, $newHeight, $sourceWidth, $sourceHeight);

        // Save
        $this->saveImage($newImage, $destinationPath, $mimeType);

        // Clean up
        imagedestroy($sourceImage);
        imagedestroy($newImage);

        return true;
    }

    /**
     * Load image based on mime type
     */
    protected function loadImage($path, $mimeType)
    {
        switch ($mimeType) {
            case 'image/jpeg':
                return imagecreatefromjpeg($path);
            case 'image/png':
                return imagecreatefrompng($path);
            case 'image/gif':
                return imagecreatefromgif($path);
            case 'image/webp':
                return imagecreatefromwebp($path);
            default:
                return false;
        }
    }

    /**
     * Save image based on mime type
     */
    protected function saveImage($image, $path, $mimeType)
    {
        switch ($mimeType) {
            case 'image/jpeg':
                return imagejpeg($image, $path, 80);
            case 'image/png':
                return imagepng($image, $path, 8);
            case 'image/gif':
                return imagegif($image, $path);
            case 'image/webp':
                return imagewebp($image, $path, 80);
            default:
                return false;
        }
    }

    /**
     * Delete image and its files
     */
    public function deleteImage($imageId)
    {
        $image = Image::find($imageId);

        if ($image) {
            // Delete main image file
            Storage::disk('public')->delete($image->path);

            // Delete thumbnail if it exists
            if ($image->is_image) {
                $pathInfo = pathinfo($image->path);
                $thumbnailPath = $pathInfo['dirname'] . '/thumbnails/' . $pathInfo['basename'];
                Storage::disk('public')->delete($thumbnailPath);
            }

            // Delete database record
            $image->delete();

            return true;
        }

        return false;
    }

    /**
     * Set featured image
     */
    public function setFeaturedImage($model, $imageId)
    {
        // Remove current featured image
        $model->images()->where('featured', true)->update(['featured' => false]);

        // Set new featured image
        $model->images()->where('id', $imageId)->update(['featured' => true]);
    }

    /**
     * Update image metadata
     */
    public function updateImageMetadata($imageId, $data)
    {
        $image = Image::find($imageId);

        if ($image) {
            $image->update($data);
            return $image;
        }

        return null;
    }

    /**
     * Reorder images
     */
    public function reorderImages($model, $imageIds)
    {
        foreach ($imageIds as $index => $imageId) {
            $model->images()->where('id', $imageId)->update(['sort_order' => $index]);
        }
    }
}
