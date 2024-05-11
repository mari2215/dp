<?php

namespace App\Filament\Widgets;

use App\Models\Event;
use Filament\Forms\Form;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use App\Filament\Resources\EventResource;
use Filament\Forms\Components\DateTimePicker;
use Saade\FilamentFullCalendar\Actions\EditAction;
use Saade\FilamentFullCalendar\Actions\DeleteAction;
use App\Filament\Resources\EventResource\RelationManagers;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class CalendarWidget extends FullCalendarWidget
{
    public Model | string | null $model = Event::class;
    public function fetchEvents(array $fetchInfo): array
    {
        return Event::query()
            ->where('start', '>=', $fetchInfo['start'])
            ->where('end', '<=', $fetchInfo['end'])
            ->get()
            ->map(
                fn (Event $event) => [
                    'title' => $event->name,
                    'start' => $event->start,
                    'end' => $event->end,
                    'url' => EventResource::getUrl(name: 'view', parameters: ['record' => $event]),
                    'shouldOpenUrlInNewTab' => true,
                    'id' => $event->id,
                ]
            )
            ->all();
    }

    public function getFormSchema(): array
    {
        return [
            TextInput::make('name'),
            Select::make('category_id')
                ->relationship('category', 'title')
                ->preload(),
            Grid::make()
                ->schema([
                    DateTimePicker::make('start'),
                    DateTimePicker::make('end'),
                    TinyEditor::make('description')
                        ->maxLength(65535)
                        ->columnSpanFull(),
                    TextInput::make('location')
                        ->maxLength(255),
                    TextInput::make('price')
                        ->numeric()
                        ->prefix('$'),
                    Toggle::make('status')
                        ->required(),
                ]),
        ];
    }

    protected function modalActions(): array
    {
        return [
            EditAction::make()
                ->mountUsing(
                    function (Event $record, Form $form, array $arguments) {
                        $form->fill([
                            'name' => $record->name,
                            'start' => $arguments['event']['start'] ?? $record->start,
                            'end' => $arguments['event']['end'] ?? $record->end,
                            'location' => $arguments['event']['location'] ?? $record->location,
                            'price' => $arguments['event']['price'] ?? $record->price,
                            'category_id' => $arguments['event']['category_id'] ?? $record->category_id,
                            'description' => $arguments['event']['description'] ?? $record->description,
                        ]);
                    }
                ),
            DeleteAction::make(),
        ];
    }
}
