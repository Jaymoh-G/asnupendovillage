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
}
