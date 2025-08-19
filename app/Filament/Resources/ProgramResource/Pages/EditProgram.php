<?php

namespace App\Filament\Resources\ProgramResource\Pages;

use App\Filament\Resources\ProgramResource;
use App\Models\Image;
use App\Models\Program;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class EditProgram extends EditRecord
{
    protected static string $resource = ProgramResource::class;

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
        $program = $this->record;
        $newImages = $this->data['new_images'] ?? null;

        // Handle new uploaded images with captions
        if ($newImages && $program) {
            foreach ($newImages as $imageData) {
                if (isset($imageData['file']) && $imageData['file']) {
                    // Create the image record with caption and featured status
                    $image = $program->images()->create([
                        'filename' => basename($imageData['file']),
                        'original_name' => basename($imageData['file']),
                        'path' => $imageData['file'],
                        'mime_type' => 'image/jpeg', // Default, will be updated
                        'size' => 0, // Will be updated
                        'alt_text' => pathinfo($imageData['file'], PATHINFO_FILENAME),
                        'caption' => $imageData['caption'] ?? null,
                        'featured' => $imageData['featured'] ?? false,
                        'sort_order' => $program->images()->count(),
                    ]);

                    // If this is marked as featured, unmark others
                    if ($imageData['featured'] ?? false) {
                        $program->images()->where('id', '!=', $image->id)->update(['featured' => false]);
                    }
                }
            }
        }

        // Set the first image as featured if no featured image exists
        if ($program->images()->count() > 0 && !$program->featuredImage()->exists()) {
            $firstImage = $program->images()->first();
            $program->setFeaturedImage($firstImage->id);
        }
    }

    // Custom method to handle image deletion via AJAX
    public function deleteImage(Request $request, $programId, $imageId): JsonResponse
    {
        try {
            // Verify the program record exists and belongs to the current user/context
            $program = Program::findOrFail($programId);

            // Find the image
            $image = Image::findOrFail($imageId);

            // Verify the image belongs to this program
            if ($image->imageable_type !== Program::class || $image->imageable_id !== $program->id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Image does not belong to this program'
                ], 403);
            }

            // Delete the image using the HasImages trait
            $program->deleteImage($imageId);

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
