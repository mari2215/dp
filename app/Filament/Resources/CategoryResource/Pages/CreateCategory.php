<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Models\Category;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\CategoryResource;

class CreateCategory extends CreateRecord
{
    protected static string $resource = CategoryResource::class;
    public static function getNavigationLabel(): string
    {
        return 'Створити нову категорію';
    }
    protected function getHeaderActions(): array
    {
        return [
            Action::make('form-fake-filler')
                ->label('Заповнити форму')
                ->icon('heroicon-o-sparkles')
                ->color('info')
                ->action(function (self $livewire): void {
                    $data = Category::factory()->make()->toArray();

                    $livewire->form->fill($data);
                })->visible(fn () => app()->environment('local')),
        ];
    }
}
