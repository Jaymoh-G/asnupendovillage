<?php

namespace App\Filament\Resources\PageBannerResource\Pages;

use App\Filament\Resources\PageBannerResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPageBanner extends ViewRecord
{
    protected static string $resource = PageBannerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
