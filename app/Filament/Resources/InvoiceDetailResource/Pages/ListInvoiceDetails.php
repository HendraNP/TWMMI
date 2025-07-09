<?php

namespace App\Filament\Resources\InvoiceDetailResource\Pages;

use App\Filament\Resources\InvoiceDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInvoiceDetails extends ListRecords
{
    protected static string $resource = InvoiceDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
