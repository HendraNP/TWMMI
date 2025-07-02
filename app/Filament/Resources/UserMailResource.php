<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserMailResource\Pages;
use App\Filament\Resources\UserMailResource\RelationManagers;
use App\Models\UserMail;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\TextArea;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\HtmlString;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;

class UserMailResource extends Resource //this is mail from customer using website contact form
{
    protected static ?string $model = UserMail::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(3)->schema([
                    Placeholder::make('name')
                        ->label(new HtmlString('<span class="text-lg font-semibold text-gray-800">Pengirim</span>'))
                        ->content(fn ($record) => new HtmlString($record->name . '<br>(' . $record->email . ')')),
                    Placeholder::make('created_at')
                        ->label(new HtmlString('<span class="text-lg font-semibold text-gray-800">Tanggal</span>'))
                        ->content(fn ($record) => $record->created_at),
                    Placeholder::make('replied_by')
                        ->label(fn ($record) =>
                            $record->flag === 'replied'
                                ? new HtmlString('<span class="text-lg font-semibold">Dibalas Oleh</span>')
                                : new HtmlString('&nbsp;') // 👈 visually empty but holds space
                        )
                        ->content(fn ($record) =>
                            $record->flag === 'replied'
                                ? new HtmlString("{$record->repliedBy?->name} ({$record->updated_at?->format('d M Y, H:i')})")
                                : new HtmlString('&nbsp;') // invisible but preserves column
                        ),
                    Placeholder::make('message')
                        ->label(new HtmlString('<span class="text-lg font-semibold text-gray-800">Pesan</span>'))
                        ->content(fn ($record) => new HtmlString(nl2br(e($record->message)))),
                    \Filament\Forms\Components\Group::make([
                        Placeholder::make('reply_info')
                            ->label(new HtmlString('<span class="text-lg font-semibold text-gray-800">Balasan</span>'))
                            ->content(fn ($record) => $record->reply)
                            ->visible(fn ($record) => $record && $record->flag == 'replied'),

                        Textarea::make('reply')
                            ->label(new HtmlString('<span class="text-lg font-semibold text-gray-800">Balas Pesan</span>'))
                            ->required()
                            ->visible(fn ($record) => $record && $record->flag != 'replied'),
                    ]),
                    Actions::make([
                        Action::make('save')
                            ->label('Kirim Balasan')
                            ->submit('save')
                            ->color('primary')
                            ->button() // ensure correct styling
                            ->visible(fn ($record) => $record && $record->flag != 'replied'),
                    ]),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('message')
                    ->label('Pesan')
                    ->limit(50)
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Kirim')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('flag')
                    ->label('Status'),
            ])
            ->filters([
                //
            ])
            ->actions([
                //
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
            'index' => Pages\ListUserMails::route('/'),
            'create' => Pages\CreateUserMail::route('/create'),
            'edit' => Pages\EditUserMail::route('/{record}/edit'),
        ];
    }
}
