<?php

namespace App\Filament\Resources\ExoplanetResource\Pages;

use App\Filament\Resources\ExoplanetResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListExoplanets extends ListRecords
{
    protected static string $resource = ExoplanetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
