<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Models\Customer;
use Auth;
use Filament\Forms;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Forms\Components\Section;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use League\Flysystem\Visibility;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('customer_no')->required()->unique(ignoreRecord: true),
                TextInput::make('customer_name')->required(),
                Textarea::make('office_address')->required(),
                Textarea::make('delivery_address'),
                BelongsToSelect::make('sales_id')
                    ->label('Sales')
                    ->relationship('customer', 'name') // assumes User model has a 'name' column
                    ->searchable()
                    ->preload()
                    ->nullable(),
                TextInput::make('pic')->label('PIC'),
                TextInput::make('telp_no')->label('Phone Number'),
                TextInput::make('email')->email(),
                TextInput::make('npwp')->label('NPWP')->maxLength(16),


                Section::make()
                    ->schema([
                        Placeholder::make('created_by')
                            ->label('Created By')
                            ->content(fn (Customer $record): ?string => $record->createdBy?->name.' ( '.$record->created_at->diffForHumans().' )'),

                        Placeholder::make('updated_by')
                            ->label('Updated By')
                            ->content(fn (Customer $record): ?string => $record->updatedBy?->name.' ( '.$record->updated_at->diffForHumans().' )'),
                    ])
                    ->columns(2)
                    ->hidden(fn (string $operation): bool => $operation === 'create'),
            ]);

                            
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('customer_no')->searchable(),
                TextColumn::make('customer_name')->searchable(),
                TextColumn::make('sales.name')->label('Sales'),
                TextColumn::make('pic'),
                TextColumn::make('telp_no'),
                TextColumn::make('email'),
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
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}
