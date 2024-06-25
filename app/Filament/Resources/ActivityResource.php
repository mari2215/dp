<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Activity;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ActivityResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Pelmered\FilamentMoneyField\Tables\Columns\MoneyColumn;
use Pelmered\FilamentMoneyField\Forms\Components\MoneyInput;
use App\Filament\Resources\ActivityResource\RelationManagers;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class ActivityResource extends Resource
{
    protected static ?string $model = Activity::class;
    protected static ?string $navigationIcon = 'heroicon-o-fire';
    protected static ?string $navigationLabel = 'Активності';
    protected static ?string $pluralModelLabel = 'Активності';
    protected static ?string $modelLabel = 'Активність';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('category_id')
                    ->label(__('Категорія'))
                    ->relationship('category', 'title')
                    ->preload()
                    ->required(),

                TextInput::make('price')
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(10000)
                    ->label(__('Ціна'))
                    ->prefix('₴'),

                Forms\Components\TextInput::make('title')
                    ->label(__('Назва'))
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('position')
                    ->label(__('Позиція'))
                    ->required()
                    ->numeric()
                    ->default(1),

                TinyEditor::make('description')
                    ->label(__('Опис'))
                    ->columnSpanFull()
                    ->fileAttachmentsDisk('local')
                    ->fileAttachmentsVisibility('public')
                    ->fileAttachmentsDirectory('images/uploads'),

                Forms\Components\Toggle::make('status')
                    ->label(__('Статус'))
                    ->required()
                    ->default(true),

                FileUpload::make('image')
                    ->disk('local')
                    ->reorderable()
                    ->image()
                    ->imageEditor()
                    ->columnSpanFull()
                    ->multiple()
                    ->directory('images/activities')
                    ->preserveFilenames()
                    ->label(__('Зображення')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('category.title')
                    ->numeric()
                    ->sortable()
                    ->label(__('Тип')),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->label(__('Назва')),
                MoneyColumn::make('price')
                    ->currency('UAH')
                    ->locale('uk')
                    ->label(__('Ціна')),
                Tables\Columns\ToggleColumn::make('status')
                    ->label(__('Статус')),
                Tables\Columns\TextColumn::make('position')
                    ->numeric()
                    ->sortable()
                    ->label(__('Позиція')),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('position')
            ->reorderable('position');
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
            'index' => Pages\ListActivities::route('/'),
            'create' => Pages\CreateActivity::route('/create'),
            'view' => Pages\ViewActivity::route('/{record}'),
            'edit' => Pages\EditActivity::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    protected static ?string $recordTitleAttribute = 'title';

    public static function getGloballySearchableAttributes(): array
    {
        return ['title', 'category.title'];
    }

    public static function getGlobalSearchResultDetails($model): array
    {
        return [
            'Категорія' => $model->category ? $model->category->title : 'Категорія не вказана',
        ];
    }
}
