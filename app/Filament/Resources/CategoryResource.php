<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Category;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\CategoryResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CategoryResource\RelationManagers;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Категорії';
    protected static ?string $pluralModelLabel = 'Категорії';
    protected static ?string $modelLabel = 'Категорію';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(50)
                    ->label(__('Заголовок')),
                Forms\Components\TextInput::make('subtitle')
                    ->maxLength(90)
                    ->label(__('Підзаголовок')),
                Forms\Components\TextInput::make('position')
                    ->required()
                    ->numeric()
                    ->default(1)
                    ->label(__('Позиція')),
                Forms\Components\Toggle::make('status')
                    ->required()
                    ->default(true)
                    ->label(__('Статус')),
                TinyEditor::make('description')->label(__('Опис'))->columnSpanFull()->fileAttachmentsDisk('local')
                    ->fileAttachmentsVisibility('public')
                    ->fileAttachmentsDirectory('images/uploads'),
                FileUpload::make('image')
                    ->disk('local')
                    ->reorderable()
                    ->image()
                    ->imageEditor()
                    ->columnSpanFull()
                    ->multiple()
                    ->directory('images/categories')
                    ->preserveFilenames()
                    ->label(__('Зображення'))
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->label(__('Заголовок')),
                Tables\Columns\TextColumn::make('subtitle')
                    ->searchable()
                    ->label(__('Підзаголовок')),
                Tables\Columns\ToggleColumn::make('status')
                    ->label(__('Статус')),
                Tables\Columns\TextColumn::make('position')
                    ->numeric()
                    ->sortable()
                    ->label(__('Позиція')),
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'view' => Pages\ViewCategory::route('/{record}'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
