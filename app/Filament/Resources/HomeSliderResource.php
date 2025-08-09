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
                Forms\Components\Section::make('Slider Content')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Slider Title')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('subtitle')
                            ->label('Subtitle')
                            ->maxLength(255),
                        Forms\Components\Textarea::make('description')
                            ->label('Description')
                            ->rows(3)
                            ->maxLength(500),
                        Forms\Components\TextInput::make('button_text')
                            ->label('Button Text')
                            ->maxLength(50),
                        Forms\Components\TextInput::make('button_url')
                            ->label('Button URL')
                            ->url()
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Slider Image')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->label('Slider Image')
                            ->image()
                            ->imageEditor()
                            ->imageCropAspectRatio('16:9')
                            ->imageResizeTargetWidth('1920')
                            ->imageResizeTargetHeight('1080')
                            ->directory('home-sliders')
                            ->visibility('public')
                            ->maxSize(5120)
                            ->helperText('Upload a high-quality image for the slider. Recommended size: 1920x1080px.'),
                    ]),

                Forms\Components\Section::make('Settings')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options([
                                'active' => 'Active',
                                'inactive' => 'Inactive',
                            ])
                            ->default('active')
                            ->required(),
                        Forms\Components\Toggle::make('is_featured')
                            ->label('Featured Slider')
                            ->default(false),
                        Forms\Components\TextInput::make('sort_order')
                            ->label('Sort Order')
                            ->numeric()
                            ->default(0)
                            ->minValue(0),
                    ])
                    ->columns(3),

                Forms\Components\Section::make('SEO')
                    ->schema([
                        Forms\Components\TextInput::make('meta_title')
                            ->label('Meta Title')
                            ->maxLength(60)
                            ->helperText('Recommended: 50-60 characters'),
                        Forms\Components\Textarea::make('meta_description')
                            ->label('Meta Description')
                            ->maxLength(160)
                            ->rows(2)
                            ->helperText('Recommended: 150-160 characters'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_url')
                    ->label('Image')
                    ->size(60)
                    ->openUrlInNewTab(),

                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable()
                    ->limit(30),

                Tables\Columns\TextColumn::make('subtitle')
                    ->label('Subtitle')
                    ->searchable()
                    ->limit(25),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn($record) => $record->status === 'active' ? 'success' : 'danger'),

                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Featured')
                    ->boolean()
                    ->trueIcon('heroicon-o-star')
                    ->falseIcon('heroicon-o-star')
                    ->trueColor('warning')
                    ->falseColor('gray'),

                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Order')
                    ->sortable()
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
