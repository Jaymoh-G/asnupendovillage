<?php

namespace App\Filament\Resources\FacilityResource\Pages;

use App\Filament\Resources\FacilityResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Http\UploadedFile;

class CreateFacility extends CreateRecord
{
    protected static string $resource = FacilityResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function afterCreate(): void
    {
        $facility = $this->record;

        // Handle image uploads using the HasImages trait
        if ($tempImages = $this->data['temp_images'] ?? []) {
            $this->processImages($facility, $tempImages);
        }
    }

    protected function processImages($facility, array $tempImages): void
    {
        foreach ($tempImages as $tempImage) {
            if ($tempImage instanceof UploadedFile) {
                // Upload the image using the HasImages trait
                $facility->uploadImages([$tempImage], 'facilities');
            }
        }

        // Set the first image as featured if no featured image exists
        if ($facility->images()->count() > 0 && !$facility->featuredImage()->exists()) {
            $firstImage = $facility->images()->first();
            $facility->setFeaturedImage($firstImage->id);
        }
    }
}
