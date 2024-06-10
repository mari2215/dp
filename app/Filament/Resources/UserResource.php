<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Hash;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\UserResource\Pages;
use STS\FilamentImpersonate\Tables\Actions\Impersonate;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationGroup = 'Користувачі';
    protected static ?string $navigationLabel = 'Користувачі';
    protected static ?string $pluralModelLabel = 'Користувачі';
    protected static ?string $modelLabel = 'Користувача';
    protected static ?int $navigationSort = 3;

    protected static ?string $navigationIcon = 'heroicon-o-lock-closed';

    public function getTitle(): string
    {
        return trans('Користувачі');
    }

    public static function form(Form $form): Form
    {
        $rows = [
            TextInput::make('name')
                ->required()
                ->label('Нікнейм'),
            TextInput::make('email')
                ->email()
                ->required()
                ->label('Пошта'),
            TextInput::make('password')
                ->label('Пароль')
                ->password()
                ->maxLength(255)
                ->dehydrateStateUsing(static function ($state) use ($form) {
                    return !empty($state)
                        ? Hash::make($state)
                        : User::find($form->getColumns())?->password;
                }),
        ];

        $form->schema($rows);

        return $form;
    }

    public static function table(Table $table): Table
    {
        !config('filament-user.impersonate') ?: $table->actions([Impersonate::make('impersonate')]);
        $table
            ->columns([
                TextColumn::make('name')
                    ->sortable()
                    ->searchable()
                    ->label('Нікнейм'),
                TextColumn::make('email')
                    ->sortable()
                    ->searchable()
                    ->label('Пошта'),
                TextColumn::make('created_at')
                    ->label('Зареєстровано')
                    ->dateTime('M j, Y')
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->label('Змінено')
                    ->dateTime('M j, Y')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\Filter::make('verified')
                    ->label(trans('filament-user::user.resource.verified'))
                    ->query(fn (Builder $query): Builder => $query->whereNotNull('email_verified_at')),
                Tables\Filters\Filter::make('unverified')
                    ->label(trans('filament-user::user.resource.unverified'))
                    ->query(fn (Builder $query): Builder => $query->whereNull('email_verified_at')),
            ])
            ->actions([
                Impersonate::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
        return $table;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
