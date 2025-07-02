<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use App\Models\FunctionType;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('product_name')
                    ->label('Product Name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('product_code')
                    ->label('Product Code')
                    ->required()
                    ->maxLength(255),
                Select::make('product_type')
                    ->label('Tipe')
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
                        ''=> '',
                    ])
                    ->searchable(),
                Select::make('product_brand')
                    ->label('Brand')
                    ->required()
                    ->options([
                        'CM Paint' => 'CM Paint',
                        'MM Paint' => 'MM Paint',
                        'Other' => 'Other',
                    ]),
                Select::make('product_usage')
                    ->label('Kegunaan')
                    ->required()
                    ->options([
                        'dinding' => 'Cat Dinding',
                        'epoxy' => 'Cat Epoxy',
                        'antikorosi' => 'Cat Anti Korosi',
                        'other' => 'Lain-lain'
                    ]),
                TextInput::make('msrp1kg')
                    ->label('Harga 1kg')
                    ->numeric()
                    ->minValue(0)
                    ->placeholder('Enter a number'),
                TextInput::make('msrp5kg')
                    ->label('Harga 5kg')
                    ->numeric()
                    ->minValue(0)
                    ->placeholder('Enter a number'),
                TextInput::make('msrp25kg')
                    ->label('Harga 25kg')
                    ->numeric()
                    ->minValue(0)
                    ->placeholder('Enter a number'),
                Textarea::make('description')
                    ->label('Description')
                    ->rows(10)
                    ->required()
                    ->maxLength(5000)
                    ->placeholder('Deskripsi Produk'),
                FileUpload::make('image')
                    ->label('Product Image')
                    ->image()
                    ->imagePreviewHeight('150')
                    ->disk('custom_public') // We'll define this disk below
                    ->directory('images')   // Final path: public/images/
                    ->visibility('public')
                    ->maxSize(2048)
                    ->getUploadedFileNameForStorageUsing(function ($file, $record): string {
                        $slug = Str::slug($record->product_name); // slugify for safe filenames
                        $ext = $file->getClientOriginalExtension();

                        return "{$slug}.{$ext}"; // e.g., 'anti-karat-hardener.png'
                    })
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('product_name')
                    ->label('Product Name')->searchable()->sortable(),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
