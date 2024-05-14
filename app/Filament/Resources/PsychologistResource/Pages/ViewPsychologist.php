<?php

namespace App\Filament\Resources\PsychologistResource\Pages;

use App\Filament\Resources\PsychologistResource;
use Filament\Actions;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\ViewRecord;

class ViewPsychologist extends ViewRecord
{
    protected static string $resource = PsychologistResource::class;
    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
