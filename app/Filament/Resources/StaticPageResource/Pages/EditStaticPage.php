<?php

namespace App\Filament\Resources\StaticPageResource\Pages;

use App\Filament\Resources\StaticPageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Forms\Form;
use Filament\Forms\Get;

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
                        \Filament\Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true)
                            ->helperText('Enable or disable this page'),
                        \Filament\Forms\Components\TextInput::make('sort_order')
                            ->label('Sort Order')
                            ->numeric()
                            ->default(0)
                            ->helperText('Order in which pages appear (lower numbers first)'),
                    ])->columns(2)
                    ->collapsible()
                    ->collapsed(false),



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
                    ])
                    ->collapsible()
                    ->collapsed(false),

                \Filament\Forms\Components\Section::make('Additional Images')
                    ->schema([
                        \Filament\Forms\Components\FileUpload::make('images')
                            ->label('Page Images')
                            ->multiple()
                            ->image()
                            ->imageEditor()
                            ->imageCropAspectRatio('16:9')
                            ->imageResizeTargetWidth('800')
                            ->imageResizeTargetHeight('450')
                            ->directory('static-pages/gallery')
                            ->visibility('public')
                            ->maxSize(5120)
                            ->helperText('Upload additional images for the page. These will be displayed in a gallery format.')
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->columnSpanFull(),
                    ])
                    ->collapsible()
                    ->collapsed(false),

                \Filament\Forms\Components\Section::make('Content Section 1')
                    ->schema([
                        \Filament\Forms\Components\TextInput::make('section1_title')
                            ->label('Section 1 Title')
                            ->maxLength(255)
                            ->helperText('Title for the first content section'),
                        \Filament\Forms\Components\RichEditor::make('section1_content')
                            ->label('Section 1 Content')
                            ->toolbarButtons([
                                'bold',
                                'italic',
                                'underline',
                                'link',
                                'bulletList',
                                'orderedList',
                                'h3',
                                'h4',
                                'blockquote',
                                'undo',
                                'redo',
                            ])
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('static-pages/section1')
                            ->fileAttachmentsVisibility('public')
                            ->columnSpanFull()
                            ->helperText('Content for the first section'),
                        \Filament\Forms\Components\FileUpload::make('section1_images')
                            ->label('Section 1 Images')
                            ->multiple()
                            ->image()
                            ->imageEditor()
                            ->imageCropAspectRatio(fn(Get $get) => $get('page_name') === 'founder' ? '3:4' : '16:9')
                            ->imageResizeTargetWidth(fn(Get $get) => $get('page_name') === 'founder' ? '900' : '800')
                            ->imageResizeTargetHeight(fn(Get $get) => $get('page_name') === 'founder' ? '1200' : '450')
                            ->directory('static-pages/section1')
                            ->visibility('public')
                            ->maxSize(5120)
                            ->helperText('Images for section 1')
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->columnSpanFull(),
                    ])
                    ->collapsible()
                    ->collapsed(false),

                \Filament\Forms\Components\Section::make('Content Section 2')
                    ->schema([
                        \Filament\Forms\Components\TextInput::make('section2_title')
                            ->label('Section 2 Title')
                            ->maxLength(255)
                            ->helperText('Title for the second content section'),
                        \Filament\Forms\Components\RichEditor::make('section2_content')
                            ->label('Section 2 Content')
                            ->toolbarButtons([
                                'bold',
                                'italic',
                                'underline',
                                'link',
                                'bulletList',
                                'orderedList',
                                'h3',
                                'h4',
                                'blockquote',
                                'undo',
                                'redo',
                            ])
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('static-pages/section2')
                            ->fileAttachmentsVisibility('public')
                            ->columnSpanFull()
                            ->helperText('Content for the second section'),
                        \Filament\Forms\Components\FileUpload::make('section2_images')
                            ->label('Section 2 Images')
                            ->multiple()
                            ->image()
                            ->imageEditor()
                            ->imageCropAspectRatio(fn(Get $get) => $get('page_name') === 'founder' ? '3:4' : '16:9')
                            ->imageResizeTargetWidth(fn(Get $get) => $get('page_name') === 'founder' ? '900' : '800')
                            ->imageResizeTargetHeight(fn(Get $get) => $get('page_name') === 'founder' ? '1200' : '450')
                            ->directory('static-pages/section2')
                            ->visibility('public')
                            ->maxSize(5120)
                            ->helperText('Images for section 2')
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->columnSpanFull(),
                    ])
                    ->collapsible()
                    ->collapsed(false),

                \Filament\Forms\Components\Section::make('Content Section 3')
                    ->schema([
                        \Filament\Forms\Components\TextInput::make('section3_title')
                            ->label('Section 3 Title')
                            ->maxLength(255)
                            ->helperText('Title for the third content section'),
                        \Filament\Forms\Components\RichEditor::make('section3_content')
                            ->label('Section 3 Content')
                            ->toolbarButtons([
                                'bold',
                                'italic',
                                'underline',
                                'link',
                                'bulletList',
                                'orderedList',
                                'h3',
                                'h4',
                                'blockquote',
                                'undo',
                                'redo',
                            ])
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('static-pages/section3')
                            ->fileAttachmentsVisibility('public')
                            ->columnSpanFull()
                            ->helperText('Content for the third section'),
                        \Filament\Forms\Components\FileUpload::make('section3_images')
                            ->label('Section 3 Images')
                            ->multiple()
                            ->image()
                            ->imageEditor()
                            ->imageCropAspectRatio('16:9')
                            ->imageResizeTargetWidth('800')
                            ->imageResizeTargetHeight('450')
                            ->directory('static-pages/section3')
                            ->visibility('public')
                            ->maxSize(5120)
                            ->helperText('Images for section 3')
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->columnSpanFull(),
                    ])
                    ->collapsible()
                    ->collapsed(false),

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
                    ])->columns(2)
                    ->collapsible()
                    ->collapsed(false),
            ]);
    }
}
