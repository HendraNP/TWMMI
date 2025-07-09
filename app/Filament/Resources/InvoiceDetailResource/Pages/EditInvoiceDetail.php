<?php

namespace App\Filament\Resources\InvoiceDetailResource\Pages;

use App\Filament\Resources\InvoiceDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInvoiceDetail extends EditRecord
{
    protected static string $resource = InvoiceDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
