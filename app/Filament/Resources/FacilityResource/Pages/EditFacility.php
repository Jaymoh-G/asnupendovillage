<?php

namespace App\Filament\Resources\FacilityResource\Pages;

use App\Filament\Resources\FacilityResource;
use App\Models\Facility;
use App\Models\Image;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class EditFacility extends EditRecord
{
    protected static string $resource = FacilityResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
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
        $facility = $this->record;
        $newImages = $this->data['new_images'] ?? null;

        // Handle new uploaded images with captions
        if ($newImages && $facility) {
            foreach ($newImages as $imageData) {
                if (isset($imageData['file']) && $imageData['file']) {
                    // Create the image record with caption and featured status
                    $image = $facility->images()->create([
                        'filename' => basename($imageData['file']),
                        'original_name' => basename($imageData['file']),
                        'path' => $imageData['file'],
                        'mime_type' => 'image/jpeg', // Default, will be updated
                        'size' => 0, // Will be updated
                        'alt_text' => pathinfo($imageData['file'], PATHINFO_FILENAME),
                        'caption' => $imageData['caption'] ?? null,
                        'featured' => $imageData['featured'] ?? false,
                        'sort_order' => $facility->images()->count(),
                    ]);

                    // If this is marked as featured, unmark others
                    if ($imageData['featured'] ?? false) {
                        $facility->images()->where('id', '!=', $image->id)->update(['featured' => false]);
                    }
                }
            }
        }

        // Set the first image as featured if no featured image exists
        if ($facility->images()->count() > 0 && !$facility->featuredImage()->exists()) {
            $firstImage = $facility->images()->first();
            $facility->setFeaturedImage($firstImage->id);
        }
    }

    // Custom method to handle image deletion via AJAX
    public function deleteImage(Request $request, $facilityId, $imageId): JsonResponse
    {
        try {
            // Verify the facility record exists and belongs to the current user/context
            $facility = Facility::findOrFail($facilityId);

            // Find the image
            $image = Image::findOrFail($imageId);

            // Verify the image belongs to this facility
            if ($image->imageable_type !== Facility::class || $image->imageable_id !== $facility->id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Image does not belong to this facility'
                ], 403);
            }

            // Delete the image using the HasImages trait
            $facility->deleteImage($imageId);

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
