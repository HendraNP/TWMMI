<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InvoiceDetailResource\Pages;
use App\Filament\Resources\InvoiceDetailResource\RelationManagers;
use App\Models\InvoiceDetail;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InvoiceDetailResource extends Resource
{
    protected static ?string $model = InvoiceDetail::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('invoice.invoice_number')
                    ->label('Invoice No')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('colourProduct.invoice_product_name')
                    ->label('Product')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('quantity')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('sj_number')
                    ->label('SJ Number')
                    ->searchable(),

                TextColumn::make('productionJob.status')
                    ->label('Status')
                    ->badge()
                    ->colors([
                        'primary' => 'pending',
                        'warning' => 'in_progress',
                        'success' => 'finalized',
                    ])
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([]) // 🔒 no edit/view/delete
            ->bulkActions([]); // 🔒 no bulk delete;
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
            'index' => Pages\ListInvoiceDetails::route('/'),
        ];
    }
}
