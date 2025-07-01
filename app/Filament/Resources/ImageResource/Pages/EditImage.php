<?php

namespace App\Filament\Resources\ImageResource\Pages;

use App\Filament\Resources\ImageResource;
use App\Models\Image;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditImage extends EditRecord
{
    protected static string $resource = ImageResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Handle file upload if present
        if (isset($data['file']) && $data['file']) {
            $path = $data['file']; // This is already the stored path from Filament
            $filename = basename($path);

            $data['filename'] = $filename;
            $data['original_name'] = $filename;
            $data['path'] = $path;
            $data['mime_type'] = \Illuminate\Support\Facades\File::mimeType(storage_path('app/public/' . $path));
            $data['size'] = \Illuminate\Support\Facades\File::size(storage_path('app/public/' . $path));
            $data['alt_text'] = $data['alt_text'] ?? pathinfo($filename, PATHINFO_FILENAME);
        }

        return $data;
    }

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
}
