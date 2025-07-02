<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ColourCatalogResource\Pages;
use App\Filament\Resources\ColourCatalogResource\RelationManagers;
use App\Models\ColourCatalog;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\ColorPicker;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ColourCatalogResource extends Resource
{
    protected static ?string $model = ColourCatalog::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('colour_name')
                    ->label('Colour Name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('colour_code')
                    ->label('Colour Code')
                    ->required()
                    ->maxLength(255),
                ColorPicker::make('hex_code')
                ->label('Hex Code')
                ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('colour_name')
                    ->label('Colour Name')->searchable()->sortable(),
                    Tables\Columns\TextColumn::make('colour_code')
                    ->label('Colour Code')->searchable()->sortable(),
                    Tables\Columns\TextColumn::make('hex_code')
                    ->label('Hex Code')->searchable()->sortable(),
                    Tables\Columns\TextColumn::make('type')
                    ->label('Tipe')->searchable()->sortable(),
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
            'index' => Pages\ListColourCatalogs::route('/'),
            'create' => Pages\CreateColourCatalog::route('/create'),
            'edit' => Pages\EditColourCatalog::route('/{record}/edit'),
        ];
    }
}
