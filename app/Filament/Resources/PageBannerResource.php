<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageBannerResource\Pages;
use App\Models\PageBanner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PageBannerResource extends Resource
{
    protected static ?string $model = PageBanner::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationGroup = 'Site Management';

    protected static ?string $navigationLabel = 'Page Banners';

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
                                'downloads' => 'Downloads',
                                'news' => 'News',
                                'contact-us' => 'Contact Us',
                                'gallery' => 'Gallery',
                                'team' => 'Team',
                                'testimonials' => 'Testimonials',
                                'faqs' => 'FAQs',
                                'donate-now' => 'Donate Now',
                                'careers' => 'Careers',
                                'media-centre' => 'Media Centre',
                            ])
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->searchable(),
                        Forms\Components\TextInput::make('title')
                            ->label('Page Title')
                            ->maxLength(255)
                            ->helperText('This will override the default page title'),
                        Forms\Components\Textarea::make('description')
                            ->label('Page Description')
                            ->rows(3)
                            ->maxLength(500)
                            ->helperText('Optional description for the page'),
                    ])->columns(2),

                Forms\Components\Section::make('Banner Image')
                    ->schema([
                        Forms\Components\FileUpload::make('banner_image_path')
                            ->label('Banner Image')
                            ->image()
                            ->imageEditor()
                            ->imageCropAspectRatio('16:9')
                            ->imageResizeTargetWidth('1920')
                            ->imageResizeTargetHeight('1080')
                            ->directory('page-banners')
                            ->visibility('public')
                            ->maxSize(5120)
                            ->helperText('Upload a high-quality banner image. Recommended: 1920x1080px, 16:9 aspect ratio.')
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('banner_image_alt')
                            ->label('Alt Text')
                            ->maxLength(255)
                            ->helperText('Alternative text for accessibility'),
                    ])->columns(2),

                Forms\Components\Section::make('Settings')
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true)
                            ->helperText('Enable or disable this banner'),
                    ]),
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
                Tables\Columns\ImageColumn::make('banner_image_path')
                    ->label('Banner')
                    ->size(60)
                    ->circular(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
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
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListPageBanners::route('/'),
            'create' => Pages\CreatePageBanner::route('/create'),
            'view' => Pages\ViewPageBanner::route('/{record}'),
            'edit' => Pages\EditPageBanner::route('/{record}/edit'),
        ];
    }
}
