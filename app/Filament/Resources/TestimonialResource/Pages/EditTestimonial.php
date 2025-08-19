<?php

namespace App\Filament\Resources\TestimonialResource\Pages;

use App\Filament\Resources\TestimonialResource;
use App\Models\Testimonial;
use App\Models\Image;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class EditTestimonial extends EditRecord
{
    protected static string $resource = TestimonialResource::class;

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
        $testimonial = $this->record;
        $newImages = $this->data['new_images'] ?? null;

        // Handle new uploaded images with captions
        if ($newImages && $testimonial) {
            foreach ($newImages as $imageData) {
                if (isset($imageData['file']) && $imageData['file']) {
                    // Create the image record with caption and featured status
                    $image = $testimonial->images()->create([
                        'filename' => basename($imageData['file']),
                        'original_name' => basename($imageData['file']),
                        'path' => $imageData['file'],
                        'mime_type' => 'image/jpeg', // Default, will be updated
                        'size' => 0, // Will be updated
                        'alt_text' => pathinfo($imageData['file'], PATHINFO_FILENAME),
                        'caption' => $imageData['caption'] ?? null,
                        'featured' => $imageData['featured'] ?? false,
                        'sort_order' => $testimonial->images()->count(),
                    ]);

                    // If this is marked as featured, unmark others
                    if ($imageData['featured'] ?? false) {
                        $testimonial->images()->where('id', '!=', $image->id)->update(['featured' => false]);
                    }
                }
            }
        }

        // Set the first image as featured if no featured image exists
        if ($testimonial->images()->count() > 0 && !$testimonial->featuredImage()->exists()) {
            $firstImage = $testimonial->images()->first();
            $testimonial->setFeaturedImage($firstImage->id);
        }
    }

    // Custom method to handle image deletion via AJAX
    public function deleteImage(Request $request, $testimonialId, $imageId): JsonResponse
    {
        try {
            // Verify the testimonial record exists and belongs to the current user/context
            $testimonial = Testimonial::findOrFail($testimonialId);

            // Find the image
            $image = Image::findOrFail($imageId);

            // Verify the image belongs to this testimonial
            if ($image->imageable_type !== Testimonial::class || $image->imageable_id !== $testimonial->id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Image does not belong to this testimonial'
                ], 403);
            }

            // Delete the image using the HasImages trait
            $testimonial->deleteImage($imageId);

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

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
