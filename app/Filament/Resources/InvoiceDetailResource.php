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
                TextColumn::make('invoice.invoice_number')->label('Invoice'),
                TextColumn::make('part_name')->searchable(),
                TextColumn::make('quantity'),
                TextColumn::make('unit'),
                TextColumn::make('price')->money('IDR'),
                TextColumn::make('discount'),
                TextColumn::make('sj_number'),
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
            'index' => Pages\ListInvoiceDetails::route('/'),
            'create' => Pages\CreateInvoiceDetail::route('/create'),
            'edit' => Pages\EditInvoiceDetail::route('/{record}/edit'),
        ];
    }
}
