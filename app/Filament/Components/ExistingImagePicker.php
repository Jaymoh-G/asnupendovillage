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
    protected int $maxFiles = 5;
    protected bool $showPreview = true;
    protected string $placeholder = 'Upload images';

    public function directory(string $directory): self
    {
        $this->directory = $directory;
        return $this;
    }

    public function acceptedFileTypes(array $types): self
    {
        $this->acceptedFileTypes = $types;
        return $this;
    }

    public function maxFiles(int $maxFiles): self
    {
        $this->maxFiles = $maxFiles;
        return $this;
    }

    public function showPreview(bool $show = true): self
    {
        $this->showPreview = $show;
        return $this;
    }

    public function placeholder(string $placeholder): self
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
            try {
                // Check if file exists and is accessible
                if (!$disk->exists($file)) {
                    continue;
                }

                $extension = pathinfo($file, PATHINFO_EXTENSION);
                $mimeType = $this->getMimeType($extension);

                if (in_array($mimeType, $this->acceptedFileTypes)) {
                    // Get file size with error handling
                    $fileSize = 0;
                    try {
                        $fileSize = $disk->size($file);
                    } catch (\Exception $e) {
                        // If we can't get file size, use 0
                        $fileSize = 0;
                    }

                    // Get last modified with error handling
                    $lastModified = time();
                    try {
                        $lastModified = $disk->lastModified($file);
                    } catch (\Exception $e) {
                        // If we can't get last modified, use current time
                        $lastModified = time();
                    }

                    $images[] = [
                        'path' => $file,
                        'url' => asset('storage/' . $file),
                        'name' => basename($file),
                        'size' => $fileSize,
                        'last_modified' => $lastModified,
                    ];
                }
            } catch (\Exception $e) {
                // Skip files that cause errors
                continue;
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

    public function getMaxFiles(): int
    {
        return $this->maxFiles;
    }

    public function getAcceptedFileTypes(): array
    {
        return $this->acceptedFileTypes;
    }

    public function getDirectory(): string
    {
        return $this->directory;
    }
}
