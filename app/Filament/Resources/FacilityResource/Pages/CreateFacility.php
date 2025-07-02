<?php

namespace App\Filament\Resources\FacilityResource\Pages;

use App\Filament\Resources\FacilityResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFacility extends CreateRecord
{
    protected static string $resource = FacilityResource::class;

    protected function afterCreate(): void
    {
        $facility = $this->record;
        $images = $this->data['images'] ?? [];
        if (!empty($images)) {
            foreach ($images as $imagePath) {
                $facility->images()->create([
                    'filename' => basename($imagePath),
                    'original_name' => basename($imagePath),
                    'path' => $imagePath,
                    'mime_type' => 'image/jpeg', // You may improve this
                    'size' => 0, // You may improve this
                ]);
            }
        }
    }
}
