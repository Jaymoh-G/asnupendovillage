<?php

namespace App\Filament\Resources\SettingResource\Pages;

use App\Filament\Resources\SettingResource;
use App\Models\Setting;
use Filament\Actions;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Pages\Page;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class ManageSettings extends Page
{
    protected static string $resource = SettingResource::class;

    protected static string $view = 'filament.resources.setting-resource.pages.manage-settings';

    protected static ?string $title = 'Manage Settings';

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    // Add properties for all form fields
    public ?string $site_name = null;
    public ?string $site_description = null;
    public ?string $contact_email = null;
    public ?string $contact_phone = null;
    public ?string $contact_address = null;
    public ?string $google_map_link = null;
    public ?string $social_facebook = null;
    public ?string $social_twitter = null;
    public ?string $social_instagram = null;
    public ?string $social_linkedin = null;
    public ?string $social_youtube = null;
    public ?string $payment_bank_name = null;
    public ?string $payment_account_name = null;
    public ?string $payment_account_number = null;
    public ?string $payment_branch = null;
    public ?string $payment_swift_code = null;
    public bool $mailchimp_enabled = false;
    public ?string $mailchimp_api_key = null;
    public ?string $mailchimp_list_id = null;
    public $header_logo = null; // FileUpload returns array or string
    public $footer_logo = null; // FileUpload returns array or string
    public ?string $footer_about = null;
    public $footer_quick_links = []; // Repeater returns array

    public function mount(): void
    {
        // Load all settings data
        $formData = $this->getFormData();

        // Fill the form with existing data
        $this->form->fill($formData);

        // Also set the properties
        $this->site_name = $formData['site_name'] ?? null;
        $this->site_description = $formData['site_description'] ?? null;
        $this->contact_email = $formData['contact_email'] ?? null;
        $this->contact_phone = $formData['contact_phone'] ?? null;
        $this->contact_address = $formData['contact_address'] ?? null;
        $this->google_map_link = $formData['google_map_link'] ?? null;
        $this->social_facebook = $formData['social_facebook'] ?? null;
        $this->social_twitter = $formData['social_twitter'] ?? null;
        $this->social_instagram = $formData['social_instagram'] ?? null;
        $this->social_linkedin = $formData['social_linkedin'] ?? null;
        $this->social_youtube = $formData['social_youtube'] ?? null;
        $this->payment_bank_name = $formData['payment_bank_name'] ?? null;
        $this->payment_account_name = $formData['payment_account_name'] ?? null;
        $this->payment_account_number = $formData['payment_account_number'] ?? null;
        $this->payment_branch = $formData['payment_branch'] ?? null;
        $this->payment_swift_code = $formData['payment_swift_code'] ?? null;
        $this->mailchimp_enabled = $formData['mailchimp_enabled'] ?? false;
        $this->mailchimp_api_key = $formData['mailchimp_api_key'] ?? null;
        $this->mailchimp_list_id = $formData['mailchimp_list_id'] ?? null;
        $this->header_logo = $formData['header_logo'] ?? null;
        $this->footer_logo = $formData['footer_logo'] ?? null;
        $this->footer_about = $formData['footer_about'] ?? null;
        $this->footer_quick_links = $formData['footer_quick_links'] ?? [];
    }

    public function form(Form $form): Form
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
                                    ->required()
                                    ->maxLength(255)
                                    ->default(Setting::get('site_name', '')),
                                Forms\Components\Textarea::make('site_description')
                                    ->label('Site Description')
                                    ->rows(3)
                                    ->maxLength(500)
                                    ->default(Setting::get('site_description', '')),
                                Forms\Components\FileUpload::make('header_logo')
                                    ->label('Header Logo')
                                    ->image()
                                    ->directory('settings')
                                    ->maxSize(2048)
                                    ->default(Setting::get('header_logo', '')),
                            ])
                            ->icon('heroicon-o-home'),

                        // Contact Information
                        Forms\Components\Tabs\Tab::make('Contact')
                            ->schema([
                                Forms\Components\TextInput::make('contact_email')
                                    ->label('Contact Email')
                                    ->email()
                                    ->required()
                                    ->maxLength(255)
                                    ->default(Setting::get('contact_email', '')),
                                Forms\Components\TextInput::make('contact_phone')
                                    ->label('Contact Phone')
                                    ->tel()
                                    ->required()
                                    ->maxLength(20)
                                    ->default(Setting::get('contact_phone', '')),
                                Forms\Components\Textarea::make('contact_address')
                                    ->label('Contact Address')
                                    ->rows(3)
                                    ->required()
                                    ->maxLength(500)
                                    ->default(Setting::get('contact_address', '')),
                                Forms\Components\TextInput::make('google_map_link')
                                    ->label('Google Map Link')
                                    ->url()
                                    ->maxLength(500)
                                    ->default(Setting::get('google_map_link', '')),
                            ])
                            ->icon('heroicon-o-phone'),

                        // Social Media
                        Forms\Components\Tabs\Tab::make('Social Media')
                            ->schema([
                                Forms\Components\TextInput::make('social_facebook')
                                    ->label('Facebook URL')
                                    ->url()
                                    ->prefix('https://facebook.com/')
                                    ->maxLength(255)
                                    ->default(Setting::get('social_facebook', '')),
                                Forms\Components\TextInput::make('social_twitter')
                                    ->label('Twitter URL')
                                    ->url()
                                    ->prefix('https://twitter.com/')
                                    ->maxLength(255)
                                    ->default(Setting::get('social_twitter', '')),
                                Forms\Components\TextInput::make('social_instagram')
                                    ->label('Instagram URL')
                                    ->url()
                                    ->prefix('https://instagram.com/')
                                    ->maxLength(255)
                                    ->default(Setting::get('social_instagram', '')),
                                Forms\Components\TextInput::make('social_linkedin')
                                    ->label('LinkedIn URL')
                                    ->url()
                                    ->prefix('https://linkedin.com/company/')
                                    ->maxLength(255)
                                    ->default(Setting::get('social_linkedin', '')),
                                Forms\Components\TextInput::make('social_youtube')
                                    ->label('YouTube URL')
                                    ->url()
                                    ->prefix('https://youtube.com/@')
                                    ->maxLength(255)
                                    ->default(Setting::get('social_youtube', '')),
                            ])
                            ->icon('heroicon-o-share'),

                        // Payment Details
                        Forms\Components\Tabs\Tab::make('Payment')
                            ->schema([
                                Forms\Components\TextInput::make('payment_bank_name')
                                    ->label('Bank Name')
                                    ->required()
                                    ->maxLength(255)
                                    ->default(Setting::get('payment_bank_name', '')),
                                Forms\Components\TextInput::make('payment_account_name')
                                    ->label('Account Name')
                                    ->required()
                                    ->maxLength(255)
                                    ->default(Setting::get('payment_account_name', '')),
                                Forms\Components\TextInput::make('payment_account_number')
                                    ->label('Account Number')
                                    ->required()
                                    ->maxLength(50)
                                    ->default(Setting::get('payment_account_number', '')),
                                Forms\Components\TextInput::make('payment_branch')
                                    ->label('Branch')
                                    ->required()
                                    ->maxLength(255)
                                    ->default(Setting::get('payment_branch', '')),
                                Forms\Components\TextInput::make('payment_swift_code')
                                    ->label('Swift Code')
                                    ->required()
                                    ->maxLength(20)
                                    ->default(Setting::get('payment_swift_code', '')),
                            ])
                            ->icon('heroicon-o-credit-card'),

                        // Mailchimp Integration
                        Forms\Components\Tabs\Tab::make('Mailchimp')
                            ->schema([
                                Forms\Components\Toggle::make('mailchimp_enabled')
                                    ->label('Enable Mailchimp Integration')
                                    ->default(Setting::get('mailchimp_enabled', false)),
                                Forms\Components\TextInput::make('mailchimp_api_key')
                                    ->label('API Key')
                                    ->password()
                                    ->maxLength(255)
                                    ->default(Setting::get('mailchimp_api_key', ''))
                                    ->visible(fn(Forms\Get $get) => $get('mailchimp_enabled')),
                                Forms\Components\TextInput::make('mailchimp_list_id')
                                    ->label('List ID')
                                    ->maxLength(255)
                                    ->default(Setting::get('mailchimp_list_id', ''))
                                    ->visible(fn(Forms\Get $get) => $get('mailchimp_enabled')),
                            ])
                            ->icon('heroicon-o-envelope'),

                        // Footer Settings
                        Forms\Components\Tabs\Tab::make('Footer')
                            ->schema([
                                Forms\Components\FileUpload::make('footer_logo')
                                    ->label('Footer Logo')
                                    ->image()
                                    ->directory('settings')
                                    ->maxSize(2048)
                                    ->default(Setting::get('footer_logo', '')),
                                Forms\Components\Textarea::make('footer_about')
                                    ->label('Footer About Text')
                                    ->rows(4)
                                    ->maxLength(1000)
                                    ->default(Setting::get('footer_about', '')),
                                Forms\Components\Repeater::make('footer_quick_links')
                                    ->label('Quick Links')
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

    public function save(): void
    {
        $data = $this->form->getState();

        foreach ($data as $key => $value) {
            // Handle special cases for JSON fields
            if ($key === 'footer_quick_links') {
                // Ensure it's properly formatted as JSON
                if (is_array($value)) {
                    $value = json_encode($value);
                }
            }

            // Handle FileUpload fields
            if ($key === 'footer_logo' && is_array($value)) {
                // FileUpload returns an array, we need to get the first file path
                $value = $value[0] ?? null;
            }

            if ($key === 'header_logo' && is_array($value)) {
                // FileUpload returns an array, we need to get the first file path
                $value = $value[0] ?? null;
            }

            Setting::set($key, $value);
        }

        // Clear cache
        Setting::clearCache();

        Notification::make()
            ->title('Settings saved successfully')
            ->success()
            ->send();
    }

    private function getFormData(): array
    {
        // Get footer quick links and ensure it's an array
        $footerQuickLinks = Setting::get('footer_quick_links', []);
        if (is_string($footerQuickLinks)) {
            $decoded = json_decode($footerQuickLinks, true);
            $footerQuickLinks = is_array($decoded) ? $decoded : [];
        }
        if (!is_array($footerQuickLinks)) {
            $footerQuickLinks = [];
        }

        // Get footer logo and ensure it's properly formatted
        $footerLogo = Setting::get('footer_logo', '');
        if (is_string($footerLogo) && !empty($footerLogo)) {
            $footerLogo = [$footerLogo]; // FileUpload expects array
        } elseif (empty($footerLogo)) {
            $footerLogo = null;
        }

        // Get header logo and ensure it's properly formatted
        $headerLogo = Setting::get('header_logo', '');
        if (is_string($headerLogo) && !empty($headerLogo)) {
            $headerLogo = [$headerLogo]; // FileUpload expects array
        } elseif (empty($headerLogo)) {
            $headerLogo = null;
        }

        return [
            'site_name' => Setting::get('site_name', ''),
            'site_description' => Setting::get('site_description', ''),
            'contact_email' => Setting::get('contact_email', ''),
            'contact_phone' => Setting::get('contact_phone', ''),
            'contact_address' => Setting::get('contact_address', ''),
            'google_map_link' => Setting::get('google_map_link', ''),
            'social_facebook' => Setting::get('social_facebook', ''),
            'social_twitter' => Setting::get('social_twitter', ''),
            'social_instagram' => Setting::get('social_instagram', ''),
            'social_linkedin' => Setting::get('social_linkedin', ''),
            'social_youtube' => Setting::get('social_youtube', ''),
            'payment_bank_name' => Setting::get('payment_bank_name', ''),
            'payment_account_name' => Setting::get('payment_account_name', ''),
            'payment_account_number' => Setting::get('payment_account_number', ''),
            'payment_branch' => Setting::get('payment_branch', ''),
            'payment_swift_code' => Setting::get('payment_swift_code', ''),
            'mailchimp_enabled' => Setting::get('mailchimp_enabled', false),
            'mailchimp_api_key' => Setting::get('mailchimp_api_key', ''),
            'mailchimp_list_id' => Setting::get('mailchimp_list_id', ''),
            'header_logo' => $headerLogo,
            'footer_logo' => $footerLogo,
            'footer_about' => Setting::get('footer_about', ''),
            'footer_quick_links' => $footerQuickLinks,
        ];
    }

    protected function getCachedFormActions(): array
    {
        return [
            \Filament\Actions\Action::make('save')
                ->label('Save Settings')
                ->submit('save')
                ->color('primary'),
        ];
    }

    protected function hasFullWidthFormActions(): bool
    {
        return false;
    }
}
