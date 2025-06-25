<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Collection;
use EightyNine\ExcelImport\ExcelImportAction;
use App\Models\Product;
use App\Models\Colour;
use App\Models\FunctionType;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ExcelImportAction::make()
                ->processCollectionUsing(function (string $modelClass, Collection $collection) {
                    // Ignore the first 3 rows
                    //$collection = $collection->slice(3)->values();
                    return $collection->map(function ($row) {
                        if (!empty($row[1]) && !empty($row[2]) && !empty($row[3]) && !empty($row[4])) {
                            $colour = Colour::where('colour_name', $row[3])->first();
                            $colour_id = $colour ? $colour->id : null;
                            $function = FunctionType::where('function_name', $row[2])->first();
                            $function_code = $function ? $function->function_code : null;
                            Product::firstOrCreate([
                                'product_id' => $row[0],
                                'product_name' => $row[1],
                                'function' => $function_code,
                                'colour' => $colour_id,
                                'invoice_product_name' => $row[4]
                            ]);
                        }
                    });
                }),
            Actions\CreateAction::make()
        ];
    }
}
