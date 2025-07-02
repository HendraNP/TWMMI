<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ColourProductResource\Pages;
use App\Filament\Resources\ColourProductResource\RelationManagers;
use App\Models\ColourProduct;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use App\Models\Colour;
use App\Models\FunctionType;
use function Livewire\before;

class ColourProductResource extends Resource
{
    private static function generateInvoiceProductName(?string $productName, ?string $functionCode, ?string $colourId): string
    {
        $productName = preg_replace('/[\x{4e00}-\x{9fff}]+/u', '', $productName ?? '');
        // Remove any word that contains Grade A, B, C, D, or E (case-insensitive)
        $productName = preg_replace('/\b\w*Grade\s*[ABCDE]\w*\b/i', '', $productName);
        $productName = trim($productName);

        $colour = Colour::find($colourId);
        $colourName = $colour?->colour_name ?? '';
        $colourName = preg_replace('/[\x{4e00}-\x{9fff}]+/u', '', $colourName);
        $colourName = trim($colourName);

        $function = FunctionType::where('function_code', $functionCode)->first();
        $functionName = $function?->function_name ?? '';
        $functionName = preg_replace('/[\x{4e00}-\x{9fff}]+/u', '', $functionName);
        $functionName = trim($functionName);

        return strtoupper($productName . ' ' . $functionName . ' ' . $colourName);
    }
    protected static ?string $model = ColourProduct::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('product_id')
                    ->label('Product ID')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('product_name')
                    ->label('Product Name')
                    ->required()
                    ->afterStateUpdated(function (callable $set, $get) {
                        $set('invoice_product_name', self::generateInvoiceProductName(
                            $get('product_name'),
                            $get('function'),
                            $get('colour')
                        ));
                    })
                    ->maxLength(255),
                Forms\Components\Hidden::make('invoice_product_name'),
                Select::make('function')
                    ->label('Function')
                    ->required()
                    ->options([
                        '2-1' => '2 IN 1 2合1',
                        'bodycoat' => 'BODY COAT  身體外套',
                        'exterior' => 'Eksterior 外部的',
                        'interior' => 'Interior 室內設計',
                        'hardener' => 'Hardener 硬化劑',
                        'primer2-1' => 'PRIMER  2 IN 1 二合一妝前乳',
                        'primer' => 'PRIMER  基本的',
                        'topcoat' => 'TOP COAT 面漆',
                    ])
                    ->afterStateUpdated(function (callable $set, $get) {
                        $set('invoice_product_name', self::generateInvoiceProductName(
                            $get('product_name'),
                            $get('function'),
                            $get('colour')
                        ));
                    })
                    ->searchable(),
                Select::make('colour')
                    ->label('Colour')
                    ->required()
                    ->getSearchResultsUsing(fn (string $search): array => Colour::where('colour_name', 'like', "%{$search}%")->limit(50)->pluck(column: 'colour_name', key: 'id')->toArray())
                    ->getOptionLabelUsing(fn ($value): ?string => Colour::find(id: $value)?->colour_name)
                    ->afterStateUpdated(function (callable $set, $get) {
                        $set('invoice_product_name', self::generateInvoiceProductName(
                            $get('product_name'),
                            $get('function'),
                            $get('colour')
                        ));
                    })
                    ->searchable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('product_id')
                    ->label('Product ID')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('product_name')
                    ->label('Product Name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('function')
                    ->label('Function')
                    ->formatStateUsing(function ($state) {
                        $function = FunctionType::where('function_code', $state)->first();
                        return $function?->function_name ?? $state;
                    }),
                Tables\Columns\TextColumn::make('colour')
                    ->label('Colour')
                    ->formatStateUsing(callback: function ($state) {
                        $colour = Colour::find($state);
                        return $colour?->colour_name ?? $state;
                    })
                    ->searchable()
                    ->sortable()
                ->label('Colour'),
                Tables\Columns\TextColumn::make('invoice_product_name')
                    ->label('Invoice Product Name'),
            ]) 
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListColourProducts::route('/'),
            'create' => Pages\CreateColourProduct::route('/create'),
            'edit' => Pages\EditColourProduct::route('/{record}/edit'),
        ];
    }
}
