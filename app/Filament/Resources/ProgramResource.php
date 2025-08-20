<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProgramResource\Pages;
use App\Filament\Resources\ProgramResource\RelationManagers;
use App\Models\Program;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProgramResource extends Resource
{
    protected static ?string $model = Program::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Main Content';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Title')
                    ->required()
                    ->maxLength(255)
                    ->live()
                    ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                        if ($operation === 'create') {
                            $set('slug', \Illuminate\Support\Str::slug($state));
                        }
                    }),
                Forms\Components\TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->maxLength(255)
                    ->unique(true),
                Forms\Components\RichEditor::make('content')
                    ->label('Content')
                    ->columnSpanFull()
                    ->fileAttachmentsDisk('public')
                    ->fileAttachmentsDirectory('programs/content')
                    ->fileAttachmentsVisibility('public')
                    ->getUploadedAttachmentUrlUsing(function (string $file): string {
                        return config('app.url') . '/public/storage/' . $file;
                    })
                    ->enableToolbarButtons([
                        'attachFiles',
                        'blockquote',
                        'bold',
                        'bulletList',
                        'codeBlock',
                        'h2',
                        'h3',
                        'italic',
                        'link',
                        'orderedList',
                        'redo',
                        'strike',
                        'undo',
                    ])
                    ->helperText('Images uploaded here will be automatically managed and displayed in the Current Images section below. The URLs will now include /public to work with your hosting configuration.'),
                Forms\Components\Textarea::make('excerpt')
                    ->label('Excerpt')
                    ->maxLength(500)
                    ->helperText('A brief summary of the program for display on the home page and other listing pages.')
                    ->columnSpanFull(),
                Forms\Components\View::make('filament.resources.program-resource.components.existing-images')
                    ->label('Existing Images')
                    ->visible(fn($livewire) => $livewire->record && $livewire->record->exists),
                Forms\Components\Section::make('Program Images')
                    ->schema([
                        // Display existing images with delete functionality
                        Forms\Components\Placeholder::make('existing_images')
                            ->label('Current Images')
                            ->content(function ($record) {
                                if (!$record || !$record->exists) {
                                    return 'Images will appear here after you save the program. You can upload images using the section below or through the rich content editor above.';
                                }

                                $images = $record->images()->ordered()->get();
                                if ($images->isEmpty()) {
                                    return 'No images uploaded yet.';
                                }

                                $html = '<div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 15px;">';
                                foreach ($images as $image) {
                                    $isFeatured = $image->featured ? ' (Featured)' : '';
                                    $featuredClass = $image->featured ? 'featured-image' : '';

                                    $html .= '<div class="' . $featuredClass . '" style="border: 1px solid #e5e7eb; border-radius: 8px; padding: 10px; text-align: center; position: relative;">';

                                    // Edit button (pencil icon) - opens modal to edit caption
                                    $html .= '<button type="button" onclick="editImageCaption(' . $image->id . ', \'' . addslashes($image->caption ?? '') . '\', \'' . $image->original_name . '\')" style="position: absolute; top: 5px; left: 5px; background: #3b82f6; color: white; border: none; border-radius: 50%; width: 24px; height: 24px; cursor: pointer; font-size: 12px; line-height: 1; display: flex; align-items: center; justify-content: center; z-index: 10;">✎</button>';

                                    // Delete button (X icon) - using AJAX to avoid route issues
                                    $html .= '<button type="button" onclick="deleteProgramImage(' . $image->id . ', \'' . $image->original_name . '\', ' . $record->id . ')" style="position: absolute; top: 5px; right: 5px; background: #ef4444; color: white; border: none; border-radius: 50%; width: 24px; height: 24px; cursor: pointer; font-size: 14px; line-height: 1; display: flex; align-items: center; justify-content: center;">×</button>';

                                    $html .= '<img src="' . asset('storage/' . $image->path) . '" style="width: 100%; height: 120px; object-fit: cover; border-radius: 4px; margin-bottom: 8px;" alt="' . $image->alt_text . '">';
                                    $html .= '<p style="margin: 0; font-size: 12px; color: #6b7280;">' . $image->original_name . $isFeatured . '</p>';
                                    if ($image->caption) {
                                        $html .= '<p style="margin: 4px 0 0 0; font-size: 11px; color: #9ca3af; font-style: italic;">' . $image->caption . '</p>';
                                    }
                                    $html .= '</div>';
                                }
                                $html .= '</div>';

                                // Add JavaScript for delete and edit functionality using AJAX
                                $html .= '<script>
                                    function deleteProgramImage(imageId, imageName, programId) {
                                        if (confirm("Are you sure you want to delete the image \"" + imageName + "\"? This action cannot be undone.")) {
                                            const button = event.target;
                                            const originalText = button.innerHTML;
                                            button.innerHTML = "⌛";
                                            button.disabled = true;
                                            fetch("/admin/programs/" + programId + "/delete-image/" + imageId, {
                                                method: "POST",
                                                headers: {
                                                    "X-CSRF-TOKEN": document.querySelector("meta[name=\'csrf-token\']").getAttribute("content"),
                                                    "Content-Type": "application/json",
                                                    "Accept": "application/json"
                                                }
                                            })
                                            .then(response => response.json())
                                            .then(data => {
                                                if (data.success) {
                                                    const imageContainer = button.closest("div");
                                                    imageContainer.remove();
                                                    alert("Image deleted successfully!");
                                                    const remainingImages = document.querySelectorAll("[onclick^=\'deleteProgramImage\']");
                                                    if (remainingImages.length === 0) {
                                                        location.reload();
                                                    }
                                                } else {
                                                    alert("Error deleting image: " + (data.message || "Unknown error"));
                                                    button.innerHTML = originalText;
                                                    button.disabled = false;
                                                }
                                            })
                                            .catch(error => {
                                                console.error("Error:", error);
                                                alert("Error deleting image. Please try again.");
                                                button.innerHTML = originalText;
                                                button.disabled = false;
                                            });
                                        }
                                    }
                                    function editImageCaption(imageId, currentCaption, imageName) {
                                        const newCaption = prompt("Edit caption for \"" + imageName + "\":", currentCaption);
                                        if (newCaption !== null) {
                                            const button = event.target;
                                            const originalText = button.innerHTML;
                                            button.innerHTML = "⌛";
                                            button.disabled = true;
                                            fetch("/admin/images/" + imageId + "/update-caption", {
                                                method: "POST",
                                                headers: {
                                                    "X-CSRF-TOKEN": document.querySelector("meta[name=\'csrf-token\']").getAttribute("content"),
                                                    "Content-Type": "application/json",
                                                    "Accept": "application/json"
                                                },
                                                body: JSON.stringify({
                                                    caption: newCaption
                                                })
                                            })
                                            .then(response => response.json())
                                            .then(data => {
                                                if (data.success) {
                                                    const imageContainer = button.closest("div");
                                                    const captionElement = imageContainer.querySelector("p:last-child");
                                                    if (captionElement && newCaption) {
                                                        captionElement.textContent = newCaption;
                                                    } else if (newCaption) {
                                                        const newCaptionElement = document.createElement("p");
                                                        newCaptionElement.style.cssText = "margin: 4px 0 0 0; font-size: 11px; color: #9ca3af; font-style: italic;";
                                                        newCaptionElement.textContent = newCaption;
                                                        imageContainer.appendChild(newCaptionElement);
                                                    } else if (captionElement) {
                                                        captionElement.remove();
                                                    }
                                                    alert("Caption updated successfully!");
                                                } else {
                                                    alert("Error updating caption: " + (data.message || "Unknown error"));
                                                }
                                                button.innerHTML = originalText;
                                                button.disabled = false;
                                            })
                                            .catch(error => {
                                                console.error("Error:", error);
                                                alert("Error updating caption. Please try again.");
                                                button.innerHTML = originalText;
                                                button.disabled = false;
                                            });
                                        }
                                    }
                                </script>';

                                return new \Illuminate\Support\HtmlString($html);
                            })
                            ->columnSpanFull()
                            ->visible(fn($record) => $record && $record->exists),

                        // Upload new images with captions
                        Forms\Components\Repeater::make('new_images')
                            ->label('Upload New Images with Captions')
                            ->schema([
                                Forms\Components\FileUpload::make('file')
                                    ->label('Image')
                                    ->image()
                                    ->imageEditor()
                                    ->imageCropAspectRatio('16:9')
                                    ->imageResizeTargetWidth('1200')
                                    ->imageResizeTargetHeight('800')
                                    ->directory('programs')
                                    ->required()
                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                                    ->maxSize(5120)
                                    ->columnSpan(1),
                                Forms\Components\TextInput::make('caption')
                                    ->label('Caption')
                                    ->maxLength(1000)
                                    ->placeholder('Enter a descriptive caption for this image...')
                                    ->helperText('Optional: Add a caption that will be displayed below the image')
                                    ->columnSpan(2),
                                Forms\Components\Toggle::make('featured')
                                    ->label('Featured Image')
                                    ->helperText('Mark this as the main featured image for the program')
                                    ->columnSpan(1),
                            ])
                            ->columns(4)
                            ->columnSpanFull()
                            ->helperText('Upload new images with captions. You can mark one image as featured.')
                            ->addActionLabel('Add Another Image')
                            ->reorderable(false)
                            ->collapsible()
                            ->collapsed(),

                        // Image management actions
                        Forms\Components\Actions::make([
                            Forms\Components\Actions\Action::make('manage_images')
                                ->label('Manage Images in Admin Panel')
                                ->icon('heroicon-o-photo')
                                ->url(fn($record) => $record ? route('filament.admin.resources.images.index', ['filter[imageable_type]' => 'App\\Models\\Program', 'filter[imageable_id]' => $record->id]) : '#')
                                ->openUrlInNewTab()
                                ->visible(fn($record) => $record && $record->exists)
                                ->color('info')
                                ->extraAttributes(['class' => 'w-full']),
                        ])
                            ->columnSpanFull()
                            ->visible(fn($record) => $record && $record->exists),
                    ])
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('meta_title')
                    ->label('Meta Title')
                    ->maxLength(255),
                Forms\Components\Textarea::make('meta_description')
                    ->label('Meta Description')
                    ->maxLength(500),
                Forms\Components\Toggle::make('featured')
                    ->label('Featured')
                    ->default(false),
                Forms\Components\TextInput::make('sort_order')
                    ->label('Sort Order')
                    ->numeric()
                    ->default(0)
                    ->minValue(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('sort_order', 'asc')
            ->columns([
                Tables\Columns\ImageColumn::make('image_url')
                    ->label('Image')
                    ->circular()
                    ->size(50)
                    ->url(fn($record) => $record->image_url, true)
                    ->openUrlInNewTab(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
                    ->limit(30)
                    ->searchable()
                    ->sortable()
                    ->wrap(),
                Tables\Columns\TextColumn::make('excerpt')
                    ->label('Excerpt')
                    ->limit(30)
                    ->searchable()
                    ->wrap(),
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Sort Order')
                    ->sortable()
                    ->numeric(),
                Tables\Columns\TextColumn::make('content')
                    ->label('Content')
                    ->limit(30)
                    ->html()
                    ->wrap(),
                Tables\Columns\ToggleColumn::make('featured')
                    ->label('Featured'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPrograms::route('/'),
            'create' => Pages\CreateProgram::route('/create'),
            'edit' => Pages\EditProgram::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
