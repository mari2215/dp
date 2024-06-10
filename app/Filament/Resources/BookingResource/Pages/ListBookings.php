<?php

namespace App\Filament\Resources\BookingResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\BookingResource;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use App\Filament\Resources\BookingResource\Widgets\StatsOverview;

class ListBookings extends ListRecords
{
    protected static string $resource = BookingResource::class;
    use ExposesTableToWidgets;

    public static function getNavigationLabel(): string
    {
        return 'Переглянути усі записи';
    }
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    protected function getHeaderWidgets(): array
    {
        return [
            StatsOverview::class,
        ];
    }
}
