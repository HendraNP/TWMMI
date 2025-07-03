<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use App\Filament\Resources\CustomerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Traits\HasViewHistoryAction;

class EditCustomer extends EditRecord
{
    protected static string $resource = CustomerResource::class;

    use HasViewHistoryAction;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            $this->getViewHistoryAction(), // Add the view history action
        ];
    }

}
