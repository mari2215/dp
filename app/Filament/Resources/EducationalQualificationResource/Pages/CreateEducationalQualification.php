<?php

namespace App\Filament\Resources\EducationalQualificationResource\Pages;

use Filament\Actions;
use Filament\Pages\Actions\Action;
use App\Models\EducationalQualification;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\EducationalQualificationResource;

class CreateEducationalQualification extends CreateRecord
{
    protected static string $resource = EducationalQualificationResource::class;
    public static function getNavigationLabel(): string
    {
        return 'Створити новий сертифікат';
    }
    protected function getHeaderActions(): array
    {
        return [
            Action::make('form-fake-filler')
                ->label('Заповнити форму')
                ->icon('heroicon-o-sparkles')
                ->color('info')
                ->action(function (self $livewire): void {
                    $data = EducationalQualification::factory()->make()->toArray();

                    $livewire->form->fill($data);
                })->visible(fn () => app()->environment('local')),
        ];
    }
}
