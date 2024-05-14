<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Event;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;

use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\EventResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\EventResource\RelationManagers;
use Pelmered\FilamentMoneyField\Tables\Columns\MoneyColumn;
use Pelmered\FilamentMoneyField\Forms\Components\MoneyInput;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Події';
    protected static ?string $pluralModelLabel = 'Події';
    protected static ?string $modelLabel = 'Event';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('category_id')
                    ->relationship('category', 'title')
                    ->preload()
                    ->label(__('Тип події')),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label(__('Назва')),
                Forms\Components\DateTimePicker::make('start')
                    ->required()
                    ->label(__('Початок')),
                Forms\Components\DateTimePicker::make('end')
                    ->required()
                    ->label(__('Кінець')),
                TinyEditor::make('description')
                    ->label(__('Опис'))
                    ->maxLength(65535)
                    ->columnSpanFull()
                    ->fileAttachmentsDisk('local')
                    ->fileAttachmentsVisibility('public')
                    ->fileAttachmentsDirectory('images/uploads'),
                Forms\Components\TextInput::make('location')
                    ->maxLength(255)
                    ->label(__('Розташування')),
                TextInput::make('price')
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(10000)
                    ->label(__('Ціна'))
                    ->prefix('₴'),

                Toggle::make('status')
                    ->required()
                    ->label(__('Статус')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('category_id')
                    ->numeric()
                    ->sortable()
                    ->label(__('Тип події')),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->label(__('Назва події')),
                Tables\Columns\TextColumn::make('start')
                    ->dateTime()
                    ->sortable()
                    ->label(__('Початок')),
                Tables\Columns\TextColumn::make('end')
                    ->dateTime()
                    ->sortable()
                    ->label(__('Кінець')),
                Tables\Columns\TextColumn::make('location')
                    ->searchable()
                    ->label(__('Розташування')),
                MoneyColumn::make('price')
                    ->currency('UAH')
                    ->locale('uk')
                    ->label(__('Ціна')),
                Tables\Columns\ToggleColumn::make('status')
                    ->default(true)
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
            ])->defaultSort('start');
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
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'view' => Pages\ViewEvent::route('/{record}'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
