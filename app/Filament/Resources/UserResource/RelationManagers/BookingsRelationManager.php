<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use App\Models\Event;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class BookingsRelationManager extends RelationManager
{
    protected static string $relationship = 'bookings';
    protected static ?string $navigationLabel = 'Бронювання';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('user_id')
                    ->label('Користувач')
                    ->required()->disabledOn('edit'),

                Forms\Components\Select::make('event_id')
                    ->label('Захід')
                    ->options(Event::pluck('name', 'id'))
                    ->required()->disabledOn('edit'),

                Forms\Components\TextInput::make('total_price')
                    ->numeric()
                    ->label('Вартість')
                    ->default(0)->disabledOn('edit'),

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

    public function table(Table $table): Table
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
    protected static bool $isLazy = false;
}
