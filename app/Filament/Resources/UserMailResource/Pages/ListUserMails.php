<?php

namespace App\Filament\Resources\UserMailResource\Pages;

use App\Filament\Resources\UserMailResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUserMails extends ListRecords
{
    protected static string $resource = UserMailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
