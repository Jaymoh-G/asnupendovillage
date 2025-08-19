<?php

namespace App\Providers\Filament;

use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Http\Middleware\Authenticate;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Filament\Http\Middleware\AuthenticateSession;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        // Simple local debugging - only runs in local environment
        if (app()->environment('local')) {
            Log::info('AdminPanelProvider initialized - checking auth status');

            if (Auth::check()) {
                $user = Auth::user();
                Log::info('User authenticated: ' . $user->email . ' (ID: ' . $user->id . ')');
            } else {
                Log::info('No user authenticated during panel init');
            }
        }

        return $panel
            ->default() // makes this the default panel
            ->id('admin')
            ->path('admin')
            ->login() // enables Filament login page
            ->authGuard('web') // use the default Laravel "web" guard
            ->colors([
                'primary' => '#43b738',
                'gray'    => '#202020',
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
                \App\Filament\Resources\RoleResource::class,
                \App\Filament\Resources\PermissionResource::class,
            ])
            ->navigationGroups([
                'Main Content',
                'Media Centre',
                'Settings & Users',
            ])
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
                \App\Http\Middleware\EnsureUserIsAdmin::class,
            ]);
    }

    // In Filament 3.x, panel access control is handled via middleware or policies
    // You can create a custom middleware to check user roles if needed
}
