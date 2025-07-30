<?php

namespace App\Filament\Resources\StaticPageResource\Pages;

use App\Filament\Resources\StaticPageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Forms\Form;

class EditStaticPage extends EditRecord
{
    protected static string $resource = StaticPageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                \Filament\Forms\Components\Section::make('Page Information')
                    ->schema([
                        \Filament\Forms\Components\Select::make('page_name')
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
                            ->rules(['unique:static_pages,page_name,' . $this->record->id])
                            ->searchable()
                            ->helperText('Select the page you want to manage'),
                        \Filament\Forms\Components\TextInput::make('title')
                            ->label('Page Title')
                            ->maxLength(255)
                            ->helperText('Custom title for the page. Leave empty to use default.'),
                        \Filament\Forms\Components\Textarea::make('excerpt')
                            ->label('Page Excerpt')
                            ->rows(3)
                            ->maxLength(500)
                            ->helperText('Short description or summary of the page content'),
                        \Filament\Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true)
                            ->helperText('Enable or disable this page'),
                        \Filament\Forms\Components\TextInput::make('sort_order')
                            ->label('Sort Order')
                            ->numeric()
                            ->default(0)
                            ->helperText('Order in which pages appear (lower numbers first)'),
                    ])->columns(2),

                \Filament\Forms\Components\Section::make('Page Content')
                    ->schema([
                        \Filament\Forms\Components\RichEditor::make('content')
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

                \Filament\Forms\Components\Section::make('Featured Image')
                    ->schema([
                        \Filament\Forms\Components\FileUpload::make('featured_image')
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

                \Filament\Forms\Components\Section::make('SEO Settings')
                    ->schema([
                        \Filament\Forms\Components\TextInput::make('meta_title')
                            ->label('Meta Title')
                            ->maxLength(60)
                            ->helperText('SEO title for search engines. Leave empty to use page title.'),
                        \Filament\Forms\Components\Textarea::make('meta_description')
                            ->label('Meta Description')
                            ->rows(3)
                            ->maxLength(160)
                            ->helperText('SEO description for search engines. Recommended: 150-160 characters.'),
                        \Filament\Forms\Components\TextInput::make('meta_keywords')
                            ->label('Meta Keywords')
                            ->maxLength(255)
                            ->helperText('Comma-separated keywords for SEO'),
                    ])->columns(2),
            ]);
    }
}
