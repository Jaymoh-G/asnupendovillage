<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AlbumResource\Pages;
use App\Models\Album;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Illuminate\Contracts\View\View;

class AlbumResource extends Resource
{
    protected static ?string $model = Album::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Media Centre';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Album Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Album Name')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                                if ($operation === 'create') {
                                    $set('slug', Str::slug($state));
                                }
                            }),

                        Forms\Components\TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),



                        Forms\Components\Textarea::make('description')
                            ->label('Description')
                            ->rows(3)
                            ->maxLength(1000),

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
                    ])->columns(2),

                Forms\Components\Section::make('Cover Image')
                    ->schema([
                        Forms\Components\FileUpload::make('cover_image')
                            ->label('Cover Image')
                            ->image()
                            ->imageEditor()
                            ->imageCropAspectRatio('16:9')
                            ->imageResizeTargetWidth('800')
                            ->imageResizeTargetHeight('450')
                            ->directory('albums')
                            ->visibility('public')
                            ->maxSize(5120),
                    ]),

                Forms\Components\Section::make('Album Images')
                    ->schema([
                        Forms\Components\View::make('filament.resources.album-resource.components.existing-images')
                            ->label('Existing Images'),

                        Forms\Components\FileUpload::make('images')
                            ->label('Add New Images')
                            ->multiple()
                            ->image()
                            ->imageEditor()
                            ->imageCropAspectRatio('16:9')
                            ->imageResizeTargetWidth('1200')
                            ->imageResizeTargetHeight('800')
                            ->directory('albums/images')
                            ->visibility('public')
                            ->maxSize(5120)
                            ->helperText('Upload multiple images to add to this album. You can select multiple files at once.')
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/gif']),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('cover_image_url')
                    ->label('Cover')
                    ->circular()
                    ->size(50)
                    ->url(fn($record) => $record->cover_image_url, true)
                    ->openUrlInNewTab(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Album Name')
                    ->searchable()
                    ->sortable(),



                Tables\Columns\TextColumn::make('images_count')
                    ->label('Images')
                    ->counts('images')
                    ->sortable(),

                Tables\Columns\TextColumn::make('album_preview')
                    ->label('Album Preview')
                    ->html()
                    ->getStateUsing(function (Album $record) {
                        $images = $record->images()->take(3)->get();
                        $totalImages = $record->images()->count();

                        if ($images->isEmpty()) {
                            return '<span class="text-gray-400">No images</span>';
                        }

                        $html = '<div class="flex space-x-1" title="' . $totalImages . ' images in album">';
                        foreach ($images as $image) {
                            $html .= '<div class="w-12 h-12 rounded overflow-hidden border border-gray-200">';
                            $html .= '<img src="' . asset('storage/' . $image->path) . '" ';
                            $html .= 'alt="' . htmlspecialchars($image->original_name) . '" ';
                            $html .= 'class="w-full h-full object-cover" ';
                            $html .= 'onerror="this.style.display=\'none\'">';
                            $html .= '</div>';
                        }

                        // Show indicator if there are more than 3 images
                        if ($totalImages > 3) {
                            $html .= '<div class="w-12 h-12 rounded bg-gray-100 border border-gray-200 flex items-center justify-center text-xs text-gray-500 font-medium">';
                            $html .= '+' . ($totalImages - 3);
                            $html .= '</div>';
                        }

                        $html .= '</div>';

                        return $html;
                    }),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'success' => 'active',
                        'danger' => 'inactive',
                    ]),

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
            ])
            ->actions([
                Tables\Actions\Action::make('view_images')
                    ->label('View Images')
                    ->icon('heroicon-o-photo')
                    ->modalHeading(fn(Album $record): string => "Images in {$record->name}")
                    ->modalContent(fn(Album $record): View => view('filament.resources.album-resource.modals.view-images', ['album' => $record]))
                    ->modalWidth('7xl'),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order');
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
            'index' => Pages\ListAlbums::route('/'),
            'create' => Pages\CreateAlbum::route('/create'),
            'edit' => Pages\EditAlbum::route('/{record}/edit'),
        ];
    }
}
