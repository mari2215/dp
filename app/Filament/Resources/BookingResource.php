<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\Event;
use App\Models\Booking;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Livewire;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\BookingResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\BookingResource\RelationManagers;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
    protected static ?string $navigationLabel = 'Бронювання';
    protected static ?string $pluralModelLabel = 'Бронювання';
    protected static ?string $modelLabel = 'Бронювання';
    protected static ?string $navigationGroup = 'Користувачі';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->options(fn () => User::pluck('name', 'id'))
                    ->label('Користувач')
                    ->required(),

                Forms\Components\Select::make('event_id')
                    ->label('Захід')
                    ->options(Event::pluck('name', 'id'))
                    ->required(),

                Forms\Components\TextInput::make('total_price')
                    ->numeric()
                    ->label('Вартість')
                    ->default(0),

                Forms\Components\Select::make('payment_status')
                    ->options([
                        '0' => 'Не оплачено',
                        '1' => 'Оплачено',
                    ])->default('не оплачено')
                    ->label('Статус оплати'),
                Forms\Components\Select::make('status')
                    ->options([
                        'опрацьовується' => 'Опрацьовується',
                        'відхилено' => 'Відхилено',
                        'підтверджено' => 'Підтверджено',
                    ])->default('опрацьовується')
                    ->label('Статус'),
                Forms\Components\Textarea::make('notes')
                    ->maxLength(65535)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable()
                    ->label(__('Користувач')),
                Tables\Columns\TextColumn::make('event.name')
                    ->numeric()
                    ->sortable()
                    ->label(__('Захід')),
                Tables\Columns\TextColumn::make('total_price')
                    ->numeric()
                    ->sortable()
                    ->label(__('Вартість')),
                Tables\Columns\IconColumn::make('payment_status')
                    ->boolean()
                    ->label(__('Статус оплати')),
                Tables\Columns\TextColumn::make('status')
                    ->searchable()
                    ->label(__('Статус')),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'view' => Pages\ViewBooking::route('/{record}'),
            'edit' => Pages\EditBooking::route('/{record}/edit'),
        ];
    }
}
