<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Comment;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Pages\SubNavigationPosition;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\CommentResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CommentResource\RelationManagers;

class CommentResource extends Resource
{
    protected static ?string $model = Comment::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-oval-left-ellipsis';
    protected static ?string $navigationLabel = 'Коментарі';
    protected static ?string $pluralModelLabel = 'Коментар';
    protected static ?string $modelLabel = 'Коментар';
    protected static ?string $navigationGroup = 'Заходи';

    protected static ?int $navigationSort = 1;

    // protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Textarea::make('comment')
                    ->label(__('Коментар'))
                    ->required()
                    ->maxLength(65535)
                    ->columnSpanFull()
                    ->disabledOn('edit'),
                Forms\Components\TextInput::make('username')
                    ->label(__('Юзернейм'))
                    ->nullable()
                    ->maxLength(255)
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
                Forms\Components\Select::make('user_id')
                    ->label(__('Користувач'))
                    ->relationship('user', 'name')
                    ->preload()
                    ->nullable()
                    ->disabledOn('edit'),
                Forms\Components\TextInput::make('parent_id')
                    ->label(__('Батьківський коментар'))
                    ->numeric()
                    ->nullable()
                    ->disabledOn('edit'),
                Forms\Components\Toggle::make('status')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListComments::route('/'),
            'view' => Pages\ViewComment::route('/{record}'),
        ];
    }
}
