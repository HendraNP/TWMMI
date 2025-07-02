<?php

namespace App\Filament\Resources\ColourCatalogResource\Pages;

use App\Filament\Resources\ColourCatalogResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListColourCatalogs extends ListRecords
{
    protected static string $resource = ColourCatalogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
