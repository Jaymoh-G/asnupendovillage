<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HomeSliderResource\Pages;
use App\Models\HomeSlider;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Illuminate\Contracts\View\View;

class HomeSliderResource extends Resource
{
    protected static ?string $model = HomeSlider::class;

    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-line';

    protected static ?string $navigationGroup = 'Content Management';

    protected static ?int $navigationSort = 1;

    protected static ?string $modelLabel = 'Home Slider';

    protected static ?string $pluralModelLabel = 'Home Sliders';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Slider Information')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Title')
                            ->required()
                            ->maxLength(255)
                            ->live('onBlur')
                            ->afterStateUpdated(function ($operation, $state, Forms\Set $set) {
                                if ($operation === 'create') {
                                    $set('slug', Str::slug($state));
                                }
                            }),

                        Forms\Components\TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),

                        Forms\Components\TextInput::make('subtitle')
                            ->label('Subtitle')
                            ->maxLength(255),

                        Forms\Components\Textarea::make('description')
                            ->label('Description')
                            ->rows(3)
                            ->maxLength(1000),

                        Forms\Components\TextInput::make('button_text')
                            ->label('Button Text')
                            ->maxLength(100),

                        Forms\Components\TextInput::make('button_url')
                            ->label('Button URL')
                            ->url()
                            ->maxLength(255),

                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options([
                                'active' => 'Active',
                                'inactive' => 'Inactive',
                            ])
                            ->default('active')
                            ->required(),

                        Forms\Components\TextInput::make('sort_order')
                            ->label('Sort Order')
                            ->numeric()
                            ->default(0)
                            ->minValue(0),

                        Forms\Components\Toggle::make('is_featured')
                            ->label('Featured Slider')
                            ->default(false),
                    ])->columns(2),

                Forms\Components\Section::make('SEO Information')
                    ->schema([
                        Forms\Components\TextInput::make('meta_title')
                            ->label('Meta Title')
                            ->maxLength(255),

                        Forms\Components\Textarea::make('meta_description')
                            ->label('Meta Description')
                            ->rows(2)
                            ->maxLength(500),
                    ])->columns(2),

                Forms\Components\Section::make('Slider Images')
                    ->schema([
                        Forms\Components\View::make('filament.resources.home-slider-resource.components.existing-images')
                            ->label('Current Images'),

                        Forms\Components\Tabs::make('Image Selection')
                            ->tabs([
                                Forms\Components\Tabs\Tab::make('Select from Existing')
                                    ->schema([
                                        \App\Filament\Components\ExistingImagePicker::make('existing_images')
                                            ->label('Choose from Existing Images')
                                            ->directory('images')
                                            ->maxFiles(10)
                                            ->placeholder('Browse existing images')
                                            ->helperText('Select from images already uploaded to the system. You can search by filename.'),
                                    ]),
                                Forms\Components\Tabs\Tab::make('Upload New Images')
                                    ->schema([
                                        Forms\Components\FileUpload::make('images')
                                            ->label('Upload New Images')
                                            ->multiple()
                                            ->image()
                                            ->imageEditor()
                                            ->imageCropAspectRatio('16:9')
                                            ->imageResizeTargetWidth('1920')
                                            ->imageResizeTargetHeight('1080')
                                            ->directory('home-sliders')
                                            ->visibility('public')
                                            ->maxSize(5120)
                                            ->helperText('Upload high-quality images for the slider. Recommended aspect ratio: 16:9, minimum width: 1920px.')
                                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp']),
                                    ]),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('featured_image_url')
                    ->label('Image')
                    ->circular()
                    ->size(60)
                    ->url(function ($record) {
                        return $record->featured_image_url;
                    }, true)
                    ->openUrlInNewTab(),

                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable()
                    ->limit(50),

                Tables\Columns\TextColumn::make('subtitle')
                    ->label('Subtitle')
                    ->searchable()
                    ->limit(30)
                    ->toggleable(),

                Tables\Columns\TextColumn::make('images_count')
                    ->label('Images')
                    ->counts('images')
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'success' => 'active',
                        'danger' => 'inactive',
                    ]),

                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Featured')
                    ->boolean()
                    ->trueIcon('heroicon-o-star')
                    ->falseIcon('heroicon-o-star')
                    ->trueColor('warning')
                    ->falseColor('gray'),

                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Sort Order')
                    ->sortable(),

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
                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('Featured Sliders'),
            ])
            ->actions([
                Tables\Actions\Action::make('view_images')
                    ->label('View Images')
                    ->icon('heroicon-o-photo')
                    ->modalHeading(function (HomeSlider $record) {
                        return "Images for {$record->title}";
                    })
                    ->modalContent(function (HomeSlider $record) {
                        return view('filament.resources.home-slider-resource.modals.view-images', ['slider' => $record]);
                    })
                    ->modalWidth('7xl'),
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
            'index' => Pages\ListHomeSliders::route('/'),
            'create' => Pages\CreateHomeSlider::route('/create'),
            'edit' => Pages\EditHomeSlider::route('/{record}/edit'),
        ];
    }
}
