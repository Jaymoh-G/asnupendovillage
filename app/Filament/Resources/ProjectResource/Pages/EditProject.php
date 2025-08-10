<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ProjectResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Http\UploadedFile;
use App\Models\Image;

class EditProject extends EditRecord
{
    protected static string $resource = ProjectResource::class;

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

    protected function afterSave(): void
    {
        $project = $this->record;
        $imagePaths = $this->data['images'] ?? [];

        if (!empty($imagePaths)) {
            // Clear existing images and create new ones
            $project->images()->delete();

            // Reset array keys to ensure they are sequential integers starting from 0
            $imagePaths = array_values($imagePaths);

            foreach ($imagePaths as $index => $imagePath) {
                // Ensure imagePath is a string and index is an integer
                if (!is_string($imagePath)) {
                    continue; // Skip invalid image paths
                }

                // Ensure index is an integer and sort_order is properly set
                $sortOrder = (int) $index;

                // Create image record directly
                $image = $project->images()->create([
                    'filename' => basename($imagePath),
                    'original_name' => basename($imagePath),
                    'path' => $imagePath,
                    'mime_type' => 'image/jpeg', // Default mime type
                    'size' => 0, // Default size
                    'alt_text' => pathinfo(basename($imagePath), PATHINFO_FILENAME),
                    'featured' => $index === 0, // First image is featured
                    'sort_order' => $sortOrder,
                ]);
            }
        }
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Get existing image paths for the form, safely handling empty relationships
        if ($this->record && $this->record->images) {
            $data['images'] = $this->record->images->pluck('path')->toArray();
        } else {
            $data['images'] = [];
        }
        return $data;
    }
}
