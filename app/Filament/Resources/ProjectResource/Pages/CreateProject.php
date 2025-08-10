<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ProjectResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Http\UploadedFile;
use App\Models\Image;

class CreateProject extends CreateRecord
{
    protected static string $resource = ProjectResource::class;

    protected function afterCreate(): void
    {
        $project = $this->record;
        $imagePaths = $this->data['images'] ?? [];

        if (!empty($imagePaths)) {
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

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
