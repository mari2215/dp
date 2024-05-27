<?php

namespace App\Filament\Resources\EventResource\Pages;

use Filament\Forms;
use Filament\Tables;
use App\Models\Comment;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use App\Filament\Resources\EventResource;
use Illuminate\Contracts\Support\Htmlable;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Pages\ListRecords\Tab;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Infolists\Components;

class ManageEventComments extends ManageRelatedRecords
{
    protected static string $resource = EventResource::class;

    protected static string $relationship = 'comments';

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-ellipsis';

    public function getTitle(): string | Htmlable
    {
        $recordTitle = $this->getRecordTitle();

        $recordTitle = $recordTitle instanceof Htmlable ? $recordTitle->toHtml() : $recordTitle;

        return "Організація коментарів для {$recordTitle}";
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('Всі')
                ->query(fn (Builder $query) => $query),

            'authorized' => Tab::make('Авторизовані')
                ->query(fn (Builder $query) => $query->auth()),

            'unauthorized' => Tab::make('Не авторизовані')
                ->query(fn (Builder $query) => $query->nonauth()),
        ];
    }

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
                Forms\Components\TextInput::make('email')
                    ->required()->disabledOn('edit')
                    ->label('Пошта'),
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->required()
                    ->disabledOn('edit')
                    ->label('Користувач'),
                Forms\Components\Toggle::make('status')
                    ->label('Схвалено для публікації')
                    ->default(true),
                Forms\Components\TextInput::make('comment')
                    ->required()->disabledOn('edit')
                    ->label('Коментар'),
            ])
            ->columns(1);
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->columns(1)
            ->schema([
                Components\Group::make()
                    ->schema([
                        Components\Section::make()
                            ->schema([
                                TextEntry::make('email')
                                    ->label('Електронна пошта'),
                                TextEntry::make('user.name')
                                    ->label('Користувач'),
                                TextEntry::make('username')
                                    ->label('Ім`я'),
                                TextEntry::make('event.name')
                                    ->label('Назва заходу'),
                            ])->columns(4),
                        Components\Section::make('')
                            ->schema([
                                TextEntry::make('comment')->label('Коментар'),
                            ])
                            ->columns(2),


                    ])
                    ->columnSpan(['lg' => 2]),
                IconEntry::make('status')
                    ->label('Видимість'),
                Components\TextEntry::make('created_at')
                    ->label('Опубліковано'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('email')
            ->columns([
                Tables\Columns\TextColumn::make('email')
                    ->label('Електронна пошта')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Користувач')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('comment')
                    ->label('Коментар')
                    ->searchable()
                    ->limit(50)
                    ->tooltip(function ($record) {
                        return $record->comment;
                    }),
                Tables\Columns\ToggleColumn::make('status')
                    ->label(__('Статус'))->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Переглянути'),
                Tables\Actions\EditAction::make()
                    ->label('Редагувати'),
                Tables\Actions\DeleteAction::make()
                    ->label('Видалити'),
            ])
            ->groupedBulkActions([
                Tables\Actions\DeleteBulkAction::make()
                    ->label('Видалити обрані'),
            ]);
    }
}
