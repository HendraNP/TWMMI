<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InvoiceResource\Pages;
use App\Filament\Resources\InvoiceResource\RelationManagers;
use App\Models\Invoice;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Forms\Components\Grid;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Ngekoding\Terbilang\Terbilang;


class InvoiceResource extends Resource
{
    protected static ?string $model = Invoice::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with('customer');
    }

    public static function form(Form $form): Form
{
    return $form->schema([
        Section::make('📄 Invoice Info')
            //->description('Basic invoice metadata and billing reference')
            ->schema([
                TextInput::make('invoice_number')
                    ->label('Invoice No.')
                    ->required()
                    ->maxLength(50),
                DatePicker::make('invoice_date')
                    ->label('Date')
                    ->required()
                    ->disabled()
                    ->dehydrated(true)
                    ->default(now()),
                Select::make('payment_term')
                    ->options([
                        'COD' => 'COD',
                        '30 DAY' => '30 Days',
                        '60 DAY' => '60 Days',
                        '90 DAY' => '90 Days',
                    ])
                    ->required()
                    ->label('Payment Term'),
                TextInput::make('po_number')
                    ->label('PO Number')
            ])
            ->columns(2),

        Section::make('👤 Customer & Delivery')
            ->schema([
                BelongsToSelect::make('customer_id')
                    ->label('Customer')
                    ->relationship('customer', 'customer_name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $customer = Customer::find($state);

                        if ($customer) {
                            $set('customer_npwp', $customer->npwp);
                            $set('office_address', $customer->office_address);
                            $set('delivery_address', $customer->delivery_address);
                        }
                    }),
                
                TextInput::make('customer_npwp')
                    ->label('NPWP')
                    ->disabled()
                    ->afterStateHydrated(fn ($set, $record) => $set('customer_npwp', $record?->customer?->npwp)),

                Textarea::make('office_address')
                    ->label('Office Address')
                    ->disabled()
                    ->rows(3)
                    ->afterStateHydrated(fn ($set, $record) => $set('office_address', $record?->customer?->office_address)),

                Textarea::make('delivery_address')
                    ->label('Delivery Address')
                    ->disabled()
                    ->rows(3)
                    ->afterStateHydrated(fn ($set, $record) => $set('delivery_address   ', $record?->customer?->delivery_address)),

                TextInput::make('salesperson_id')->visible(false),

                DatePicker::make('shipping_date')
                    ->label('Delivery Date')
                    ->minDate(today())
                    ->required()
                    ->default(now()),
            ])
            ->columns(2),

        Section::make('🎨 Items Purchased')
            ->schema([
                Repeater::make('details')
                    ->relationship()
                    ->schema([
                        Grid::make(4)->schema([
                            BelongsToSelect::make('colour_product_id')
                                ->label('Product')
                                ->relationship('colourProduct', 'invoice_product_name')
                                ->searchable()
                                ->preload()
                                ->required()
                                ->reactive()
                                ->columnSpan(3)
                                ->afterStateUpdated(function ($state, callable $set) {
                                    $product = \App\Models\ColourProduct::find($state);

                                    if ($product) {
                                        $unit = strtolower($product->function) === 'thinner' ? 'L' : 'KG';
                                        $set('unit', $unit);
                                    }
                                }),

                            Select::make('unit')
                                ->label('Unit')
                                ->options([
                                    'KG' => 'KG',
                                    'L' => 'L',
                                ])
                                ->default('KG')
                                ->disabled()
                                ->required(),
                        ]),

                        Grid::make(4)->schema([
                            TextInput::make('quantity')
                                ->label('Qty')
                                ->numeric()
                                ->reactive()
                                ->debounce(300)
                                ->afterStateUpdated(function ($state, callable $get, callable $set) {
                                    $price = $get('price') ?? 0;
                                    $discount = $get('discount') ?? 0;
                                    $subtotal = $state * $price;
                                    $set('total', $subtotal * (1 - ($discount / 100)));
                                }),

                            TextInput::make('price')
                                ->label('Unit Price')
                                ->numeric()
                                ->prefix('Rp')
                                ->reactive()
                                ->debounce(300)
                                ->afterStateUpdated(function ($state, callable $get, callable $set) {
                                    $qty = $get('quantity') ?? 0;
                                    $discount = $get('discount') ?? 0;
                                    $subtotal = $qty * $state;
                                    $set('total', $subtotal * (1 - ($discount / 100)));
                                }),

                            TextInput::make('discount')
                                ->label('Discount (%)')
                                ->numeric()
                                ->suffix('%')
                                ->default(0)
                                ->reactive()
                                ->debounce(300)
                                ->afterStateUpdated(function ($state, callable $get, callable $set) {
                                    $qty = $get('quantity') ?? 0;
                                    $price = $get('price') ?? 0;
                                    $subtotal = $qty * $price;
                                    $set('total', $subtotal * (1 - ($state / 100)));
                                }),

                            TextInput::make('total')
                                ->label('Total Price')
                                ->prefix('Rp')
                                ->disabled()
                                ->dehydrated(true),

                            TextInput::make('sj_number')
                                ->label('Nomor SJ')
                                ->columnSpan(1)
                                ->required(),
                        ]),
                    ])
                    ->afterStateUpdated(function (callable $get, callable $set) {
                        $details = $get('details') ?? [];

                        $dpp = collect($details)->sum(function ($item) {
                            return floatval($item['total'] ?? 0);
                        });

                        $set('dpp', round($dpp, 2));
                        $set('ppn', round($dpp * 0.11, 2));
                        $set('grand_total', round($dpp * 1.11,0));
                        if ($dpp > 0) {
                            $set('total_in_words', ucwords(Terbilang::convert(round($dpp * 1.11, 0), true)));
                        } else {
                            $set('total_in_words', null);
                        }
                    })
                    ->columns(1) // keep repeater items stacked vertically


            ]),

        Section::make('💰 Financial Summary')
            ->schema([
                TextInput::make('dpp')
                    ->label('DPP (Tax Base)')
                    ->prefix('Rp')
                    ->disabled()
                    ->dehydrated(true),
                TextInput::make('ppn')
                    ->label('VAT (11%)')
                    ->prefix('Rp')
                    ->disabled()
                    ->dehydrated(true),
                TextInput::make('grand_total')
                    ->label('Total')
                    ->prefix('Rp')
                    ->disabled()
                    ->dehydrated(true),
                Textarea::make('total_in_words')
                    ->label('Terbilang')
                    ->autosize(false)
                    ->rows(2)
                    ->disabled()
                    ->dehydrated(false),
            ])
            ->columns(2),
    ]);
}


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('invoice_number')->searchable()->sortable(),
                TextColumn::make('invoice_date')->date()->sortable(),
                TextColumn::make('customer.customer_name')->searchable()->sortable(),
                TextColumn::make('grand_total')->money('IDR'),
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
            'index' => Pages\ListInvoices::route('/'),
            'create' => Pages\CreateInvoice::route('/create'),
            'edit' => Pages\EditInvoice::route('/{record}/edit'),
        ];
    }
}
