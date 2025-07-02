<?php

namespace App\Filament\Resources\ColourCatalogResource\Pages;

use App\Filament\Resources\ColourCatalogResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditColourCatalog extends EditRecord
{
    protected static string $resource = ColourCatalogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
