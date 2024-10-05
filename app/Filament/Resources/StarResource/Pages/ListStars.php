<?php

namespace App\Filament\Resources\StarResource\Pages;

use App\Filament\Resources\StarResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStars extends ListRecords
{
    protected static string $resource = StarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
