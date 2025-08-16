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
                            ->columnSpanFull(),
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

                                    // Delete button (X icon) - using AJAX to avoid route issues
                                    $html .= '<button type="button" onclick="deleteImage(' . $image->id . ', \'' . $image->original_name . '\', ' . $record->id . ')" style="position: absolute; top: 5px; right: 5px; background: #ef4444; color: white; border: none; border-radius: 50%; width: 24px; height: 24px; cursor: pointer; font-size: 14px; line-height: 1; display: flex; align-items: center; justify-content: center;">×</button>';

                                    $html .= '<img src="' . asset('storage/' . $image->path) . '" style="width: 100%; height: 120px; object-fit: cover; border-radius: 4px; margin-bottom: 8px;" alt="' . $image->alt_text . '">';
                                    $html .= '<p style="margin: 0; font-size: 12px; color: #6b7280;">' . $image->original_name . $isFeatured . '</p>';
                                    $html .= '</div>';
                                }
                                $html .= '</div>';

                                // Add JavaScript for delete functionality using AJAX
                                $html .= '<script>
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
                                </script>';

                                return new \Illuminate\Support\HtmlString($html);
                            })
                            ->columnSpanFull()
                            ->visible(fn($record) => $record && $record->exists),

                        // Upload new images
                        FileUpload::make('temp_images')
                            ->label('Upload New Images')
                            ->multiple()
                            ->image()
                            ->imageEditor()
                            ->imageCropAspectRatio('16:9')
                            ->imageResizeTargetWidth('1920')
                            ->imageResizeTargetHeight('1080')
                            ->directory('news')
                            ->columnSpanFull()
                            ->helperText('Upload new images for the news article. Images will be processed and stored properly.')
                            ->visible(fn($record) => $record && $record->exists)
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->maxSize(5120), // 5MB

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
        return static::getModel()::count();
    }

    /**
     * Handle form submission for image uploads
     */
    public static function handleFormSubmission($data, $record = null)
    {
        // If this is an update and we have temp_images, process them
        if ($record && isset($data['temp_images']) && !empty($data['temp_images'])) {
            // Upload the new images using the HasImages trait
            $record->uploadImages($data['temp_images'], 'news');

            // Clear the temp_images field
            unset($data['temp_images']);
        }

        return $data;
    }
}
