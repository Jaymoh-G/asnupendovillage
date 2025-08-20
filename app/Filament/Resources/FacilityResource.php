<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FacilityResource\Pages;
use App\Filament\Resources\FacilityResource\RelationManagers;
use App\Models\Facility;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FacilityResource extends Resource
{
    protected static ?string $model = Facility::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';
    protected static ?string $navigationGroup = 'Main Content';
    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Facility Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Facility Name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('slug')
                            ->label('Slug')
                            ->unique('facilities', 'slug', fn($record) => $record)
                            ->maxLength(255)
                            ->helperText('Leave empty to auto-generate from facility name'),


                        Forms\Components\Textarea::make('meta_description')
                            ->label('Meta Description')
                            ->rows(3)
                            ->maxLength(160)
                            ->helperText('SEO meta description (max 160 characters). This will be used for search engine results and social media sharing.'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Content')
                    ->schema([
                        Forms\Components\RichEditor::make('content')
                            ->label('Facility Content')
                            ->required()
                            ->columnSpanFull()
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('facilities/content')
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
                            ->helperText('Rich content with formatting, images, and attachments. Images uploaded here will use /public/storage/ paths for hosting compatibility.'),
                    ])
                    ->columns(1),

                Forms\Components\Section::make('Images')
                    ->schema([
                        // Display existing images with delete functionality
                        Forms\Components\Placeholder::make('existing_images')
                            ->label('Current Images')
                            ->content(function ($record) {
                                if (!$record || !$record->exists) {
                                    return 'Images will appear here after you save the facility. You can upload images using the section below or through the rich content editor above.';
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
                                    $html .= '<button type="button" onclick="deleteFacilityImage(' . $image->id . ', \'' . $image->original_name . '\', ' . $record->id . ')" style="position: absolute; top: 5px; right: 5px; background: #ef4444; color: white; border: none; border-radius: 50%; width: 24px; height: 24px; cursor: pointer; font-size: 14px; line-height: 1; display: flex; align-items: center; justify-content: center;">×</button>';

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
                                    function deleteFacilityImage(imageId, imageName, facilityId) {
                                        if (confirm("Are you sure you want to delete the image \"" + imageName + "\"? This action cannot be undone.")) {
                                            // Show loading state
                                            const button = event.target;
                                            const originalText = button.innerHTML;
                                            button.innerHTML = "⌛";
                                            button.disabled = true;

                                            // Make AJAX request to delete image
                                            fetch("/admin/facilities/" + facilityId + "/delete-image/" + imageId, {
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
                                                    // Remove the image container from DOM
                                                    const imageContainer = button.closest("div");
                                                    imageContainer.remove();

                                                    // Show success message
                                                    alert("Image deleted successfully!");

                                                    // If no images left, refresh the page to show "No images" message
                                                    const remainingImages = document.querySelectorAll("[onclick^=\'deleteFacilityImage\']");
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
                                            // Show loading state
                                            const button = event.target;
                                            const originalText = button.innerHTML;
                                            button.innerHTML = "⌛";
                                            button.disabled = true;

                                            // Make AJAX request to update caption
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
                                                    // Update the caption display
                                                    const imageContainer = button.closest("div");
                                                    const captionElement = imageContainer.querySelector("p:last-child");
                                                    if (captionElement && newCaption) {
                                                        captionElement.textContent = newCaption;
                                                    } else if (newCaption) {
                                                        // Create new caption element if it doesn\'t exist
                                                        const newCaptionElement = document.createElement("p");
                                                        newCaptionElement.style.cssText = "margin: 4px 0 0 0; font-size: 11px; color: #9ca3af; font-style: italic;";
                                                        newCaptionElement.textContent = newCaption;
                                                        imageContainer.appendChild(newCaptionElement);
                                                    } else if (captionElement) {
                                                        // Remove caption element if caption is empty
                                                        captionElement.remove();
                                                    }

                                                    // Show success message
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
                                    ->imageResizeTargetWidth('800')
                                    ->imageResizeTargetHeight('450')
                                    ->directory('facilities')
                                    ->required()
                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                                    ->maxSize(4096)
                                    ->columnSpan(1),
                                Forms\Components\TextInput::make('caption')
                                    ->label('Caption')
                                    ->maxLength(1000)
                                    ->placeholder('Enter a descriptive caption for this image...')
                                    ->helperText('Optional: Add a caption that will be displayed below the image')
                                    ->columnSpan(2),
                                Forms\Components\Toggle::make('featured')
                                    ->label('Featured Image')
                                    ->helperText('Mark this as the main featured image for the facility')
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
                                ->url(fn($record) => $record ? route('filament.admin.resources.images.index', ['filter[imageable_type]' => 'App\\Models\\Facility', 'filter[imageable_id]' => $record->id]) : '#')
                                ->openUrlInNewTab()
                                ->visible(fn($record) => $record && $record->exists)
                                ->color('info')
                                ->extraAttributes(['class' => 'w-full']),
                        ])
                            ->columnSpanFull()
                            ->visible(fn($record) => $record && $record->exists),
                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('featured_image_url')
                    ->label('Featured Image')
                    ->size(60)
                    ->openUrlInNewTab(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Facility Name')
                    ->searchable()
                    ->sortable(),





                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->toggleable(true),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                    ]),

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

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'slug', 'content', 'meta_description'];
    }

    public static function getGlobalSearchResultTitle(Model $record): string
    {
        return $record->name;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFacilities::route('/'),
            'create' => Pages\CreateFacility::route('/create'),
            'edit' => Pages\EditFacility::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
