<?php

return [

    'auth' => [
        'guard' => env('FILAMENT_AUTH_GUARD', 'web'),
    ],

    'broadcasting' => [
        // ...
    ],

    'default_filesystem_disk' => env('FILAMENT_FILESYSTEM_DISK', 'public'),

    'assets_path' => null,

    'cache_path' => base_path('bootstrap/cache/filament'),

    'livewire_loading_delay' => 'default',

    'system_route_prefix' => 'filament',

    /*
    |--------------------------------------------------------------------------
    | Panels
    |--------------------------------------------------------------------------
    */
    'panels' => [
        App\Providers\Filament\AdminPanelProvider::class,
    ],
];
