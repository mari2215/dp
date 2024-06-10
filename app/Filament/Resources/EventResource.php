<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Event;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Pages\ManagePostComments;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Infolists\Components;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TextInput;
use Filament\Pages\SubNavigationPosition;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\EventResource\Pages;
use Pboivin\FilamentPeek\Forms\Actions\InlinePreviewAction;
use Pelmered\FilamentMoneyField\Tables\Columns\MoneyColumn;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationLabel = 'Заходи';
    protected static ?string $pluralModelLabel = 'Заходи';
    protected static ?string $modelLabel = 'Захід';
    protected static ?string $navigationGroup = 'Заходи';

    protected static ?int $navigationSort = 0;

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('category.title')
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

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->live(onBlur: true)
                            ->maxLength(255)
                            ->label(__('Назва заходу')),
                        Forms\Components\Select::make('category_id')
                            ->relationship('category', 'title')
                            ->preload()
                            ->label(__('Тип заходу')),
                        Forms\Components\DateTimePicker::make('start')
                            ->required()
                            ->label(__('Початок')),
                        Forms\Components\DateTimePicker::make('end')
                            ->required()
                            ->label(__('Кінець')),
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
                            ->label(__('Статус'))->default(true),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Контент')
                    ->schema([
                        TinyEditor::make('description')
                            ->label(__('Опис'))
                            ->maxLength(65535)
                            ->columnSpanFull()
                            ->fileAttachmentsDisk('local')
                            ->fileAttachmentsVisibility('public')
                            ->fileAttachmentsDirectory('images/uploads'),
                    ])
                    ->collapsible(),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Components\Group::make()
                    ->schema([
                        Components\Section::make()
                            ->schema([
                                Components\TextEntry::make('name')->label('Назва'),
                                Components\TextEntry::make('category.title')->label('Тип заходу'),
                            ])
                            ->columns(2),
                        Components\Section::make('Додатково')
                            ->schema([
                                Components\TextEntry::make('price')->label('Ціна'),
                                Components\TextEntry::make('location')
                                    ->label('Локація'),
                            ])
                            ->columns(2),
                    ])
                    ->columnSpan(['lg' => 2]),
                Components\Group::make()
                    ->schema([
                        Components\Section::make('')
                            ->schema([
                                Components\IconEntry::make('status')
                                    ->label('Статус')
                                    ->helperText('Видимість на головній.'),
                                Components\TextEntry::make('start')
                                    ->label('Початок заходу'),
                                Components\TextEntry::make('end')
                                    ->label('Кінець заходу'),
                            ]),
                    ])
                    ->columnSpan(['lg' => 1]),

                Components\Section::make('Контент')
                    ->schema([
                        Components\TextEntry::make('description')
                            ->prose()
                            ->markdown()
                            ->hiddenLabel()->label('Опис'),
                    ])
                    ->collapsible(),

            ])
            ->columns(3);
    }



    public static function getRecordSubNavigation($model): array
    {
        return $model->generateNavigationItems([
            Pages\ViewEvent::class,
            Pages\EditEvent::class,
            Pages\ManageEventComments::class,
        ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'comments' => Pages\ManageEventComments::route('/{record}/comments'),
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'view' => Pages\ViewEvent::route('/{record}'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }


    protected static ?string $recordTitleAttribute = 'name';

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'category.title'];
    }

    public static function getGlobalSearchResultDetails($model): array
    {
        return [
            'Категорія' => $model->category ? $model->category->title : 'Категорія не вказана',
        ];
    }
}
