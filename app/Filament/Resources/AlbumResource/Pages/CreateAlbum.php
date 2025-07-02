<?php

namespace App\Filament\Resources\AlbumResource\Pages;

use App\Filament\Resources\AlbumResource;
use App\Models\Gallery;
use App\Models\Image;
use App\Models\Album;
use Filament\Resources\Pages\CreateRecord;

class CreateAlbum extends CreateRecord
{
    protected static string $resource = AlbumResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Automatically assign to the main gallery
        $data['gallery_id'] = Gallery::getMainGallery()->id;

        // Store cover_image and images for afterCreate
        $this->data['cover_image'] = $data['cover_image'] ?? null;
        $this->data['images'] = $data['images'] ?? [];

        // Remove the images and cover_image fields from data as we'll handle them separately
        unset($data['images'], $data['cover_image']);

        return $data;
    }

    protected function afterCreate(): void
    {
        $album = $this->record;
        $coverImage = $this->data['cover_image'] ?? null;
        $images = $this->data['images'] ?? [];

        // Handle cover image
        if ($coverImage) {
            $album->update(['cover_image' => $coverImage]);
        }

        // Handle album images
        if (!empty($images)) {
            foreach ($images as $imagePath) {
                // Create image record and associate with album
                Image::create([
                    'filename' => basename($imagePath),
                    'original_name' => basename($imagePath),
                    'path' => $imagePath,
                    'mime_type' => 'image/jpeg', // Default, could be improved
                    'size' => 0, // Could be improved
                    'imageable_type' => Album::class,
                    'imageable_id' => $album->id,
                ]);
            }
        }
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
