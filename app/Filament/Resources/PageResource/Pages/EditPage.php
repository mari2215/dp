<?php

namespace App\Filament\Resources\PageResource\Pages;

use Filament\Actions;
use App\Filament\Resources\PageResource;
use Filament\Resources\Pages\EditRecord;
use Pboivin\FilamentPeek\Pages\Actions\PreviewAction;
use Pboivin\FilamentPeek\Pages\Concerns\HasPreviewModal;

class EditPage extends EditRecord
{
    use HasPreviewModal;
    protected static string $resource = PageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            PreviewAction::make()
                ->viewData([
                    'page' => $this->record,
                ]),
        ];
    }

    protected function getPreviewModalView(): ?string
    {
        return 'pages.index';
    }

    protected function getPreviewModalDataRecordKey(): ?string
    {
        return 'page';
    }
}
