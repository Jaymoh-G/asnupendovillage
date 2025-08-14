<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => '#43b738',
                'gray' => '#202020',
            ])
            ->darkMode(false)
            ->resources([
                // Main Content
                \App\Filament\Resources\HomePageContentResource::class,
                \App\Filament\Resources\HomeSliderResource::class,
                \App\Filament\Resources\PageBannerResource::class,
                \App\Filament\Resources\StaticPageResource::class,
                \App\Filament\Resources\FacilityResource::class,
                \App\Filament\Resources\ProgramResource::class,
                \App\Filament\Resources\CoreValueResource::class,
                \App\Filament\Resources\TeamResource::class,
                \App\Filament\Resources\ProjectResource::class,
                \App\Filament\Resources\TestimonialResource::class,
                \App\Filament\Resources\StatisticResource::class,
                \App\Filament\Resources\DonationResource::class,

                // Media Centre
                \App\Filament\Resources\YouTubeResource::class,
                \App\Filament\Resources\AlbumResource::class,
                \App\Filament\Resources\ImageResource::class,
                \App\Filament\Resources\DownloadResource::class,
                \App\Filament\Resources\NewsResource::class,
                \App\Filament\Resources\CareerResource::class,
                \App\Filament\Resources\EventsResource::class,

                // Settings & Users
                \App\Filament\Resources\SettingResource::class,
                \App\Filament\Resources\UserResource::class,
            ])
            ->navigationGroups([
                'Main Content',
                'Media Centre',
                'Settings & Users',
            ])
            ->discoverPages(app_path('Filament/Pages'), 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->widgets([
                \App\Filament\Widgets\DashboardStats::class,
                \App\Filament\Widgets\DonationStats::class,
                \App\Filament\Widgets\SettingsOverview::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
