<?php

namespace App\Filament\Resources\MainPageResource\Pages;

use Filament\Actions;
use App\Models\Category;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\MainPageResource;
use Pboivin\FilamentPeek\Pages\Actions\PreviewAction;
use Pboivin\FilamentPeek\Pages\Concerns\HasPreviewModal;

class EditMainPage extends EditRecord
{
    use HasPreviewModal;
    protected static string $resource = MainPageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            PreviewAction::make()
                ->viewData([
                    'page' => $this->record,
                    'categories' => Category::all(),
                ]),
        ];
    }
    protected function getPreviewModalView(): ?string
    {
        return 'welcome';
    }

    protected function getPreviewModalDataRecordKey(): ?string
    {
        return 'page';
    }
}
