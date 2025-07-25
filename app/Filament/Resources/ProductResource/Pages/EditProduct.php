<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Traits\HasViewHistoryAction;

class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

    use HasViewHistoryAction;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
             $this->getViewHistoryAction(), // Add the view history action
        ];
    }
}
