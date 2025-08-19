<?php

namespace App\Providers\Filament;

use App\Models\User;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
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
            ->default() // makes this the default panel
            ->id('admin')
            ->path('admin')
            ->login() // enables Filament login page
            ->authGuard('web') // use the default Laravel "web" guard
            ->authPages([])    // explicitly register Filament's built-in auth pages
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
            ->discoverResources(app_path('Filament/Admin/Resources'), 'App\\Filament\\Admin\\Resources')
            ->discoverPages(app_path('Filament/Admin/Pages'), 'App\\Filament\\Admin\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(app_path('Filament/Admin/Widgets'), 'App\\Filament\\Admin\\Widgets')
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

    public function canAccessPanel(User $user): bool
    {
        // ✅ Allow only Admins, Super Admins, or users with explicit permission
        return $user->hasAnyRole(['Admin', 'Super Admin'])
            || $user->can('access admin panel');
    }
}
