<?php

namespace App\Filament\Resources\EventResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\EventResource;
use Pboivin\FilamentPeek\Pages\Actions\PreviewAction;
use Pboivin\FilamentPeek\Pages\Concerns\HasPreviewModal;

class EditEvent extends EditRecord
{
    protected static string $resource = EventResource::class;
    use HasPreviewModal;
    public static function getNavigationLabel(): string
    {
        return 'Редагувати запис';
    }
    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            PreviewAction::make(),
        ];
    }

    protected function getPreviewModalView(): ?string
    {
        return 'source.event';
    }

    protected function getPreviewModalDataRecordKey(): ?string
    {
        return 'event';
    }
}
