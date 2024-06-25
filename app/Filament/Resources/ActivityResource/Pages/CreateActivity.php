<?php

namespace App\Filament\Resources\ActivityResource\Pages;

use Filament\Actions;
use App\Models\Activity;
use Filament\Pages\Actions\Action;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\ActivityResource;

class CreateActivity extends CreateRecord
{
    public static function getNavigationLabel(): string
    {
        return 'Створити нову активність';
    }
    protected static string $resource = ActivityResource::class;
    protected function getHeaderActions(): array
    {
        return [
            Action::make('form-fake-filler')
                ->label('Заповнити форму')
                ->icon('heroicon-o-sparkles')
                ->color('info')
                ->action(function (self $livewire): void {
                    $data = Activity::factory()->make()->toArray();

                    $livewire->form->fill($data);
                })->visible(fn () => app()->environment('local')),
        ];
    }
}
