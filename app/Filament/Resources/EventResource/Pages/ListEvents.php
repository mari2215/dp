<?php

namespace App\Filament\Resources\EventResource\Pages;

use Filament\Actions;
use App\Filament\Widgets\EventViews;
use App\Filament\Resources\EventResource;
use Filament\Resources\Pages\ListRecords;

class ListEvents extends ListRecords
{
    protected static string $resource = EventResource::class;
    public static function getNavigationLabel(): string
    {
        return 'Переглянути усі записи';
    }
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
