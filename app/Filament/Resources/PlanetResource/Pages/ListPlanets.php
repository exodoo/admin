<?php

namespace App\Filament\Resources\PlanetResource\Pages;

use App\Filament\Resources\PlanetResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPlanets extends ListRecords
{
    protected static string $resource = PlanetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
