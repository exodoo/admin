<?php

namespace App\Filament\Resources\StarResource\Pages;

use App\Filament\Resources\StarResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStar extends EditRecord
{
    protected static string $resource = StarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
