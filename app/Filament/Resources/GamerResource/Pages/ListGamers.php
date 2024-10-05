<?php

namespace App\Filament\Resources\GamerResource\Pages;

use App\Filament\Resources\GamerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGamers extends ListRecords
{
    protected static string $resource = GamerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
