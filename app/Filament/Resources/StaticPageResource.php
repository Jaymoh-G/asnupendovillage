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

    protected static ?string $navigationGroup = 'Content Management';

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
                            ->rules(['unique:static_pages,page_name'])
                            ->searchable()
                            ->helperText('Select the page you want to manage'),
                        Forms\Components\TextInput::make('title')
                            ->label('Page Title')
                            ->maxLength(255)
                            ->helperText('Custom title for the page. Leave empty to use default.'),
                        Forms\Components\Textarea::make('excerpt')
                            ->label('Page Excerpt')
                            ->rows(3)
                            ->maxLength(500)
                            ->helperText('Short description or summary of the page content'),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true)
                            ->helperText('Enable or disable this page'),
                        Forms\Components\TextInput::make('sort_order')
                            ->label('Sort Order')
                            ->numeric()
                            ->default(0)
                            ->helperText('Order in which pages appear (lower numbers first)'),
                    ])->columns(2),

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
                    ]),

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
                    ]),

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
                    ])->columns(2),
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
                Tables\Columns\TextColumn::make('excerpt')
                    ->label('Excerpt')
                    ->limit(50)
                    ->searchable(),
                Tables\Columns\ImageColumn::make('featured_image')
                    ->label('Featured Image')
                    ->size(60)
                    ->circular(),
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
}
