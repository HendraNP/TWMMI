<?php

namespace App\Filament\Resources\ProductionJobResource\Pages;

use App\Filament\Resources\ProductionJobResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProductionJob extends CreateRecord
{
    protected static string $resource = ProductionJobResource::class;
}
