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
        // Remove images from data as we'll handle them separately
        $images = $data['images'] ?? null;
        unset($data['images']);

        // Store for afterCreate
        $this->data['images'] = $images;

        return $data;
    }

    protected function afterCreate(): void
    {
        $record = $this->record;
        $images = $this->data['images'] ?? null;

        // Handle new uploaded images
        if ($images && $record) {
            foreach ($images as $imagePath) {
                // Create image record for the uploaded file
                $record->images()->create([
                    'filename' => basename($imagePath),
                    'original_name' => basename($imagePath),
                    'path' => $imagePath,
                    'mime_type' => mime_content_type(Storage::disk('public')->path($imagePath)),
                    'size' => Storage::disk('public')->size($imagePath),
                    'alt_text' => pathinfo(basename($imagePath), PATHINFO_FILENAME),
                ]);
            }
        }
    }
}
