<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductionJobResource\Pages;
use App\Filament\Resources\ProductionJobResource\RelationManagers;
use App\Models\ProductionJob;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Get;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Placeholder;


class ProductionJobResource extends Resource
{
    protected static ?string $model = ProductionJob::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(fn (ProductionJob $record) => $record && $record->status === 'finalized'
                ? self::readOnlyForm()
                : self::editableForm()
            );
    }



    public static function table(Table $table): Table
{
    return $table
        ->columns([
            TextColumn::make('batch_code')->searchable(),
            TextColumn::make('colourProduct.invoice_product_name')->label('Product'),
            TextColumn::make('quantity')->suffix(' kg'),
            BadgeColumn::make('status')
                ->colors([
                    'secondary' => 'waiting',
                    'warning' => 'in_progress',
                    'success' => 'completed',
                ]),
            TextColumn::make('started_at')->dateTime(),
            TextColumn::make('completed_at')->dateTime(),
        ])
        ->filters([
            SelectFilter::make('status')->options([
                'waiting' => 'Waiting',
                'in_progress' => 'In Progress',
                'completed' => 'Completed',
            ]),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListProductionJobs::route('/'),
            'create' => Pages\CreateProductionJob::route('/create'),
            'edit' => Pages\EditProductionJob::route('/{record}/edit'),
        ];
    }

    protected static function editableForm(): array
    {
        return [
            Select::make('colour_product_id')
            ->label('Colour Product')
            ->relationship('colourProduct', 'invoice_product_name')
            ->disabled()
            ->dehydrated(false),

            TextInput::make('quantity')
                ->numeric()
                ->disabled()
                ->dehydrated(false),

            TextInput::make('batch_code')
                ->disabled()
                ->placeholder('Auto-generated if left blank')
                ->dehydrated(false),

            Select::make('status')
                ->options([
                    'waiting' => 'Waiting',
                    'in_progress' => 'In Progress',
                    'completed' => 'Completed',
                ])
                ->required()
                ->reactive()
                ->afterStateUpdated(function ($state, callable $set, Get $get) {
                    if ($state === 'in_progress') {
                        $set('started_at', now()->format('Y-m-d\TH:i'));
                    }

                    if ($state === 'completed') {
                        if (!$get('started_at')) {
                            $set('started_at', now()->format('Y-m-d\TH:i'));
                        }
                        $set('completed_at', now()->format('Y-m-d\TH:i'));
                    }
                }),

            DateTimePicker::make('started_at')
                ->label('Started At')
                ->disabled()
                ->dehydrated(true)
                ->visible(fn (Get $get) => in_array($get('status'), ['in_progress', 'completed'])),

            DateTimePicker::make('completed_at')
                ->label('Completed At')
                ->disabled()
                ->dehydrated(true)
                ->visible(fn (Get $get) => in_array($get('status'), ['completed'])),

            Textarea::make('notes')
                ->label('Notes')
                ->columnSpanFull(),
            Actions::make([
                Action::make('finalize')
                    ->label('Finalize')
                    ->icon('heroicon-o-lock-closed')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn (Get $get) => $get('status') === 'completed')
                    ->action(function ($record) {
                        $record->update([
                            'status' => 'finalized',
                            'finalized_at' => now(),
                            'finalized_by' => auth()->id(),
                        ]);
                    }),
            ]),
        ];
    }

    protected static function readOnlyForm(): array
    {
        return [
            Placeholder::make('colour_product_id')
                ->label('Colour Product')
                ->content(fn ($record) => $record->colourProduct->invoice_product_name ?? '-'),

            Placeholder::make('quantity')
                ->label('Quantity')
                ->content(fn ($record) => $record->quantity . ' kg'),

            Placeholder::make('batch_code')
                ->label('Batch Code')
                ->content(fn ($record) => $record->batch_code ?? '-'),

            Placeholder::make('started_at')
                ->label('Started At')
                ->content(fn ($record) => $record->started_at ?? '-'),

            Placeholder::make('completed_at')
                ->label('Completed At')
                ->content(fn ($record) => $record->completed_at ?? '-'),

            Placeholder::make('status')
                ->label('Status')
                ->content(fn ($record) => $record->status === 'finalized'
                    ? 'Finalized by ' . ($record->finalizedBy->name ?? 'Unknown')
                    : ucfirst($record->status)),

            Placeholder::make('notes')
                ->label('Notes')
                ->content(fn ($record) => $record->notes ?? '-'),
        ];
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder //limit displayed to only 50
    {
        return parent::getEloquentQuery()
            ->latest() // orders by created_at DESC
            ->limit(50); // change this number as needed
    }


}
