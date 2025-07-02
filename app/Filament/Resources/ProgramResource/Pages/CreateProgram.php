<?php

namespace App\Filament\Resources\ProgramResource\Pages;

use App\Filament\Resources\ProgramResource;
use App\Models\Image;
use App\Models\Program;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProgram extends CreateRecord
{
    protected static string $resource = ProgramResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Store images for afterCreate
        $this->data['images'] = $data['images'] ?? [];

        // Remove the images field from data as we'll handle it separately
        unset($data['images']);

        return $data;
    }

    protected function afterCreate(): void
    {
        $program = $this->record;
        $images = $this->data['images'] ?? [];

        if (!empty($images)) {
            foreach ($images as $imagePath) {
                // Create image record and associate with program
                Image::create([
                    'filename' => basename($imagePath),
                    'original_name' => basename($imagePath),
                    'path' => $imagePath,
                    'mime_type' => 'image/jpeg', // Default, could be improved
                    'size' => 0, // Could be improved
                    'imageable_type' => Program::class,
                    'imageable_id' => $program->id,
                ]);
            }
        }
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
