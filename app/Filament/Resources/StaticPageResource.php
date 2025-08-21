<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StaticPageResource\Pages;
use App\Models\StaticPage;
use App\Rules\UniqueStaticPageName;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Log;

class StaticPageResource extends Resource
{
    protected static ?string $model = StaticPage::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Main Content';

    protected static ?string $navigationLabel = 'Static Pages';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Page Information')
                    ->schema([
                        Forms\Components\Select::make('page_name')
                            ->label('Page')
                            ->options([
                                'about-us' => 'About Us',
                                'founder' => 'Founder',
                                'donation' => 'Donation',
                                'contact-us' => 'Contact Us',
                                'privacy-policy' => 'Privacy Policy',
                                'terms-of-service' => 'Terms of Service',
                                'faqs' => 'FAQs',
                                'mission-vision' => 'Mission & Vision',
                                'our-values' => 'Our Values',
                                'history' => 'History',
                                'board-of-directors' => 'Board of Directors',
                                'annual-reports' => 'Annual Reports',
                                'transparency' => 'Transparency',
                            ])
                            ->required()
                            ->unique('static_pages', 'page_name')
                            ->searchable()
                            ->helperText('Select the page you want to manage'),
                        Forms\Components\TextInput::make('title')
                            ->label('Page Title')
                            ->maxLength(255)
                            ->helperText('Custom title for the page. Leave empty to use default.'),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true)
                            ->helperText('Enable or disable this page'),
                        Forms\Components\TextInput::make('sort_order')
                            ->label('Sort Order')
                            ->numeric()
                            ->default(0)
                            ->helperText('Order in which pages appear (lower numbers first)'),
                    ])->columns(2)
                    ->collapsible()
                    ->collapsed(false),

                Forms\Components\Section::make('Page Content')
                    ->schema([
                        Forms\Components\RichEditor::make('content')
                            ->label('Page Content')
                            ->toolbarButtons([
                                'attachFiles',
                                'bold',
                                'italic',
                                'underline',
                                'strike',
                                'link',
                                'bulletList',
                                'orderedList',
                                'h2',
                                'h3',
                                'h4',
                                'blockquote',
                                'codeBlock',
                                'undo',
                                'redo',
                            ])
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('static-pages')
                            ->fileAttachmentsVisibility('public')
                            ->getUploadedAttachmentUrlUsing(function ($file) {
                                return config('app.url') . '/public/storage/' . $file;
                            })
                            ->columnSpanFull()
                            ->helperText('Main content of the page. You can use rich text formatting and upload images. Images uploaded here will use /public/storage/ paths for hosting compatibility.'),
                    ])
                    ->collapsible()
                    ->collapsed(false),

                Forms\Components\Section::make('Featured Image')
                    ->schema([
                        // Display existing featured image
                        Forms\Components\Placeholder::make('existing_featured_image')
                            ->label('Current Featured Image')
                            ->content(function ($record) {
                                if (!$record || !$record->exists || !$record->featured_image) {
                                    return 'No featured image uploaded yet.';
                                }

                                $html = '<div style="text-align: center;">';
                                $html .= '<img src="' . $record->featured_image_url . '" style="max-width: 100%; height: auto; border-radius: 8px; border: 1px solid #e5e7eb;" alt="Featured Image">';
                                $html .= '<p style="margin: 8px 0 0 0; font-size: 12px; color: #6b7280;">Current featured image</p>';
                                $html .= '</div>';

                                return new \Illuminate\Support\HtmlString($html);
                            })
                            ->columnSpanFull()
                            ->visible(fn($record) => $record && $record->exists && $record->featured_image),

                        Forms\Components\FileUpload::make('featured_image')
                            ->label('Featured Image')
                            ->image()
                            ->imageEditor()
                            ->imageCropAspectRatio('16:9')
                            ->imageResizeTargetWidth('1200')
                            ->imageResizeTargetHeight('675')
                            ->directory('static-pages')
                            ->visibility('public')
                            ->maxSize(5120)
                            ->helperText('Upload a featured image for the page. Recommended: 1200x675px, 16:9 aspect ratio.')
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->columnSpanFull(),
                    ])
                    ->collapsible()
                    ->collapsed(false),

                Forms\Components\Section::make('Additional Images')
                    ->schema([
                        // Display existing images
                        Forms\Components\Placeholder::make('existing_images')
                            ->label('Current Page Images')
                            ->content(function ($record) {
                                if (!$record || !$record->exists) {
                                    return 'Images will appear here after you save the page.';
                                }

                                $images = $record->images;
                                if (!$images || !is_array($images) || empty($images)) {
                                    return 'No additional images uploaded yet.';
                                }

                                $html = '<div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 15px;">';
                                foreach ($record->image_urls as $imageUrl) {
                                    $html .= '<div style="border: 1px solid #e5e7eb; border-radius: 8px; padding: 10px; text-align: center;">';
                                    $html .= '<img src="' . $imageUrl . '" style="width: 100%; height: 120px; object-fit: cover; border-radius: 4px; margin-bottom: 8px;" alt="Page Image">';
                                    $html .= '<p style="margin: 0; font-size: 12px; color: #6b7280;">' . basename($imageUrl) . '</p>';
                                    $html .= '</div>';
                                }
                                $html .= '</div>';

                                return new \Illuminate\Support\HtmlString($html);
                            })
                            ->columnSpanFull()
                            ->visible(fn($record) => $record && $record->exists),

                        Forms\Components\FileUpload::make('images')
                            ->label('Page Images')
                            ->multiple()
                            ->image()
                            ->imageEditor()
                            ->imageCropAspectRatio('16:9')
                            ->imageResizeTargetWidth('800')
                            ->imageResizeTargetHeight('450')
                            ->directory('static-pages/gallery')
                            ->visibility('public')
                            ->maxSize(5120)
                            ->helperText('Upload additional images for the page. These will be displayed in a gallery format.')
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->columnSpanFull(),
                    ])
                    ->collapsible()
                    ->collapsed(false),

                Forms\Components\Section::make('Content Section 1')
                    ->schema([
                        Forms\Components\TextInput::make('section1_title')
                            ->label('Section 1 Title')
                            ->maxLength(255)
                            ->helperText('Title for the first content section'),
                        Forms\Components\RichEditor::make('section1_content')
                            ->label('Section 1 Content')
                            ->toolbarButtons([
                                'bold',
                                'italic',
                                'underline',
                                'link',
                                'bulletList',
                                'orderedList',
                                'h3',
                                'h4',
                                'blockquote',
                                'undo',
                                'redo',
                            ])
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('static-pages/section1')
                            ->fileAttachmentsVisibility('public')
                            ->columnSpanFull()
                            ->helperText('Content for the first section'),
                        // Display existing section 1 images
                        Forms\Components\Placeholder::make('existing_section1_images')
                            ->label('Current Section 1 Images')
                            ->content(function ($record) {
                                if (!$record || !$record->exists) {
                                    return 'Images will appear here after you save the page.';
                                }

                                $images = $record->section1_images;
                                if (!$images || !is_array($images) || empty($images)) {
                                    return 'No section 1 images uploaded yet.';
                                }

                                $html = '<div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 15px;">';
                                foreach ($record->section1_image_urls as $imageUrl) {
                                    $html .= '<div style="border: 1px solid #e5e7eb; border-radius: 8px; padding: 10px; text-align: center;">';
                                    $html .= '<img src="' . $imageUrl . '" style="width: 100%; height: 120px; object-fit: cover; border-radius: 4px; margin-bottom: 8px;" alt="Section 1 Image">';
                                    $html .= '<p style="margin: 0; font-size: 12px; color: #6b7280;">' . basename($imageUrl) . '</p>';
                                    $html .= '</div>';
                                }
                                $html .= '</div>';

                                return new \Illuminate\Support\HtmlString($html);
                            })
                            ->columnSpanFull()
                            ->visible(fn($record) => $record && $record->exists),

                        Forms\Components\FileUpload::make('section1_images')
                            ->label('Section 1 Images')
                            ->multiple()
                            ->image()
                            ->imageEditor()
                            ->imageCropAspectRatio('16:9')
                            ->imageResizeTargetWidth('800')
                            ->imageResizeTargetHeight('450')
                            ->directory('static-pages/section1')
                            ->visibility('public')
                            ->maxSize(5120)
                            ->helperText('Images for section 1')
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->columnSpanFull(),
                    ])
                    ->collapsible()
                    ->collapsed(false),

                Forms\Components\Section::make('Content Section 2')
                    ->schema([
                        Forms\Components\TextInput::make('section2_title')
                            ->label('Section 2 Title')
                            ->maxLength(255)
                            ->helperText('Title for the second content section'),
                        Forms\Components\RichEditor::make('section2_content')
                            ->label('Section 2 Content')
                            ->toolbarButtons([
                                'bold',
                                'italic',
                                'underline',
                                'link',
                                'bulletList',
                                'orderedList',
                                'h3',
                                'h4',
                                'blockquote',
                                'undo',
                                'redo',
                            ])
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('static-pages/section2')
                            ->fileAttachmentsVisibility('public')
                            ->columnSpanFull()
                            ->helperText('Content for the second section'),
                        // Display existing section 2 images
                        Forms\Components\Placeholder::make('existing_section2_images')
                            ->label('Current Section 2 Images')
                            ->content(function ($record) {
                                if (!$record || !$record->exists) {
                                    return 'Images will appear here after you save the page.';
                                }

                                $images = $record->section2_images;
                                if (!$images || !is_array($images) || empty($images)) {
                                    return 'No section 2 images uploaded yet.';
                                }

                                $html = '<div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 15px;">';
                                foreach ($record->section2_image_urls as $imageUrl) {
                                    $html .= '<div style="border: 1px solid #e5e7eb; border-radius: 8px; padding: 10px; text-align: center;">';
                                    $html .= '<img src="' . $imageUrl . '" style="width: 100%; height: 120px; object-fit: cover; border-radius: 4px; margin-bottom: 8px;" alt="Section 2 Image">';
                                    $html .= '<p style="margin: 0; font-size: 12px; color: #6b7280;">' . basename($imageUrl) . '</p>';
                                    $html .= '</div>';
                                }
                                $html .= '</div>';

                                return new \Illuminate\Support\HtmlString($html);
                            })
                            ->columnSpanFull()
                            ->visible(fn($record) => $record && $record->exists),

                        Forms\Components\FileUpload::make('section2_images')
                            ->label('Section 2 Images')
                            ->multiple()
                            ->image()
                            ->imageEditor()
                            ->imageCropAspectRatio('16:9')
                            ->imageResizeTargetWidth('800')
                            ->imageResizeTargetHeight('450')
                            ->directory('static-pages/section2')
                            ->visibility('public')
                            ->maxSize(5120)
                            ->helperText('Images for section 2')
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->columnSpanFull(),
                    ])
                    ->collapsible()
                    ->collapsed(false),

                Forms\Components\Section::make('Content Section 3')
                    ->schema([
                        Forms\Components\TextInput::make('section3_title')
                            ->label('Section 3 Title')
                            ->maxLength(255)
                            ->helperText('Title for the third content section'),
                        Forms\Components\RichEditor::make('section3_content')
                            ->label('Section 3 Content')
                            ->toolbarButtons([
                                'bold',
                                'italic',
                                'underline',
                                'link',
                                'bulletList',
                                'orderedList',
                                'h3',
                                'h4',
                                'blockquote',
                                'undo',
                                'redo',
                            ])
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('static-pages/section3')
                            ->fileAttachmentsVisibility('public')
                            ->columnSpanFull()
                            ->helperText('Content for the third section'),
                        // Display existing section 3 images
                        Forms\Components\Placeholder::make('existing_section3_images')
                            ->label('Current Section 3 Images')
                            ->content(function ($record) {
                                if (!$record || !$record->exists) {
                                    return 'Images will appear here after you save the page.';
                                }

                                $images = $record->section3_images;
                                if (!$images || !is_array($images) || empty($images)) {
                                    return 'No section 3 images uploaded yet.';
                                }

                                $html = '<div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 15px;">';
                                foreach ($record->section3_image_urls as $imageUrl) {
                                    $html .= '<div style="border: 1px solid #e5e7eb; border-radius: 8px; padding: 10px; text-align: center;">';
                                    $html .= '<img src="' . $imageUrl . '" style="width: 100%; height: 120px; object-fit: cover; border-radius: 4px; margin-bottom: 8px;" alt="Section 3 Image">';
                                    $html .= '</div>';
                                }
                                $html .= '</div>';

                                return new \Illuminate\Support\HtmlString($html);
                            })
                            ->columnSpanFull()
                            ->visible(fn($record) => $record && $record->exists),

                        Forms\Components\FileUpload::make('section3_images')
                            ->label('Section 3 Images')
                            ->multiple()
                            ->image()
                            ->imageEditor()
                            ->imageCropAspectRatio('16:9')
                            ->imageResizeTargetWidth('800')
                            ->imageResizeTargetHeight('450')
                            ->directory('static-pages/section3')
                            ->visibility('public')
                            ->maxSize(5120)
                            ->helperText('Images for section 3')
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->columnSpanFull(),
                    ])
                    ->collapsible()
                    ->collapsed(false),

                Forms\Components\Section::make('SEO Settings')
                    ->schema([
                        Forms\Components\TextInput::make('meta_title')
                            ->label('Meta Title')
                            ->maxLength(60)
                            ->helperText('SEO title for search engines. Leave empty to use page title.'),
                        Forms\Components\Textarea::make('meta_description')
                            ->label('Meta Description')
                            ->rows(3)
                            ->maxLength(160)
                            ->helperText('SEO description for search engines. Recommended: 150-160 characters.'),
                        Forms\Components\TextInput::make('meta_keywords')
                            ->label('Meta Keywords')
                            ->maxLength(255)
                            ->helperText('Comma-separated keywords for SEO'),
                    ])->columns(2)
                    ->collapsible()
                    ->collapsed(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('page_name')
                    ->label('Page')
                    ->formatStateUsing(fn($state) => ucfirst(str_replace('-', ' ', $state)))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->limit(30),
                Tables\Columns\ImageColumn::make('featured_image_url')
                    ->label('Featured Image')
                    ->size(60)
                    ->circular()
                    ->url(fn($record) => $record->featured_image_url, true)
                    ->openUrlInNewTab(),
                Tables\Columns\TextColumn::make('images')
                    ->label('Images')
                    ->formatStateUsing(function ($state) {
                        if (!$state || !is_array($state)) return '0';
                        return count($state) . ' image(s)';
                    })
                    ->badge()
                    ->color('info'),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Order')
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status')
                    ->placeholder('All')
                    ->trueLabel('Active')
                    ->falseLabel('Inactive'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('sort_order');
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
            'index' => Pages\ListStaticPages::route('/'),
            'create' => Pages\CreateStaticPage::route('/create'),
            'edit' => Pages\EditStaticPage::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        try {
            return (string) StaticPage::count();
        } catch (\Exception $e) {
            // Log the error and return null to prevent the application from crashing
            Log::error('Error getting StaticPage count for navigation badge: ' . $e->getMessage());
            return null;
        }
    }
}
