<?php

namespace App\Filament\Resources\EducationalQualificationResource\Pages;

use App\Filament\Resources\EducationalQualificationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEducationalQualification extends EditRecord
{
    protected static string $resource = EducationalQualificationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
