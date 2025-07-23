<?php

namespace App\Filament\Resources\HomeSliderResource\Pages;

use App\Filament\Resources\HomeSliderResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateHomeSlider extends CreateRecord
{
    protected static string $resource = HomeSliderResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function afterCreate(): void
    {
        // Process existing images if any were selected
        $existingImages = $this->data['existing_images'] ?? null;
        if ($existingImages) {
            $this->record->processExistingImages($existingImages);
        }
    }
}
