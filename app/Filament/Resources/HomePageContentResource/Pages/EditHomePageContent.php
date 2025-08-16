<?php

namespace App\Filament\Resources\HomePageContentResource\Pages;

use App\Filament\Resources\HomePageContentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Forms\Form;

class EditHomePageContent extends EditRecord
{
    protected static string $resource = HomePageContentResource::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                \Filament\Forms\Components\Section::make('Section Information')
                    ->schema([
                        \Filament\Forms\Components\Select::make('section_name')
                            ->label('Section')
                            ->options([
                                'about-us' => 'About Us Section',
                                'statistics' => 'Statistics Section',
                                'cta-section' => 'CTA Section',
                                'story-section' => 'Story Section',
                                'video-section' => 'Video Section',
                            ])
                            ->required()
                            ->rules(['unique:home_page_contents,section_name,' . ($this->record ? $this->record->id : '')])
                            ->searchable()
                            ->default('about-us')
                            ->helperText('Select the homepage section you want to manage'),
                        \Filament\Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true)
                            ->helperText('Enable or disable this section'),
                        \Filament\Forms\Components\TextInput::make('sort_order')
                            ->label('Sort Order')
                            ->numeric()
                            ->default(0)
                            ->helperText('Order in which sections appear (lower numbers first)'),
                    ])->columns(3),

                \Filament\Forms\Components\Section::make('Content')
                    ->schema([
                        \Filament\Forms\Components\TextInput::make('title')
                            ->label('Title')
                            ->maxLength(255)
                            ->helperText('Main title for this section'),
                        \Filament\Forms\Components\TextInput::make('subtitle')
                            ->label('Subtitle')
                            ->maxLength(255)
                            ->helperText('Subtitle or secondary title'),
                        \Filament\Forms\Components\Textarea::make('description')
                            ->label('Description')
                            ->rows(4)
                            ->maxLength(1000)
                            ->helperText('Main description or content for this section'),
                    ])->columns(1),

                \Filament\Forms\Components\Section::make('Call to Action')
                    ->schema([
                        \Filament\Forms\Components\TextInput::make('button_text')
                            ->label('Button Text')
                            ->maxLength(100)
                            ->helperText('Text to display on the button'),
                        \Filament\Forms\Components\TextInput::make('button_url')
                            ->label('Button URL')
                            ->maxLength(255)
                            ->helperText('URL where the button should link to'),
                    ])->columns(2),

                \Filament\Forms\Components\Section::make('Media')
                    ->schema([
                        \Filament\Forms\Components\TextInput::make('video_url')
                            ->label('Video URL')
                            ->maxLength(255)
                            ->helperText('YouTube or other video URL'),
                        \Filament\Forms\Components\FileUpload::make('image')
                            ->label('Section Image')
                            ->image()
                            ->imageEditor()
                            ->directory('homepage-content')
                            ->visibility('public')
                            ->maxSize(5120)
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->helperText('Upload an image for this section. Recommended size: 800x450px (16:9 ratio). If you see "waiting for size", try refreshing the page after upload.'),
                    ])->columns(2),

                \Filament\Forms\Components\Section::make('Statistics (for Statistics Section)')
                    ->schema([
                        \Filament\Forms\Components\TextInput::make('video_url')
                            ->label('Video URL (Optional)')
                            ->maxLength(255)
                            ->helperText('YouTube or other video URL to link to the statistics section image'),
                        \Filament\Forms\Components\Repeater::make('meta_data.statistics')
                            ->label('Statistics')
                            ->schema([
                                \Filament\Forms\Components\TextInput::make('number')
                                    ->label('Number')
                                    ->required()
                                    ->helperText('The statistic number (e.g., 15, 1000)'),
                                \Filament\Forms\Components\TextInput::make('suffix')
                                    ->label('Suffix')
                                    ->helperText('Suffix like "k", "+", etc.'),
                                \Filament\Forms\Components\TextInput::make('label')
                                    ->label('Label')
                                    ->required()
                                    ->helperText('Description of the statistic'),
                                \Filament\Forms\Components\ColorPicker::make('color')
                                    ->label('Color')
                                    ->helperText('Color for the statistic (optional)'),
                            ])
                            ->columns(4)
                            ->defaultItems(0)
                            ->reorderable(false)
                            ->collapsible()
                            ->itemLabel(fn(array $state): string => $state['label'] ?? 'Statistic')
                            ->helperText('Add statistics to display in the statistics section'),
                    ])
                    ->visible(fn(\Filament\Forms\Get $get): bool => $get('section_name') === 'statistics'),

                \Filament\Forms\Components\Section::make('Checklist Items (for About Us Section)')
                    ->schema([
                        \Filament\Forms\Components\Repeater::make('meta_data.checklist_items')
                            ->label('Checklist Items')
                            ->schema([
                                \Filament\Forms\Components\TextInput::make('text')
                                    ->label('Item Text')
                                    ->required()
                                    ->helperText('Text for the checklist item'),
                                \Filament\Forms\Components\ColorPicker::make('color')
                                    ->label('Color')
                                    ->helperText('Color for this item (optional)'),
                            ])
                            ->columns(2)
                            ->defaultItems(0)
                            ->reorderable(false)
                            ->collapsible()
                            ->itemLabel(fn(array $state): string => $state['text'] ?? 'Checklist Item')
                            ->helperText('Add checklist items for the about us section'),
                    ])
                    ->visible(fn(\Filament\Forms\Get $get): bool => $get('section_name') === 'about-us'),

                \Filament\Forms\Components\Section::make('Story Section Details')
                    ->schema([
                        \Filament\Forms\Components\TextInput::make('meta_data.story_person_name')
                            ->label('Person Name')
                            ->maxLength(100)
                            ->helperText('Name of the person in the story (e.g., Adam Cruz)'),
                        \Filament\Forms\Components\Textarea::make('meta_data.story_person_quote')
                            ->label('Person Quote')
                            ->rows(3)
                            ->maxLength(500)
                            ->helperText('Quote or testimonial from the person'),
                        \Filament\Forms\Components\TextInput::make('meta_data.story_years_experience')
                            ->label('Years of Experience')
                            ->numeric()
                            ->default(16)
                            ->helperText('Number of years of experience to display'),
                        \Filament\Forms\Components\FileUpload::make('meta_data.story_person_image')
                            ->label('Person Image')
                            ->image()
                            ->imageEditor()
                            ->directory('story-section')
                            ->visibility('public')
                            ->maxSize(5120)
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->helperText('Image of the person for the story section'),
                    ])
                    ->visible(fn(\Filament\Forms\Get $get): bool => $get('section_name') === 'story-section')
                    ->columns(2),

                \Filament\Forms\Components\Section::make('Additional Data')
                    ->schema([
                        \Filament\Forms\Components\KeyValue::make('meta_data.additional')
                            ->label('Additional Data')
                            ->keyLabel('Key')
                            ->valueLabel('Value')
                            ->helperText('Add any additional key-value pairs for this section'),
                    ])
                    ->collapsible()
                    ->collapsed(),
            ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
