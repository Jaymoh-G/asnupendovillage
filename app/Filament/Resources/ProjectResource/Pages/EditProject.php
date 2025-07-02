<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ProjectResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProject extends EditRecord
{
    protected static string $resource = ProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        $project = $this->record;
        $images = $this->data['images'] ?? [];
        if (!empty($images)) {
            foreach ($images as $imagePath) {
                if (!$project->images()->where('path', $imagePath)->exists()) {
                    $project->images()->create([
                        'filename' => basename($imagePath),
                        'original_name' => basename($imagePath),
                        'path' => $imagePath,
                        'mime_type' => 'image/jpeg',
                        'size' => 0,
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
