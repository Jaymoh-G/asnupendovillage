<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationGroup = 'Settings & Users';

    protected static ?string $navigationLabel = 'Settings';

    protected static ?int $navigationSort = 100;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Settings')
                    ->tabs([
                        // General Settings
                        Forms\Components\Tabs\Tab::make('General')
                            ->schema([
                                Forms\Components\TextInput::make('site_name')
                                    ->label('Site Name')
                                    ->default(fn() => Setting::get('site_name', ''))
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\Textarea::make('site_description')
                                    ->label('Site Description')
                                    ->default(fn() => Setting::get('site_description', ''))
                                    ->rows(3)
                                    ->maxLength(500),
                            ])
                            ->icon('heroicon-o-home'),

                        // Contact Information
                        Forms\Components\Tabs\Tab::make('Contact')
                            ->schema([
                                Forms\Components\TextInput::make('contact_email')
                                    ->label('Contact Email')
                                    ->default(fn() => Setting::get('contact_email', ''))
                                    ->email()
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('contact_phone')
                                    ->label('Contact Phone')
                                    ->default(fn() => Setting::get('contact_phone', ''))
                                    ->tel()
                                    ->required()
                                    ->maxLength(20),
                                Forms\Components\Textarea::make('contact_address')
                                    ->label('Contact Address')
                                    ->default(fn() => Setting::get('contact_address', ''))
                                    ->rows(3)
                                    ->required()
                                    ->maxLength(500),
                                Forms\Components\TextInput::make('google_map_link')
                                    ->label('Google Map Link')
                                    ->default(fn() => Setting::get('google_map_link', ''))
                                    ->url()
                                    ->maxLength(500),
                            ])
                            ->icon('heroicon-o-phone'),

                        // Social Media
                        Forms\Components\Tabs\Tab::make('Social Media')
                            ->schema([
                                Forms\Components\TextInput::make('social_facebook')
                                    ->label('Facebook URL')
                                    ->default(fn() => Setting::get('social_facebook', ''))
                                    ->url()
                                    ->prefix('https://facebook.com/')
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('social_twitter')
                                    ->label('Twitter URL')
                                    ->default(fn() => Setting::get('social_twitter', ''))
                                    ->url()
                                    ->prefix('https://twitter.com/')
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('social_instagram')
                                    ->label('Instagram URL')
                                    ->default(fn() => Setting::get('social_instagram', ''))
                                    ->url()
                                    ->prefix('https://instagram.com/')
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('social_linkedin')
                                    ->label('LinkedIn URL')
                                    ->default(fn() => Setting::get('social_linkedin', ''))
                                    ->url()
                                    ->prefix('https://linkedin.com/company/')
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('social_youtube')
                                    ->label('YouTube URL')
                                    ->default(fn() => Setting::get('social_youtube', ''))
                                    ->url()
                                    ->prefix('https://youtube.com/@')
                                    ->maxLength(255),
                            ])
                            ->icon('heroicon-o-share'),

                        // Payment Details
                        Forms\Components\Tabs\Tab::make('Payment')
                            ->schema([
                                Forms\Components\TextInput::make('payment_bank_name')
                                    ->label('Bank Name')
                                    ->default(fn() => Setting::get('payment_bank_name', ''))
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('payment_account_name')
                                    ->label('Account Name')
                                    ->default(fn() => Setting::get('payment_account_name', ''))
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('payment_account_number')
                                    ->label('Account Number')
                                    ->default(fn() => Setting::get('payment_account_number', ''))
                                    ->required()
                                    ->maxLength(50),
                                Forms\Components\TextInput::make('payment_branch')
                                    ->label('Branch')
                                    ->default(fn() => Setting::get('payment_branch', ''))
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('payment_swift_code')
                                    ->label('Swift Code')
                                    ->default(fn() => Setting::get('payment_swift_code', ''))
                                    ->required()
                                    ->maxLength(20),
                            ])
                            ->icon('heroicon-o-credit-card'),

                        // Mailchimp Integration
                        Forms\Components\Tabs\Tab::make('Mailchimp')
                            ->schema([
                                Forms\Components\Toggle::make('mailchimp_enabled')
                                    ->label('Enable Mailchimp Integration')
                                    ->default(fn() => Setting::get('mailchimp_enabled', false)),
                                Forms\Components\TextInput::make('mailchimp_api_key')
                                    ->label('API Key')
                                    ->default(fn() => Setting::get('mailchimp_api_key', ''))
                                    ->password()
                                    ->maxLength(255)
                                    ->visible(fn(Forms\Get $get) => $get('mailchimp_enabled')),
                                Forms\Components\TextInput::make('mailchimp_list_id')
                                    ->label('List ID')
                                    ->default(fn() => Setting::get('mailchimp_list_id', ''))
                                    ->maxLength(255)
                                    ->visible(fn(Forms\Get $get) => $get('mailchimp_enabled')),
                            ])
                            ->icon('heroicon-o-envelope'),

                        // Footer Settings
                        Forms\Components\Tabs\Tab::make('Footer')
                            ->schema([
                                Forms\Components\FileUpload::make('footer_logo')
                                    ->label('Footer Logo')
                                    ->default(fn() => Setting::get('footer_logo', ''))
                                    ->image()
                                    ->directory('settings')
                                    ->maxSize(2048),
                                Forms\Components\Textarea::make('footer_about')
                                    ->label('Footer About Text')
                                    ->default(fn() => Setting::get('footer_about', ''))
                                    ->rows(4)
                                    ->maxLength(1000),
                                Forms\Components\Repeater::make('footer_quick_links')
                                    ->label('Quick Links')
                                    ->default(fn() => Setting::get('footer_quick_links', []))
                                    ->schema([
                                        Forms\Components\TextInput::make('title')
                                            ->label('Link Title')
                                            ->required()
                                            ->maxLength(100),
                                        Forms\Components\TextInput::make('url')
                                            ->label('Link URL')
                                            ->required()
                                            ->maxLength(255),
                                    ])
                                    ->defaultItems(4)
                                    ->maxItems(10)
                                    ->columnSpanFull(),
                            ])
                            ->icon('heroicon-o-document-text'),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('key')
                    ->label('Setting Key')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('label')
                    ->label('Setting Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('group')
                    ->label('Category')
                    ->badge()
                    ->color(function (string $state) {
                        switch ($state) {
                            case 'general':
                                return 'primary';
                            case 'contact':
                                return 'success';
                            case 'social':
                                return 'info';
                            case 'payment':
                                return 'warning';
                            case 'mailchimp':
                                return 'danger';
                            case 'footer':
                                return 'gray';
                            default:
                                return 'gray';
                        }
                    }),
                Tables\Columns\TextColumn::make('type')
                    ->label('Type')
                    ->badge()
                    ->color('gray'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('group')
                    ->label('Category')
                    ->options([
                        'general' => 'General',
                        'contact' => 'Contact',
                        'social' => 'Social Media',
                        'payment' => 'Payment',
                        'mailchimp' => 'Mailchimp',
                        'footer' => 'Footer',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListSettings::route('/'),
            'create' => Pages\CreateSetting::route('/create'),
            'edit' => Pages\EditSetting::route('/{record}/edit'),
            'manage' => Pages\ManageSettings::route('/manage'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
