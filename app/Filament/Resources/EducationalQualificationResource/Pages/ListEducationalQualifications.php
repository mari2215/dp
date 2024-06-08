<?php

namespace App\Filament\Resources\EducationalQualificationResource\Pages;

use App\Filament\Resources\EducationalQualificationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEducationalQualifications extends ListRecords
{
    protected static string $resource = EducationalQualificationResource::class;
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
