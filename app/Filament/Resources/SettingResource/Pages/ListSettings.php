<?php

namespace App\Filament\Resources\SettingResource\Pages;

use App\Filament\Resources\SettingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSettings extends ListRecords
{
    protected static string $resource = SettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('manage')
                ->label('Manage Settings')
                ->url(route('filament.admin.resources.settings.manage'))
                ->icon('heroicon-o-cog-6-tooth')
                ->color('primary'),
            Actions\CreateAction::make(),
        ];
    }
}
