<?php

namespace App\Filament\Resources\EventResource\Pages;

use App\Models\Event;
use Filament\Actions;
use Filament\Pages\Actions\Action;
use App\Filament\Resources\EventResource;
use Filament\Resources\Pages\CreateRecord;

class CreateEvent extends CreateRecord
{
    protected static string $resource = EventResource::class;
    public static function getNavigationLabel(): string
    {
        return 'Створити новий захід';
    }
    protected function getHeaderActions(): array
    {
        return [
            Action::make('form-fake-filler')
                ->label('Заповнити форму')
                ->icon('heroicon-o-sparkles')
                ->color('info')
                ->action(function (self $livewire): void {
                    $data = Event::factory()->make()->toArray();

                    $livewire->form->fill($data);
                })->visible(fn () => app()->environment('local')),
        ];
    }
}
