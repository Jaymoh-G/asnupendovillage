<?php

namespace App\Filament\Resources;

use App\Filament\Resources\YouTubeResource\Pages;
use App\Models\YouTube;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class YouTubeResource extends Resource
{
    protected static ?string $model = YouTube::class;

    protected static ?string $navigationIcon = 'heroicon-o-play-circle';
    protected static ?string $navigationGroup = 'Media Centre';
    protected static ?int $navigationSort = 5;

    public static function getNavigationLabel(): string
    {
        return 'YouTube Gallery';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Video Information')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Video Title')
                            ->required()
                            ->maxLength(255)
                            ->live('onBlur')
                            ->afterStateUpdated(function (callable $set) {
                                $set('slug', null);
                            }),

                        Forms\Components\TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->maxLength(255)
                            ->unique('youtube_videos', 'slug', fn($record) => $record)
                            ->helperText('Auto-generated from title, but can be customized'),

                        Forms\Components\TextInput::make('video_id')
                            ->label('YouTube Video ID')
                            ->required()
                            ->maxLength(20)
                            ->helperText('The part after "v=" in YouTube URL (e.g., "dQw4w9WgXcQ")')
                            ->unique('youtube_videos', 'video_id'),

                        Forms\Components\Textarea::make('description')
                            ->label('Description')
                            ->rows(4)
                            ->maxLength(1000),

                        Forms\Components\TextInput::make('duration')
                            ->label('Duration')
                            ->helperText('Video duration (e.g., "10:30", "1:25:15")')
                            ->maxLength(20),

                        Forms\Components\DateTimePicker::make('published_at')
                            ->label('Published Date')
                            ->helperText('When the video was published on YouTube'),

                        Forms\Components\FileUpload::make('thumbnail')
                            ->label('Custom Thumbnail')
                            ->image()
                            ->imageEditor()
                            ->imageCropAspectRatio('16:9')
                            ->imageResizeTargetWidth('1280')
                            ->imageResizeTargetHeight('720')
                            ->directory('youtube-thumbnails')
                            ->visibility('public')
                            ->maxSize(2048)
                            ->helperText('Optional: Upload a custom thumbnail (16:9 ratio recommended)'),

                        Forms\Components\TagsInput::make('tags')
                            ->label('Tags')
                            ->separator(',')
                            ->helperText('Add relevant tags for better organization'),

                        Forms\Components\Toggle::make('is_featured')
                            ->label('Featured Video')
                            ->helperText('Mark this video as featured'),

                        Forms\Components\TextInput::make('sort_order')
                            ->label('Sort Order')
                            ->numeric()
                            ->default(0)
                            ->helperText('Lower numbers appear first'),

                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options([
                                'active' => 'Active',
                                'inactive' => 'Inactive',
                            ])
                            ->default('active')
                            ->required(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail_url')
                    ->label('Thumbnail')
                    ->circular()
                    ->size(60)
                    ->openUrlInNewTab(),

                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable()
                    ->limit(50),

                Tables\Columns\TextColumn::make('video_id')
                    ->label('Video ID')
                    ->copyable()
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('duration')
                    ->label('Duration')
                    ->sortable()
                    ->toggleable(true),

                Tables\Columns\TextColumn::make('published_at')
                    ->label('Published')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(true),

                Tables\Columns\TagsColumn::make('tags')
                    ->label('Tags')
                    ->limit(3),

                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Featured')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\SelectColumn::make('status')
                    ->label('Status')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                    ])
                    ->sortable(),

                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Order')
                    ->numeric()
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
                    ->label('Featured Videos'),

                Tables\Filters\Filter::make('published_at')
                    ->form([
                        Forms\Components\DatePicker::make('published_from'),
                        Forms\Components\DatePicker::make('published_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['published_from'],
                                fn(Builder $query, $date): Builder => $query->whereDate('published_at', '>=', $date),
                            )
                            ->when(
                                $data['published_until'],
                                fn(Builder $query, $date): Builder => $query->whereDate('published_at', '<=', $date),
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\Action::make('view_youtube')
                    ->label('View on YouTube')
                    ->icon('heroicon-o-arrow-top-right-on-square')
                    ->url(fn(YouTube $record): string => $record->video_url)
                    ->openUrlInNewTab(),

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
            'index' => Pages\ListYouTubeVideos::route('/'),
            'create' => Pages\CreateYouTubeVideo::route('/create'),
            'edit' => Pages\EditYouTubeVideo::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
