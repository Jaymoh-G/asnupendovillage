<?php

namespace App\Filament\Resources\NewsResource\Pages;

use App\Filament\Resources\NewsResource;
use App\Models\Image;
use App\Models\News;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class EditNews extends EditRecord
{
    protected static string $resource = NewsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Remove new_images from data as we'll handle them separately
        $newImages = $data['new_images'] ?? null;
        unset($data['new_images']);

        // Store for afterSave
        $this->data['new_images'] = $newImages;

        return $data;
    }

    protected function afterSave(): void
    {
        $record = $this->record;
        $newImages = $this->data['new_images'] ?? null;

        // Handle new uploaded images with captions
        if ($newImages && $record) {
            $this->processImagesWithCaptions($record, $newImages);
        }

        // Process images uploaded through RichEditor
        if ($record && $record->content) {
            $this->processRichEditorImages($record);
        }
    }

    protected function processImagesWithCaptions($record, array $newImages): void
    {
        foreach ($newImages as $imageData) {
            if (isset($imageData['file']) && $imageData['file']) {
                // Create the image record with caption and featured status
                $image = $record->images()->create([
                    'filename' => basename($imageData['file']),
                    'original_name' => basename($imageData['file']),
                    'path' => $imageData['file'],
                    'mime_type' => 'image/jpeg', // Default, will be updated
                    'size' => 0, // Will be updated
                    'alt_text' => pathinfo($imageData['file'], PATHINFO_FILENAME),
                    'caption' => $imageData['caption'] ?? null,
                    'featured' => $imageData['featured'] ?? false,
                    'sort_order' => $record->images()->count(),
                ]);

                // If this is marked as featured, unmark others
                if ($imageData['featured'] ?? false) {
                    $record->images()->where('id', '!=', $image->id)->update(['featured' => false]);
                }
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

    // Custom method to handle image deletion via AJAX
    public function deleteImage(Request $request, $newsId, $imageId): JsonResponse
    {
        try {
            // Verify the news record exists and belongs to the current user/context
            $news = News::findOrFail($newsId);

            // Find the image
            $image = Image::findOrFail($imageId);

            // Verify the image belongs to this news article
            if ($image->imageable_type !== News::class || $image->imageable_id !== $news->id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Image does not belong to this news article'
                ], 403);
            }

            // Delete the image using the HasImages trait
            $news->deleteImage($imageId);

            return response()->json([
                'success' => true,
                'message' => 'Image deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting image: ' . $e->getMessage()
            ], 500);
        }
    }
}
