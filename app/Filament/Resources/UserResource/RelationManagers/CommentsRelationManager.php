<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class CommentsRelationManager extends RelationManager
{
    protected static string $relationship = 'comments';
    protected static ?string $navigationLabel = 'Коментарі';
    protected static ?string $getRecordTitle = 'Коментарі';
    public function getBreadcrumb(): string
    {
        return 'Коментарі';
    }

    public static function getNavigationLabel(): string
    {
        return 'Організація коментарів';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Textarea::make('comment')
                    ->label(__('Коментар'))
                    ->required()
                    ->maxLength(65535)
                    ->columnSpanFull()
                    ->disabledOn('edit'),
                Forms\Components\TextInput::make('email')
                    ->label(__('Пошта'))
                    ->email()
                    ->nullable()
                    ->maxLength(255)
                    ->disabledOn('edit'),
                Forms\Components\Select::make('event_id')
                    ->label(__('Подія'))
                    ->relationship('event', 'name')
                    ->preload()
                    ->disabledOn('edit'),
                Forms\Components\Toggle::make('status')
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('username')
                    ->label(__('Користувач'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label(__('Пошта'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('event.name')
                    ->numeric()
                    ->sortable()
                    ->label(__('Подія')),
                Tables\Columns\ToggleColumn::make('status')
                    ->label(__('Статус')),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('Дата створення'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('Дата редагування'))
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
