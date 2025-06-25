<?php

namespace App\Filament\Resources\ColourResource\Pages;

use App\Filament\Resources\ColourResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Collection;
use EightyNine\ExcelImport\ExcelImportAction;
use App\Models\Colour;

class ListColours extends ListRecords
{
    protected static string $resource = ColourResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ExcelImportAction::make()
                ->processCollectionUsing(function (string $modelClass, Collection $collection) {
                return $collection->map(function ($row) {
                    // Ensure Colour column exists and is not empty
                    if (!empty($row[3])) {
                        $english_name = preg_replace('/[\x{4e00}-\x{9fff}]+/u', '', $row[3]);
                        Colour::firstOrCreate(['colour_name' => $row[3], 'english_name'=> $english_name]);
                    }
                });
            }),
            Actions\CreateAction::make(),
        ];
    }
}
