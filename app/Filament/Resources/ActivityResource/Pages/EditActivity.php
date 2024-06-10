<?php

namespace App\Filament\Resources\ActivityResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\ActivityResource;
use Pboivin\FilamentPeek\Pages\Actions\PreviewAction;
use Pboivin\FilamentPeek\Pages\Concerns\HasPreviewModal;

class EditActivity extends EditRecord
{
    protected static string $resource = ActivityResource::class;
    use HasPreviewModal;
    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            PreviewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
    protected function getPreviewModalView(): ?string
    {
        return 'source.activity';
    }
    protected function getPreviewModalDataRecordKey(): ?string
    {
        return 'activity';
    }
}
