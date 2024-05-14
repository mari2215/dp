<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Models\EducationalQualification;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use App\Filament\Resources\EducationalQualificationResource\Pages;
use App\Filament\Resources\EducationalQualificationResource\RelationManagers;

class EducationalQualificationResource extends Resource
{
    protected static ?string $model = EducationalQualification::class;
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationLabel = 'Кваліфікаційні сертифікати';
    protected static ?string $pluralModelLabel = 'Кваліфікаційні сертифікати';
    protected static ?string $modelLabel = 'Кваліфікаційний сертифікат';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('degree')
                    ->label(__('Назва ступеня'))
                    ->required()
                    ->maxLength(100),

                Forms\Components\TextInput::make('institution')
                    ->label(__('Назва установи'))
                    ->required()
                    ->maxLength(200),

                Forms\Components\DatePicker::make('start_date')
                    ->label(__('Дата початку'))
                    ->required(),

                Forms\Components\DatePicker::make('graduation_date')
                    ->label(__('Дата закінчення'))
                    ->required(),

                Forms\Components\Toggle::make('status')
                    ->label(__('Статус'))
                    ->default(true)
                    ->required(),

                Forms\Components\TextInput::make('position')
                    ->label(__('Позиція'))
                    ->required()
                    ->numeric()
                    ->default(1),

                FileUpload::make('image')
                    ->label(__('Зображення'))
                    ->disk('local')
                    ->image() // Дозволяє завантаження зображень
                    ->imageEditor() // Дозволяє редагування зображень
                    ->directory('images/educational_qualifications')
                    ->preserveFilenames(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('degree')
                    ->label(__('Назва ступеня'))
                    ->searchable(),

                Tables\Columns\TextColumn::make('institution')
                    ->label(__('Назва установи'))
                    ->searchable(),

                Tables\Columns\TextColumn::make('start_date')
                    ->label(__('Дата початку'))
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('graduation_date')
                    ->label(__('Дата закінчення'))
                    ->date()
                    ->sortable(),

                Tables\Columns\ToggleColumn::make('status')
                    ->label(__('Статус'))
                    ->default(1),

                Tables\Columns\TextColumn::make('position')
                    ->label(__('Позиція'))
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('Дата створення'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('Дата оновлення'))
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
            ])->defaultSort('position')
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
            'index' => Pages\ListEducationalQualifications::route('/'),
            'create' => Pages\CreateEducationalQualification::route('/create'),
            'view' => Pages\ViewEducationalQualification::route('/{record}'),
            'edit' => Pages\EditEducationalQualification::route('/{record}/edit'),
        ];
    }
}
