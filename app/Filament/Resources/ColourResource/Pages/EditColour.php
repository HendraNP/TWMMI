<?php

namespace App\Filament\Resources\ColourResource\Pages;

use App\Filament\Resources\ColourResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditColour extends EditRecord
{
    protected static string $resource = ColourResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
