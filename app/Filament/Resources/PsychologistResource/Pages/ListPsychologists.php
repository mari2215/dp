<?php

namespace App\Filament\Resources\PsychologistResource\Pages;

use App\Filament\Resources\PsychologistResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPsychologists extends ListRecords
{
    protected static string $resource = PsychologistResource::class;
    public static function getNavigationLabel(): string
    {
        return 'Список персональних даних';
    }
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
