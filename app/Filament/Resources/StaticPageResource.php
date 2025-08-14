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
                            ->unique(ignoreRecord: true)
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
                            ->columnSpanFull()
                            ->helperText('Main content of the page. You can use rich text formatting and upload images.'),
                    ])
                    ->collapsible()
                    ->collapsed(false),

                Forms\Components\Section::make('Featured Image')
                    ->schema([
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
        return static::getModel()::count();
    }
}
