<?php

namespace App\Filament\Resources\AlbumResource\Pages;

use App\Filament\Resources\AlbumResource;
use App\Models\Image;
use App\Models\Album;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Get;
use Filament\Forms\Set;

class EditAlbum extends EditRecord
{
    protected static string $resource = AlbumResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Store cover_image and images for afterSave
        $this->data['cover_image'] = $data['cover_image'] ?? null;
        $this->data['images'] = $data['images'] ?? [];

        // Remove the images and cover_image fields from data as we'll handle them separately
        unset($data['images'], $data['cover_image']);

        return $data;
    }

    protected function afterSave(): void
    {
        $album = $this->record;
        $coverImage = $this->data['cover_image'] ?? null;
        $images = $this->data['images'] ?? [];

        // Handle cover image
        if ($coverImage) {
            $album->update(['cover_image' => $coverImage]);
        }

        // Handle album images
        if (!empty($images)) {
            foreach ($images as $imagePath) {
                // Create image record and associate with album
                Image::create([
                    'filename' => basename($imagePath),
                    'original_name' => basename($imagePath),
                    'path' => $imagePath,
                    'mime_type' => 'image/jpeg', // Default, could be improved
                    'size' => 0, // Could be improved
                    'imageable_type' => Album::class,
                    'imageable_id' => $album->id,
                ]);
            }
        }
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getFormSchema(): array
    {
        $album = $this->record;
        $existingImages = $album->images()->orderBy('created_at', 'desc')->get();

        return [
            // Original album form fields
            Section::make('Album Information')
                ->schema([
                    \Filament\Forms\Components\TextInput::make('name')
                        ->label('Album Name')
                        ->required()
                        ->maxLength(255),

                    \Filament\Forms\Components\TextInput::make('slug')
                        ->label('Slug')
                        ->required()
                        ->maxLength(255)
                        ->unique(ignoreRecord: true),

                    \Filament\Forms\Components\Textarea::make('description')
                        ->label('Description')
                        ->rows(3)
                        ->maxLength(1000),

                    \Filament\Forms\Components\Select::make('status')
                        ->label('Status')
                        ->options([
                            'active' => 'Active',
                            'inactive' => 'Inactive',
                        ])
                        ->default('active')
                        ->required(),

                    \Filament\Forms\Components\TextInput::make('sort_order')
                        ->label('Sort Order')
                        ->numeric()
                        ->default(0)
                        ->minValue(0),
                ])->columns(2),

            Section::make('Cover Image')
                ->schema([
                    \Filament\Forms\Components\FileUpload::make('cover_image')
                        ->label('Cover Image')
                        ->image()
                        ->imageEditor()
                        ->imageCropAspectRatio('16:9')
                        ->imageResizeTargetWidth('800')
                        ->imageResizeTargetHeight('450')
                        ->directory('albums')
                        ->visibility('public')
                        ->maxSize(5120),
                ]),

            // Existing Images Section
            Section::make('Existing Images')
                ->schema([
                    Placeholder::make('existing_images_info')
                        ->content(function () use ($existingImages) {
                            if ($existingImages->isEmpty()) {
                                return '<div class="text-center py-4 text-gray-500">No images in this album yet.</div>';
                            }

                            $html = '<div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3">';
                            foreach ($existingImages as $image) {
                                $html .= '<div class="group relative bg-gray-100 rounded-lg overflow-hidden shadow-sm">';
                                $html .= '<div class="aspect-square">';
                                $html .= '<img src="' . asset('storage/' . $image->path) . '" ';
                                $html .= 'alt="' . htmlspecialchars($image->original_name) . '" ';
                                $html .= 'class="w-full h-full object-cover" ';
                                $html .= 'onerror="this.style.display=\'none\'; this.nextElementSibling.style.display=\'flex\';">';
                                $html .= '<div class="w-full h-full bg-gray-200 flex items-center justify-center" style="display: none;">';
                                $html .= '<svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">';
                                $html .= '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>';
                                $html .= '</svg></div></div>';

                                // Remove button overlay
                                $html .= '<div class="absolute top-1 right-1 opacity-0 group-hover:opacity-100 transition-opacity duration-200">';
                                $html .= '<button type="button" onclick="removeImage(' . $image->id . ')" ';
                                $html .= 'class="bg-red-500 hover:bg-red-600 text-white rounded-full p-1 shadow-sm transition-colors duration-200">';
                                $html .= '<svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">';
                                $html .= '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>';
                                $html .= '</svg></button></div>';

                                // Image info overlay
                                $html .= '<div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 transition-all duration-200 flex items-end">';
                                $html .= '<div class="w-full p-2 transform translate-y-full group-hover:translate-y-0 transition-transform duration-200">';
                                $html .= '<div class="text-white text-xs">';
                                $html .= '<p class="font-medium truncate">' . htmlspecialchars($image->original_name) . '</p>';
                                $html .= '<p class="opacity-75">' . $image->created_at->format('M j, Y') . '</p>';
                                $html .= '</div></div></div>';

                                $html .= '</div>';
                            }
                            $html .= '</div>';

                            return $html;
                        }),
                ]),

            // Add New Images Section
            Section::make('Add New Images')
                ->schema([
                    FileUpload::make('images')
                        ->label('Upload New Images')
                        ->multiple()
                        ->image()
                        ->imageEditor()
                        ->imageCropAspectRatio('16:9')
                        ->imageResizeTargetWidth('1200')
                        ->imageResizeTargetHeight('800')
                        ->directory('albums/images')
                        ->visibility('public')
                        ->maxSize(5120)
                        ->helperText('Upload multiple images to add to this album. You can select multiple files at once.')
                        ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/gif']),
                ]),
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [];
    }

    public function getTitle(): string
    {
        return "Edit Album: {$this->record->name}";
    }

    protected function getHeaderWidgets(): array
    {
        return [];
    }

    protected function getFooterActions(): array
    {
        return [];
    }

    protected function getViewData(): array
    {
        return [
            'scripts' => [
                asset('js/album-image-management.js')
            ]
        ];
    }
}
