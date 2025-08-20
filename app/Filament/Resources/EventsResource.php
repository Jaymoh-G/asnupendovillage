<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventsResource\Pages;
use App\Filament\Resources\EventsResource\RelationManagers;
use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\ViewField;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use App\Models\Image;

class EventsResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationGroup = 'Media Centre';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Event Information')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('title')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('slug')
                                    ->maxLength(255)
                                    ->unique(Event::class, 'slug', fn($record) => $record),
                            ]),
                        RichEditor::make('description')
                            ->required()
                            ->columnSpanFull()
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('events/content')
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
                        Textarea::make('excerpt')
                            ->maxLength(500)
                            ->columnSpanFull(),
                    ])->columns(2),

                Section::make('Event Details')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('location')
                                    ->maxLength(255),
                                TextInput::make('organizer')
                                    ->maxLength(255),
                                TextInput::make('contact_email')
                                    ->email()
                                    ->maxLength(255),
                                TextInput::make('contact_phone')
                                    ->maxLength(255),
                            ]),
                    ])->columns(2),

                Section::make('Event Schedule')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                DateTimePicker::make('start_date')
                                    ->required(),
                                DateTimePicker::make('end_date')
                                    ->required(),
                            ]),
                    ])->columns(2),

                Section::make('Event Settings')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Select::make('status')
                                    ->options([
                                        'draft' => 'Draft',
                                        'published' => 'Published',
                                        'cancelled' => 'Cancelled',
                                        'completed' => 'Completed',
                                    ])
                                    ->default('draft')
                                    ->required(),
                                Select::make('type')
                                    ->options([
                                        'in-person' => 'In Person',
                                        'virtual' => 'Virtual',
                                        'hybrid' => 'Hybrid',
                                    ])
                                    ->default('in-person')
                                    ->required(),
                                Toggle::make('is_featured')
                                    ->label('Featured Event'),
                            ]),
                    ])->columns(2),

                Section::make('SEO & Meta')
                    ->schema([
                        TextInput::make('meta_title')
                            ->maxLength(255),
                        Textarea::make('meta_description')
                            ->maxLength(500),
                        TagsInput::make('tags'),
                    ])->columns(1),

                Section::make('Event Images')
                    ->schema([
                        // Display existing images with delete functionality
                        Forms\Components\Placeholder::make('existing_images')
                            ->label('Current Images')
                            ->content(function ($record) {
                                if (!$record || !$record->exists) {
                                    return 'No images uploaded yet.';
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
                                    $html .= '<button type="button" onclick="deleteEventImage(' . $image->id . ', \'' . $image->original_name . '\', ' . $record->id . ')" style="position: absolute; top: 5px; right: 5px; background: #ef4444; color: white; border: none; border-radius: 50%; width: 24px; height: 24px; cursor: pointer; font-size: 14px; line-height: 1; display: flex; align-items: center; justify-content: center;">×</button>';

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
                                    function deleteEventImage(imageId, imageName, eventId) {
                                        if (confirm("Are you sure you want to delete the image \"" + imageName + "\"? This action cannot be undone.")) {
                                            // Show loading state
                                            const button = event.target;
                                            const originalText = button.innerHTML;
                                            button.innerHTML = "⌛";
                                            button.disabled = true;

                                            // Make AJAX request to delete image
                                            fetch("/admin/events/" + eventId + "/delete-image/" + imageId, {
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
                                                    const remainingImages = document.querySelectorAll("[onclick^=\'deleteEventImage\']");
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
                                FileUpload::make('file')
                                    ->label('Image')
                                    ->image()
                                    ->imageEditor()
                                    ->imageCropAspectRatio('16:9')
                                    ->imageResizeTargetWidth('1920')
                                    ->imageResizeTargetHeight('1080')
                                    ->directory('events')
                                    ->required()
                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                                    ->maxSize(5120)
                                    ->columnSpan(1),
                                TextInput::make('caption')
                                    ->label('Caption')
                                    ->maxLength(1000)
                                    ->placeholder('Enter a descriptive caption for this image...')
                                    ->helperText('Optional: Add a caption that will be displayed below the image')
                                    ->columnSpan(2),
                                Toggle::make('featured')
                                    ->label('Featured Image')
                                    ->helperText('Mark this as the main featured image for the event')
                                    ->columnSpan(1),
                            ])
                            ->columns(4)
                            ->columnSpanFull()
                            ->helperText('Upload new images with captions. You can mark one image as featured.')
                            ->visible(fn($record) => $record && $record->exists)
                            ->addActionLabel('Add Another Image')
                            ->reorderable(false)
                            ->collapsible()
                            ->collapsed(),

                        // Image management actions
                        Forms\Components\Actions::make([
                            Forms\Components\Actions\Action::make('manage_images')
                                ->label('Manage Images in Admin Panel')
                                ->icon('heroicon-o-photo')
                                ->url(fn($record) => $record ? route('filament.admin.resources.images.index', ['filter[imageable_type]' => 'App\\Models\\Event', 'filter[imageable_id]' => $record->id]) : '#')
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
                ImageColumn::make('featured_image_url')
                    ->label('Image')
                    ->circular()
                    ->size(60)
                    ->url(fn($record) => $record->featured_image_url, true)
                    ->openUrlInNewTab(),
                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->limit(30),
                TextColumn::make('location')
                    ->searchable()
                    ->sortable()
                    ->limit(20),
                TextColumn::make('start_date')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('end_date')
                    ->dateTime()
                    ->sortable(),
                BadgeColumn::make('status')
                    ->colors([
                        'danger' => 'cancelled',
                        'warning' => 'draft',
                        'success' => 'published',
                        'secondary' => 'completed',
                    ]),
                BadgeColumn::make('type')
                    ->colors([
                        'primary' => 'in-person',
                        'info' => 'virtual',
                        'warning' => 'hybrid',
                    ]),
                ToggleColumn::make('is_featured')
                    ->label('Featured'),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                        'cancelled' => 'Cancelled',
                        'completed' => 'Completed',
                    ]),
                SelectFilter::make('type')
                    ->options([
                        'in-person' => 'In Person',
                        'virtual' => 'Virtual',
                        'hybrid' => 'Hybrid',
                    ]),
                TernaryFilter::make('is_featured')
                    ->label('Featured Events'),
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
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvents::route('/create'),
            'edit' => Pages\EditEvents::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
