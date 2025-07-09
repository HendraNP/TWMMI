<?php

namespace App\Filament\Resources\ProductionJobResource\Pages;

use App\Filament\Resources\ProductionJobResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProductionJobs extends ListRecords
{
    protected static string $resource = ProductionJobResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
