<?php

namespace App\Filament\Resources\HomeSliderResource\Pages;

use App\Filament\Resources\HomeSliderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHomeSlider extends EditRecord
{
    protected static string $resource = HomeSliderResource::class;

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
        // Process existing images if any were selected
        $existingImages = $this->data['existing_images'] ?? null;
        if ($existingImages) {
            $this->record->processExistingImages($existingImages);
        }
    }
}
