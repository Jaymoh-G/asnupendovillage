<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ProjectResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProject extends CreateRecord
{
    protected static string $resource = ProjectResource::class;

    protected function afterCreate(): void
    {
        $project = $this->record;
        $images = $this->data['images'] ?? [];
        if (!empty($images)) {
            foreach ($images as $imagePath) {
                $project->images()->create([
                    'filename' => basename($imagePath),
                    'original_name' => basename($imagePath),
                    'path' => $imagePath,
                    'mime_type' => 'image/jpeg', // You may improve this
                    'size' => 0, // You may improve this
                ]);
            }
        }
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
