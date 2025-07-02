<?php

namespace App\Filament\Resources\ColourProductResource\Pages;

use App\Filament\Resources\ColourProductResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditColourProduct extends EditRecord
{
    protected static string $resource = ColourProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
