<?php

namespace App\Filament\Resources\EventResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\EventResource;
use Pboivin\FilamentPeek\Pages\Actions\PreviewAction;
use Pboivin\FilamentPeek\Pages\Concerns\HasPreviewModal;

class ViewEvent extends ViewRecord
{
    protected static string $resource = EventResource::class;
    public static function getNavigationLabel(): string
    {
        return 'Переглянути запис';
    }
    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
