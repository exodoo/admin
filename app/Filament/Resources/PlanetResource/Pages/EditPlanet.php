<?php

namespace App\Filament\Resources\PlanetResource\Pages;

use App\Filament\Resources\PlanetResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPlanet extends EditRecord
{
    protected static string $resource = PlanetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
