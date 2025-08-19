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
