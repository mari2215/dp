<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Psychologist;
use Filament\Resources\Resource;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Pages\SubNavigationPosition;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\MarkdownEditor;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PsychologistResource\Pages;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use App\Filament\Resources\PsychologistResource\RelationManagers;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class PsychologistResource extends Resource
{
    protected static ?string $model = Psychologist::class;
    protected static ?string $navigationGroup = 'Персональні налаштування';
    protected static ?string $navigationIcon = 'heroicon-o-puzzle-piece';
    protected static ?string $navigationLabel = 'Персональні дані';
    protected static ?string $pluralModelLabel = 'Персональні дані';
    protected static ?string $modelLabel = 'Персональні дані';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label(__('Імя')),
                TextInput::make('title')
                    ->maxLength(255)
                    ->label(__('Заголовок')),
                TinyEditor::make('subtitle')
                    ->label(__('Опис'))
                    ->columnSpanFull()
                    ->fileAttachmentsDisk('local')
                    ->fileAttachmentsVisibility('public')
                    ->fileAttachmentsDirectory('images/uploads'),
                TextInput::make('phone')
                    ->tel()
                    ->maxLength(255)
                    ->label(__('Телефон')),
                TextInput::make('email')
                    ->email()
                    ->maxLength(255)
                    ->label(__('Пошта')),
                TextInput::make('telegram')
                    ->maxLength(255),
                TextInput::make('viber')
                    ->maxLength(255),
                TextInput::make('facebook')
                    ->maxLength(255),
                TextInput::make('instagram')
                    ->maxLength(255),
                Forms\Components\MarkdownEditor::make('youtube_title')
                    ->maxLength(255)
                    ->label(__('Заголовок для відео')),
                TextInput::make('video_url')
                    ->maxLength(255)
                    ->label(__('Посилання на відео')),
                FileUpload::make('image')
                    ->disk('local')
                    ->reorderable()
                    ->image()
                    ->imageEditor()
                    ->multiple()
                    ->directory('images/psychologist')
                    ->label(__('Зображення'))
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->label(__('Імя')),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->label(__('Заголовок')),
                Tables\Columns\TextColumn::make('subtitle')
                    ->searchable()
                    ->label(__('Підзаголовок')),
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
            'index'     => Pages\ListPsychologists::route('/'),
            'create'    => Pages\CreatePsychologist::route('/create'),
            'view'      => Pages\ViewPsychologist::route('/{record}'),
            'edit'      => Pages\EditPsychologist::route('/{record}/edit'),
        ];
    }
}
