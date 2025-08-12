<?php

namespace App\Filament\Resources\NewsResource\Pages;

use App\Filament\Resources\NewsResource;
use App\Models\Image;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

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
        // Remove temp_images from data as we'll handle them separately
        $tempImages = $data['temp_images'] ?? null;
        unset($data['temp_images']);

        // Store for afterSave
        $this->data['temp_images'] = $tempImages;

        return $data;
    }

    protected function afterSave(): void
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
