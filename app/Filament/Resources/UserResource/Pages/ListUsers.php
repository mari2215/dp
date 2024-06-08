<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\CreateAction;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;
    public static function getNavigationLabel(): string
    {
        return 'Переглянути усі записи';
    }
    protected function getActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
