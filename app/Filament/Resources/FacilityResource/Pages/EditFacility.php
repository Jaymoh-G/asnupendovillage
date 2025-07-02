<?php

namespace App\Filament\Resources\FacilityResource\Pages;

use App\Filament\Resources\FacilityResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFacility extends EditRecord
{
    protected static string $resource = FacilityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        $facility = $this->record;
        $images = $this->data['images'] ?? [];
        if (!empty($images)) {
            // Optionally, remove old images if you want to replace
            // $facility->images()->delete();
            foreach ($images as $imagePath) {
                if (!$facility->images()->where('path', $imagePath)->exists()) {
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

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['images'] = $this->record ? $this->record->images->pluck('path')->toArray() : [];
        return $data;
    }
}
