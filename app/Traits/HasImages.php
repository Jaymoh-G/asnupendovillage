<?php

namespace App\Traits;

use App\Models\Image;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HasImages
{
    /**
     * Get all images for this model
     */
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable')->ordered();
    }

    /**
     * Get featured images for this model
     */
    public function featuredImages()
    {
        return $this->morphMany(Image::class, 'imageable')->featured()->ordered();
    }

    /**
     * Get the main featured image
     */
    public function featuredImage()
    {
        return $this->morphOne(Image::class, 'imageable')->where('featured', true);
    }

    /**
     * Upload and store images
     */
    public function uploadImages($files, $directory = 'uploads')
    {
        if (!is_array($files)) {
            $files = [$files];
        }

        $uploadedImages = [];

        foreach ($files as $file) {
            if ($file instanceof UploadedFile) {
                $uploadedImages[] = $this->storeImage($file, $directory);
            }
        }

        return $uploadedImages;
    }

    /**
     * Store a single image
     */
    protected function storeImage(UploadedFile $file, $directory = 'uploads')
    {
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs($directory, $filename, 'public');

        return $this->images()->create([
            'filename' => $filename,
            'original_name' => $file->getClientOriginalName(),
            'path' => $path,
            'mime_type' => $file->getMimeType(),
            'size' => $file->getSize(),
            'alt_text' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
            'caption' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
        ]);
    }

    /**
     * Set featured image
     */
    public function setFeaturedImage($imageId)
    {
        // Remove current featured image
        $this->images()->where('featured', true)->update(['featured' => false]);

        // Set new featured image
        $this->images()->where('id', $imageId)->update(['featured' => true]);
    }

    /**
     * Delete an image
     */
    public function deleteImage($imageId)
    {
        $image = $this->images()->find($imageId);

        if ($image) {
            // Delete file from storage
            Storage::disk('public')->delete($image->path);

            // Delete database record
            $image->delete();

            return true;
        }

        return false;
    }

    /**
     * Get image count
     */
    public function getImageCountAttribute()
    {
        return $this->images()->count();
    }

    /**
     * Get featured image URL
     */
    public function getFeaturedImageUrlAttribute()
    {
        // First try to get the featured image
        $featuredImage = $this->featuredImage;
        if ($featuredImage) {
            return $featuredImage->display_url;
        }

        // If no featured image, get the first image
        $firstImage = $this->images()->first();
        if ($firstImage) {
            return $firstImage->display_url;
        }

        // Return null if no images exist
        return null;
    }

    /**
     * Get featured image thumbnail URL
     */
    public function getFeaturedImageThumbnailUrlAttribute()
    {
        $featuredImage = $this->featuredImage;
        return $featuredImage ? $featuredImage->thumbnail_relative_path : null;
    }

    /**
     * Reorder images
     */
    public function reorderImages($imageIds)
    {
        foreach ($imageIds as $index => $imageId) {
            $this->images()->where('id', $imageId)->update(['sort_order' => $index]);
        }
    }

    /**
     * Update image metadata
     */
    public function updateImageMetadata($imageId, $data)
    {
        $image = $this->images()->find($imageId);

        if ($image) {
            $image->update($data);
            return $image;
        }

        return null;
    }
}
