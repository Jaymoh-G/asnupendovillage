<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsResource\Pages;
use App\Filament\Resources\NewsResource\RelationManagers;
use App\Models\News;
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
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Illuminate\Support\Facades\Log;

class NewsResource extends Resource
{
    protected static ?string $model = News::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationGroup = 'Media Centre';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('News Information')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('title')
                                    ->required()
                                    ->maxLength(255),
                            ]),
                        RichEditor::make('content')
                            ->required()
                            ->columnSpanFull()
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('news/content')
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
                        Textarea::make('excerpt')
                            ->maxLength(500)
                            ->columnSpanFull(),
                    ])->columns(2),

                Section::make('News Details')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('category')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('author')
                                    ->maxLength(255),
                                Select::make('status')
                                    ->options([
                                        'draft' => 'Draft',
                                        'published' => 'Published',
                                        'archived' => 'Archived',
                                    ])
                                    ->default('draft')
                                    ->required(),
                                DateTimePicker::make('published_at'),
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

                Section::make('News Images')
                    ->schema([
                        // Display existing images with delete functionality
                        Forms\Components\Placeholder::make('existing_images')
                            ->label('Current Images (Including Rich Content Images)')
                            ->content(function ($record) {
                                if (!$record || !$record->exists) {
                                    return 'Images will appear here after you save the news article. You can upload images using the section below or through the rich content editor above.';
                                }

                                $images = $record->images()->ordered()->get();
                                if ($images->isEmpty()) {
                                    return 'No images uploaded yet.';
                                }

                                $html = '<div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 15px;">';
                                foreach ($images as $image) {
                                    $isFeatured = $image->featured ? ' (Featured)' : '';
                                    $featuredClass = $image->featured ? 'featured-image' : '';
                                    $isFromRichContent = static::isImageFromRichContent($record, $image) ? ' (Rich Content)' : '';

                                    $richContentClass = static::isImageFromRichContent($record, $image) ? 'rich-content-image' : '';
                                    $html .= '<div class="' . $featuredClass . ' ' . $richContentClass . '" style="border: 1px solid #e5e7eb; border-radius: 8px; padding: 10px; text-align: center; position: relative; ' . (static::isImageFromRichContent($record, $image) ? 'border-left: 4px solid #10b981;' : '') . '">';

                                    // Edit button (pencil icon) - opens modal to edit caption
                                    $html .= '<button type="button" onclick="editImageCaption(' . $image->id . ', \'' . addslashes($image->caption ?? '') . '\', \'' . $image->original_name . '\')" style="position: absolute; top: 5px; left: 5px; background: #3b82f6; color: white; border: none; border-radius: 50%; width: 24px; height: 24px; cursor: pointer; font-size: 12px; line-height: 1; display: flex; align-items: center; justify-content: center; z-index: 10;">✎</button>';

                                    // Delete button (X icon) - using AJAX to avoid route issues
                                    $html .= '<button type="button" onclick="deleteImage(' . $image->id . ', \'' . $image->original_name . '\', ' . $record->id . ')" style="position: absolute; top: 5px; right: 5px; background: #ef4444; color: white; border: none; border-radius: 50%; width: 24px; height: 24px; cursor: pointer; font-size: 14px; line-height: 1; display: flex; align-items: center; justify-content: center;">×</button>';

                                    $html .= '<img src="' . asset('storage/' . $image->path) . '" style="width: 100%; height: 120px; object-fit: cover; border-radius: 4px; margin-bottom: 8px;" alt="' . $image->alt_text . '">';
                                    $html .= '<p style="margin: 0; font-size: 12px; color: #6b7280;">' . $image->original_name . $isFeatured . $isFromRichContent . '</p>';
                                    if ($image->caption) {
                                        $html .= '<p style="margin: 4px 0 0 0; font-size: 11px; color: #9ca3af; font-style: italic;">' . $image->caption . '</p>';
                                    }
                                    $html .= '</div>';
                                }
                                $html .= '</div>';

                                // Add CSS and JavaScript for delete and edit functionality using AJAX
                                $html .= '<style>
                                    .rich-content-image {
                                        background-color: #f0fdf4;
                                    }
                                    .rich-content-image:hover {
                                        background-color: #dcfce7;
                                    }
                                </style>
                                <script>
                                    function deleteImage(imageId, imageName, newsId) {
                                        if (confirm("Are you sure you want to delete the image \"" + imageName + "\"? This action cannot be undone.")) {
                                            // Show loading state
                                            const button = event.target;
                                            const originalText = button.innerHTML;
                                            button.innerHTML = "⌛";
                                            button.disabled = true;

                                            // Make AJAX request to delete image
                                            fetch("/admin/news/" + newsId + "/delete-image/" + imageId, {
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
                                                    const remainingImages = document.querySelectorAll("[onclick^=\'deleteImage\']");
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
                            ->helperText('Note: Images uploaded through the rich content editor above will also appear in the Current Images section.')
                            ->schema([
                                FileUpload::make('file')
                                    ->label('Image')
                                    ->image()
                                    ->imageEditor()
                                    ->imageCropAspectRatio('16:9')
                                    ->imageResizeTargetWidth('1920')
                                    ->imageResizeTargetHeight('1080')
                                    ->directory('news')
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
                                    ->helperText('Mark this as the main featured image for the news article')
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
                                ->url(fn($record) => $record ? route('filament.admin.resources.images.index', ['filter[imageable_type]' => 'App\\Models\\News', 'filter[imageable_id]' => $record->id]) : '#')
                                ->openUrlInNewTab()
                                ->visible(fn($record) => $record && $record->exists)
                                ->color('info')
                                ->extraAttributes(['class' => 'w-full']),
                        ])
                            ->columnSpanFull()
                            ->visible(fn($record) => $record && $record->exists),
                    ]),
            ])
            ->extraAttributes(['class' => 'news-resource-form']);
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
                TextColumn::make('category')
                    ->searchable()
                    ->sortable()
                    ->limit(20),
                TextColumn::make('author')
                    ->searchable()
                    ->sortable()
                    ->limit(20),
                BadgeColumn::make('status')
                    ->colors([
                        'danger' => 'archived',
                        'warning' => 'draft',
                        'success' => 'published',
                    ]),
                TextColumn::make('published_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                        'archived' => 'Archived',
                    ]),
                SelectFilter::make('category')
                    ->options(function () {
                        try {
                            return News::distinct()
                                ->whereNotNull('category')
                                ->where('category', '!=', '')
                                ->pluck('category', 'category')
                                ->filter(function ($category) {
                                    return !is_null($category) && $category !== '';
                                })
                                ->toArray();
                        } catch (\Exception $e) {
                            return [];
                        }
                    }),
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
            'index' => Pages\ListNews::route('/'),
            'create' => Pages\CreateNews::route('/create'),
            'edit' => Pages\EditNews::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        try {
            return (string) News::count();
        } catch (\Exception $e) {
            // Log the error and return null to prevent the application from crashing
            Log::error('Error getting News count for navigation badge: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Handle form submission for image uploads with captions
     */
    public static function handleFormSubmission($data, $record = null)
    {
        // If this is an update and we have new_images, process them
        if ($record && isset($data['new_images']) && !empty($data['new_images'])) {
            foreach ($data['new_images'] as $imageData) {
                if (isset($imageData['file']) && $imageData['file']) {
                    // Create the image record with caption and featured status
                    $image = $record->images()->create([
                        'filename' => basename($imageData['file']),
                        'original_name' => basename($imageData['file']),
                        'path' => $imageData['file'],
                        'mime_type' => 'image/jpeg', // Default, will be updated
                        'size' => 0, // Will be updated
                        'alt_text' => pathinfo($imageData['file'], PATHINFO_FILENAME),
                        'caption' => $imageData['caption'] ?? null,
                        'featured' => $imageData['featured'] ?? false,
                        'sort_order' => $record->images()->count(),
                    ]);

                    // If this is marked as featured, unmark others
                    if ($imageData['featured'] ?? false) {
                        $record->images()->where('id', '!=', $image->id)->update(['featured' => false]);
                    }
                }
            }

            // Clear the new_images field
            unset($data['new_images']);
        }

        return $data;
    }

    /**
     * Check if an image was uploaded through RichEditor
     */
    public static function isImageFromRichContent($record, $image): bool
    {
        if (!$record || !$record->content) {
            return false;
        }

        // Check if the image path appears in the rich content
        $imagePath = $image->path;
        $content = $record->content;

        // Look for the image in the content with different URL formats
        $searchPatterns = [
            $imagePath,
            asset('storage/' . $imagePath),
            config('app.url') . '/storage/' . $imagePath,
            config('app.url') . '/public/storage/' . $imagePath,
            'http://localhost/storage/' . $imagePath,
            'https://localhost/storage/' . $imagePath,
            'http://localhost/public/storage/' . $imagePath,
            'https://localhost/public/storage/' . $imagePath,
        ];

        foreach ($searchPatterns as $pattern) {
            if (str_contains($content, $pattern)) {
                return true;
            }
        }

        return false;
    }
}
