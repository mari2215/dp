<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\CategoryResource;
use Pboivin\FilamentPeek\Pages\Actions\PreviewAction;
use Pboivin\FilamentPeek\Pages\Concerns\HasPreviewModal;

class EditCategory extends EditRecord
{
    protected static string $resource = CategoryResource::class;
    use HasPreviewModal;
    public static function getNavigationLabel(): string
    {
        return 'Відредагувати запис';
    }
    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            PreviewAction::make()
                ->viewData([
                    'category' => $this->record,
                    'activities' => $this->record->activities,
                ]),
            Actions\DeleteAction::make(),
        ];
    }
    protected function getPreviewModalView(): ?string
    {
        return 'source.category';
    }
    protected function getPreviewModalDataRecordKey(): ?string
    {
        return 'category';
    }
}
