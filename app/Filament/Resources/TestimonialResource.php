<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Filament\Resources\TestimonialResource\RelationManagers;
use App\Models\Testimonial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Log;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationGroup = 'Main Content';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Testimonial Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Name')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Select::make('program_id')
                            ->label('Program')
                            ->relationship('program', 'title', fn($query) => $query->whereNotNull('title')->where('title', '!=', ''))
                            ->required()
                            ->searchable(),

                        Forms\Components\RichEditor::make('content')
                            ->label('Testimonial Content')
                            ->required()
                            ->columnSpanFull()
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('testimonials/content')
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

                        Forms\Components\Textarea::make('excerpt')
                            ->label('Excerpt')
                            ->maxLength(300)
                            ->helperText('A brief summary of the testimonial for display on listing pages (max 300 characters)')
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('pdf_file')
                            ->label('PDF Document')
                            ->acceptedFileTypes(['application/pdf'])
                            ->directory('testimonials/pdfs')
                            ->visibility('public')
                            ->maxSize(4096)
                            ->helperText('Upload a PDF document (optional, max 4MB)'),

                        Forms\Components\Section::make('Testimonial Images')
                            ->schema([
                                // Display existing images with delete functionality
                                Forms\Components\Placeholder::make('existing_images')
                                    ->label('Current Images')
                                    ->content(function ($record) {
                                        if (!$record || !$record->exists) {
                                            return 'Images will appear here after you save the testimonial. You can upload images using the section below or through the rich content editor above.';
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
                                            $html .= '<button type="button" onclick="deleteTestimonialImage(' . $image->id . ', \'' . $image->original_name . '\', ' . $record->id . ')" style="position: absolute; top: 5px; right: 5px; background: #ef4444; color: white; border: none; border-radius: 50%; width: 24px; height: 24px; cursor: pointer; font-size: 14px; line-height: 1; display: flex; align-items: center; justify-content: center;">×</button>';

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
                                            function deleteTestimonialImage(imageId, imageName, testimonialId) {
                                                if (confirm("Are you sure you want to delete the image \"" + imageName + "\"? This action cannot be undone.")) {
                                                    const button = event.target;
                                                    const originalText = button.innerHTML;
                                                    button.innerHTML = "⌛";
                                                    button.disabled = true;
                                                    fetch("/admin/testimonials/" + testimonialId + "/delete-image/" + imageId, {
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
                                                            const remainingImages = document.querySelectorAll("[onclick^=\'deleteTestimonialImage\']");
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
                                            ->imageResizeTargetWidth('800')
                                            ->imageResizeTargetHeight('600')
                                            ->directory('testimonials')
                                            ->required()
                                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                                            ->maxSize(2048)
                                            ->columnSpan(1),
                                        Forms\Components\TextInput::make('caption')
                                            ->label('Caption')
                                            ->maxLength(1000)
                                            ->placeholder('Enter a descriptive caption for this image...')
                                            ->helperText('Optional: Add a caption that will be displayed below the image')
                                            ->columnSpan(2),
                                        Forms\Components\Toggle::make('featured')
                                            ->label('Featured Image')
                                            ->helperText('Mark this as the main featured image for the testimonial')
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
                                        ->url(fn($record) => $record ? route('filament.admin.resources.images.index', ['filter[imageable_type]' => 'App\\Models\\Testimonial', 'filter[imageable_id]' => $record->id]) : '#')
                                        ->openUrlInNewTab()
                                        ->visible(fn($record) => $record && $record->exists)
                                        ->color('info')
                                        ->extraAttributes(['class' => 'w-full']),
                                ])
                                    ->columnSpanFull()
                                    ->visible(fn($record) => $record && $record->exists),
                            ])
                            ->columnSpanFull(),

                        Forms\Components\TagsInput::make('tags')
                            ->label('Tags')
                            ->separator(',')
                            ->helperText('Enter tags separated by commas (optional)'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Settings')
                    ->schema([
                        Forms\Components\Toggle::make('is_featured')
                            ->label('Featured Testimonial')
                            ->default(false),

                        Forms\Components\TextInput::make('sort_order')
                            ->label('Sort Order')
                            ->numeric()
                            ->default(0)
                            ->minValue(0),
                    ])
                    ->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_url')
                    ->label('Image')
                    ->circular()
                    ->size(50)
                    ->openUrlInNewTab(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable()
                    ->wrap(),

                Tables\Columns\TextColumn::make('excerpt')
                    ->label('Excerpt')
                    ->limit(30)
                    ->searchable()
                    ->default('No excerpt available')
                    ->formatStateUsing(fn($state) => $state ?: 'No excerpt available')
                    ->wrap(),

                Tables\Columns\TextColumn::make('program.title')
                    ->label('Program')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('success')
                    ->default('No Program')
                    ->formatStateUsing(fn($state) => $state ?: 'No Program')
                    ->wrap(),

                Tables\Columns\TextColumn::make('content')
                    ->label('Content')
                    ->limit(30)
                    ->html()
                    ->formatStateUsing(fn($state) => $state ? strip_tags($state) : 'No content')
                    ->wrap(),

                Tables\Columns\IconColumn::make('pdf_file')
                    ->label('PDF')
                    ->boolean()
                    ->trueIcon('heroicon-o-document-text')
                    ->falseIcon('heroicon-o-minus')
                    ->trueColor('success')
                    ->falseColor('gray'),

                Tables\Columns\TagsColumn::make('tags')
                    ->label('Tags')
                    ->limit(3)
                    ->formatStateUsing(function ($state) {
                        if (is_array($state)) {
                            return array_filter($state, function ($tag) {
                                return is_string($tag) && !empty($tag);
                            });
                        }
                        return [];
                    }),

                Tables\Columns\ToggleColumn::make('is_featured')
                    ->label('Featured'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(true)
                    ->wrap(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('program_id')
                    ->label('Program')
                    ->relationship('program', 'title', fn($query) => $query->whereNotNull('title')->where('title', '!=', ''))
                    ->options(function () {
                        try {
                            return \App\Models\Program::whereNotNull('title')
                                ->where('title', '!=', '')
                                ->pluck('title', 'id')
                                ->toArray();
                        } catch (\Exception $e) {
                            return [];
                        }
                    }),

                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('Featured'),

                Tables\Filters\SelectFilter::make('tags')
                    ->label('Tags')
                    ->multiple()
                    ->options(function () {
                        try {
                            return \App\Models\Testimonial::whereNotNull('tags')
                                ->where('tags', '!=', '[]')
                                ->where('tags', '!=', 'null')
                                ->pluck('tags')
                                ->filter(function ($tags) {
                                    return is_array($tags) && !empty($tags);
                                })
                                ->flatten()
                                ->unique()
                                ->filter(function ($tag) {
                                    return is_string($tag) && !empty($tag);
                                })
                                ->pluck('name', 'name')
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
            ])
            ->defaultSort('sort_order', 'asc');
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
            'index' => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonial::route('/create'),
            'edit' => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        try {
            return (string) Testimonial::count();
        } catch (\Exception $e) {
            // Log the error and return null to prevent the application from crashing
            Log::error('Error getting Testimonial count for navigation badge: ' . $e->getMessage());
            return null;
        }
    }
}
