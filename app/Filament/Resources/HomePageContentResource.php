<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HomePageContentResource\Pages;
use App\Models\HomePageContent;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\KeyValue;

class HomePageContentResource extends Resource
{
    protected static ?string $model = HomePageContent::class;

    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static ?string $navigationGroup = 'Content Management';

    protected static ?string $navigationLabel = 'Homepage Content';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Section Information')
                    ->schema([
                        Forms\Components\Select::make('section_name')
                            ->label('Section')
                            ->options([
                                'about-us' => 'About Us Section',
                                'statistics' => 'Statistics Section',
                                'cta-section' => 'CTA Section',
                                'story-section' => 'Story Section',
                                'video-section' => 'Video Section',
                            ])
                            ->required()
                            ->unique('home_page_contents', 'section_name')
                            ->searchable()
                            ->helperText('Select the homepage section you want to manage'),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true)
                            ->helperText('Enable or disable this section'),
                        Forms\Components\TextInput::make('sort_order')
                            ->label('Sort Order')
                            ->numeric()
                            ->default(0)
                            ->helperText('Order in which sections appear (lower numbers first)'),
                    ])->columns(3),

                Forms\Components\Section::make('Content')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Title')
                            ->maxLength(255)
                            ->helperText('Main title for this section'),
                        Forms\Components\TextInput::make('subtitle')
                            ->label('Subtitle')
                            ->maxLength(255)
                            ->helperText('Subtitle or secondary title'),
                        Forms\Components\Textarea::make('description')
                            ->label('Description')
                            ->rows(4)
                            ->maxLength(1000)
                            ->helperText('Main description or content for this section'),
                    ])->columns(1),

                Forms\Components\Section::make('Call to Action')
                    ->schema([
                        Forms\Components\TextInput::make('button_text')
                            ->label('Button Text')
                            ->maxLength(100)
                            ->helperText('Text to display on the button'),
                        Forms\Components\TextInput::make('button_url')
                            ->label('Button URL')
                            ->maxLength(255)
                            ->helperText('URL where the button should link to'),
                    ])->columns(2),

                Forms\Components\Section::make('Media')
                    ->schema([
                        Forms\Components\TextInput::make('video_url')
                            ->label('Video URL')
                            ->maxLength(255)
                            ->helperText('YouTube or other video URL'),
                        Forms\Components\FileUpload::make('image')
                            ->label('Section Image')
                            ->image()
                            ->imageEditor()
                            ->directory('homepage-content')
                            ->visibility('public')
                            ->helperText('Upload an image for this section'),
                    ])->columns(2),

                Forms\Components\Section::make('Statistics (for Statistics Section)')
                    ->schema([
                        Repeater::make('meta_data.statistics')
                            ->label('Statistics')
                            ->schema([
                                Forms\Components\TextInput::make('number')
                                    ->label('Number')
                                    ->required()
                                    ->helperText('The statistic number (e.g., 15, 1000)'),
                                Forms\Components\TextInput::make('suffix')
                                    ->label('Suffix')
                                    ->helperText('Suffix like "k", "+", etc.'),
                                Forms\Components\TextInput::make('label')
                                    ->label('Label')
                                    ->required()
                                    ->helperText('Description of the statistic'),
                                Forms\Components\ColorPicker::make('color')
                                    ->label('Color')
                                    ->helperText('Color for the statistic (optional)'),
                            ])
                            ->columns(4)
                            ->defaultItems(0)
                            ->reorderable(false)
                            ->collapsible()
                            ->itemLabel(fn(array $state): ?string => $state['label'] ?? null)
                            ->helperText('Add statistics to display in the statistics section'),
                    ])
                    ->visible(fn(Forms\Get $get): bool => $get('section_name') === 'statistics'),

                Forms\Components\Section::make('Checklist Items (for About Us Section)')
                    ->schema([
                        Repeater::make('meta_data.checklist_items')
                            ->label('Checklist Items')
                            ->schema([
                                Forms\Components\TextInput::make('text')
                                    ->label('Item Text')
                                    ->required()
                                    ->helperText('Text for the checklist item'),
                                Forms\Components\ColorPicker::make('color')
                                    ->label('Color')
                                    ->helperText('Color for this item (optional)'),
                            ])
                            ->columns(2)
                            ->defaultItems(0)
                            ->reorderable(false)
                            ->collapsible()
                            ->itemLabel(fn(array $state): ?string => $state['text'] ?? null)
                            ->helperText('Add checklist items for the about us section'),
                    ])
                    ->visible(fn(Forms\Get $get): bool => $get('section_name') === 'about-us'),

                Forms\Components\Section::make('Additional Data')
                    ->schema([
                        KeyValue::make('meta_data.additional')
                            ->label('Additional Data')
                            ->keyLabel('Key')
                            ->valueLabel('Value')
                            ->helperText('Add any additional key-value pairs for this section'),
                    ])
                    ->collapsible()
                    ->collapsed(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('section_name')
                    ->label('Section')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
                    ->limit(50)
                    ->searchable(),
                Tables\Columns\TextColumn::make('subtitle')
                    ->label('Subtitle')
                    ->limit(50)
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Sort Order')
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active Status'),
                Tables\Filters\SelectFilter::make('section_name')
                    ->label('Section')
                    ->options([
                        'about-us' => 'About Us Section',
                        'statistics' => 'Statistics Section',
                        'cta-section' => 'CTA Section',
                        'story-section' => 'Story Section',
                        'video-section' => 'Video Section',
                    ]),
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
            'index' => Pages\ListHomePageContents::route('/'),
            'create' => Pages\CreateHomePageContent::route('/create'),
            'edit' => Pages\EditHomePageContent::route('/{record}/edit'),
        ];
    }
}
