<?php

namespace App\Filament\Resources\ProductionJobResource\Pages;

use App\Filament\Resources\ProductionJobResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProductionJob extends EditRecord
{
    protected static string $resource = ProductionJobResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
