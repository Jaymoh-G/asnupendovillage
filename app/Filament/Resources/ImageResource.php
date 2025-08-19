<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ImageResource\Pages;
use App\Models\Image;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;

class ImageResource extends Resource
{
    protected static ?string $model = Image::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationGroup = 'Media Centre';

    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Image Information')
                    ->schema([
                        FileUpload::make('file')
                            ->label('Upload Image')
                            ->image()
                            ->imageEditor()
                            ->imageCropAspectRatio('16:9')
                            ->imageResizeTargetWidth('1920')
                            ->imageResizeTargetHeight('1080')
                            ->directory('images')
                            ->required()
                            ->columnSpanFull(),
                    ]),

                Section::make('Image Details')
                    ->schema([
                        TextInput::make('alt_text')
                            ->label('Alt Text')
                            ->maxLength(255)
                            ->helperText('Alternative text for accessibility'),
                        Textarea::make('caption')
                            ->label('Caption')
                            ->maxLength(1000)
                            ->rows(3),
                        Toggle::make('featured')
                            ->label('Featured Image'),
                        TextInput::make('sort_order')
                            ->label('Sort Order')
                            ->numeric()
                            ->default(0),
                    ])->columns(2),

                Section::make('Associated Model')
                    ->schema([
                        Select::make('imageable_type')
                            ->label('Content Type')
                            ->options([
                                'App\Models\News' => 'News Article',
                                'App\Models\Event' => 'Event',
                                'App\Models\Album' => 'Album',
                            ])
                            ->required()
                            ->searchable()
                            ->reactive()
                            ->placeholder('Select content type...'),
                        Select::make('imageable_id')
                            ->label('Select Content')
                            ->options(function ($get) {
                                $type = $get('imageable_type');
                                if (!$type) return [];

                                switch ($type) {
                                    case 'App\Models\News':
                                        return \App\Models\News::whereNotNull('title')
                                            ->where('title', '!=', '')
                                            ->pluck('title', 'id')
                                            ->toArray();
                                    case 'App\Models\Event':
                                        return \App\Models\Event::whereNotNull('title')
                                            ->where('title', '!=', '')
                                            ->pluck('title', 'id')
                                            ->toArray();
                                    case 'App\Models\Album':
                                        return \App\Models\Album::whereNotNull('name')
                                            ->where('name', '!=', '')
                                            ->pluck('name', 'id')
                                            ->toArray();
                                    default:
                                        return [];
                                }
                            })
                            ->searchable()
                            ->required()
                            ->visible(fn($get) => $get('imageable_type'))
                            ->placeholder('Select content...'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('display_url')
                    ->label('Image')
                    ->circular()
                    ->size(60)
                    ->url(fn($record) => $record->display_url, true)
                    ->openUrlInNewTab(),
                TextColumn::make('original_name')
                    ->label('Name')
                    ->searchable()
                    ->sortable()
                    ->limit(30),
                TextColumn::make('caption')
                    ->label('Caption')
                    ->searchable()
                    ->sortable()
                    ->limit(50)
                    ->wrap(),
                TextColumn::make('imageable_type')
                    ->label('Content Type')
                    ->formatStateUsing(function ($state) {
                        switch ($state) {
                            case 'App\Models\News':
                                return 'News Article';
                            case 'App\Models\Event':
                                return 'Event';
                            case 'App\Models\Album':
                                return 'Album';
                            default:
                                return class_basename($state);
                        }
                    })
                    ->sortable()
                    ->limit(15),
                TextColumn::make('imageable_id')
                    ->label('Content')
                    ->formatStateUsing(function ($state, $record) {
                        if (!$record->imageable_type || !$record->imageable_id) {
                            return 'Not assigned';
                        }

                        try {
                            $model = $record->imageable_type::find($record->imageable_id);
                            if (!$model) return 'Content not found';

                            switch ($record->imageable_type) {
                                case 'App\Models\News':
                                    return $model->title;
                                case 'App\Models\Event':
                                    return $model->title;
                                case 'App\Models\Album':
                                    return $model->name;
                                default:
                                    return 'ID: ' . $record->imageable_id;
                            }
                        } catch (\Exception $e) {
                            return 'ID: ' . $record->imageable_id;
                        }
                    })
                    ->sortable()
                    ->limit(25),
                TextColumn::make('formatted_size')
                    ->label('Size')
                    ->sortable(),
                ToggleColumn::make('featured')
                    ->label('Featured'),
            ])
            ->filters([
                SelectFilter::make('imageable_type')
                    ->label('Model Type')
                    ->options([
                        'App\Models\News' => 'News',
                        'App\Models\Event' => 'Event',
                        'App\Models\Album' => 'Album',
                    ]),
                TernaryFilter::make('featured')
                    ->label('Featured Images'),
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
            'index' => Pages\ListImages::route('/'),
            'create' => Pages\CreateImage::route('/create'),
            'edit' => Pages\EditImage::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
