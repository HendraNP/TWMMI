<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ColourResource\Pages;
use App\Filament\Resources\ColourResource\RelationManagers;
use App\Models\Colour;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ColourResource extends Resource
{
    protected static ?string $model = Colour::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('colour_name')
                    ->label('Colour Name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('english_name') 
                    ->label('Colour English Name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('colour_name')
                    ->sortable()
                    ->searchable()
                    ->label('Colour Name'),
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
            'index' => Pages\ListColours::route('/'),
            'create' => Pages\CreateColour::route('/create'),
            'edit' => Pages\EditColour::route('/{record}/edit'),
        ];
    }
}
