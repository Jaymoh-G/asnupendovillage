<?php

namespace App\Filament\Components;

use Filament\Forms\Components\Field;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ExistingImagePicker extends Field
{
    protected string $view = 'filament.components.existing-image-picker';

    protected string $directory = 'images';
    protected array $acceptedFileTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
    protected int $maxFiles = 10;
    protected bool $showPreview = true;
    protected string $placeholder = 'Select from existing images';

    public function directory(string $directory): static
    {
        $this->directory = $directory;
        return $this;
    }

    public function acceptedFileTypes(array $types): static
    {
        $this->acceptedFileTypes = $types;
        return $this;
    }

    public function maxFiles(int $maxFiles): static
    {
        $this->maxFiles = $maxFiles;
        return $this;
    }

    public function showPreview(bool $show = true): static
    {
        $this->showPreview = $show;
        return $this;
    }

    public function placeholder(string $placeholder): static
    {
        $this->placeholder = $placeholder;
        return $this;
    }

    public function getExistingImages(): array
    {
        $images = [];
        $disk = Storage::disk('public');

        // Get all files from the directory
        $files = $disk->allFiles($this->directory);

        foreach ($files as $file) {
            $extension = pathinfo($file, PATHINFO_EXTENSION);
            $mimeType = $this->getMimeType($extension);

            if (in_array($mimeType, $this->acceptedFileTypes)) {
                $images[] = [
                    'path' => $file,
                    'url' => asset('storage/' . $file),
                    'name' => basename($file),
                    'size' => $disk->size($file),
                    'last_modified' => $disk->lastModified($file),
                ];
            }
        }

        // Sort by last modified (newest first)
        usort($images, function ($a, $b) {
            return $b['last_modified'] <=> $a['last_modified'];
        });

        return $images;
    }

    protected function getMimeType(string $extension): string
    {
        $mimeTypes = [
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            'webp' => 'image/webp',
        ];

        return $mimeTypes[strtolower($extension)] ?? 'application/octet-stream';
    }

    public function getState(): mixed
    {
        $state = parent::getState();

        if (is_array($state)) {
            return array_filter($state);
        }

        return $state;
    }
}
