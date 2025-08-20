<?php

namespace App\Filament\Resources\NewsResource\Pages;

use App\Filament\Resources\NewsResource;
use App\Models\Image;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Storage;

class CreateNews extends CreateRecord
{
    protected static string $resource = NewsResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Remove temp_images from data as we'll handle them separately
        $tempImages = $data['temp_images'] ?? null;
        unset($data['temp_images']);

        // Store for afterCreate
        $this->data['temp_images'] = $tempImages;

        return $data;
    }

    protected function afterCreate(): void
    {
        $record = $this->record;
        $tempImages = $this->data['temp_images'] ?? null;

        // Handle new uploaded images using the HasImages trait
        if ($tempImages && $record) {
            $this->processImages($record, $tempImages);
        }

        // Process images uploaded through RichEditor
        if ($record && $record->content) {
            $this->processRichEditorImages($record);
        }
    }

    protected function processImages($record, array $tempImages): void
    {
        foreach ($tempImages as $tempImage) {
            if ($tempImage instanceof \Illuminate\Http\UploadedFile) {
                // Upload the image using the HasImages trait
                $record->uploadImages([$tempImage], 'news');
            }
        }

        // Set the first image as featured if no featured image exists
        if ($record->images()->count() > 0 && !$record->featuredImage()->exists()) {
            $firstImage = $record->images()->first();
            $record->setFeaturedImage($firstImage->id);
        }
    }

    /**
     * Process images uploaded through RichEditor and create image records
     */
    protected function processRichEditorImages($record): void
    {
        // Extract image paths from content
        $content = $record->content;

        // Look for image tags with src attributes
        preg_match_all('/<img[^>]+src=["\']([^"\']+)["\'][^>]*>/i', $content, $matches);

        if (empty($matches[1])) {
            return;
        }

        $imagePaths = $matches[1];

        foreach ($imagePaths as $imagePath) {
            // Convert URL to storage path
            $storagePath = $this->convertUrlToStoragePath($imagePath);

            if ($storagePath && !$this->imageRecordExists($record, $storagePath)) {
                // Create image record for this image
                $record->images()->create([
                    'filename' => basename($storagePath),
                    'original_name' => basename($storagePath),
                    'path' => $storagePath,
                    'mime_type' => 'image/jpeg', // Default
                    'size' => 0,
                    'alt_text' => pathinfo($storagePath, PATHINFO_FILENAME),
                    'caption' => null,
                    'featured' => false,
                    'sort_order' => $record->images()->count(),
                ]);
            }
        }
    }

    /**
     * Convert image URL to storage path
     */
    protected function convertUrlToStoragePath($url): ?string
    {
        // Handle different URL formats
        $path = $url;

        // Remove protocol and domain
        $path = preg_replace('/^https?:\/\/[^\/]+\//', '', $path);

        // Remove /public/storage/ prefix if present
        $path = preg_replace('/^public\/storage\//', '', $path);

        // Remove /storage/ prefix if present
        $path = preg_replace('/^storage\//', '', $path);

        // Ensure the path exists in storage
        if (Storage::disk('public')->exists($path)) {
            return $path;
        }

        // Try alternative path formats
        $alternativePaths = [
            $path,
            'news/content/' . basename($path),
            'news/content/' . $path,
        ];

        foreach ($alternativePaths as $altPath) {
            if (Storage::disk('public')->exists($altPath)) {
                return $altPath;
            }
        }

        return null;
    }

    /**
     * Check if image record already exists for this path
     */
    protected function imageRecordExists($record, $path): bool
    {
        return $record->images()->where('path', $path)->exists();
    }
}
