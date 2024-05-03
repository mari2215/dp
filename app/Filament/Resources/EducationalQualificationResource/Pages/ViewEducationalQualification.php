<?php

namespace App\Filament\Resources\EducationalQualificationResource\Pages;

use App\Filament\Resources\EducationalQualificationResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewEducationalQualification extends ViewRecord
{
    protected static string $resource = EducationalQualificationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
