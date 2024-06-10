<?php

namespace App\Filament\Resources\BookingResource\Widgets;

use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use App\Filament\Resources\BookingResource\Pages\ListBookings;

class StatsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = null;
    use InteractsWithPageTable;

    protected function getTablePage(): string
    {
        return ListBookings::class;
    }

    protected function getStats(): array
    {
        return [
            Stat::make('Усі бронювання', $this->getPageTableQuery()->count()),
            Stat::make('Підтверджені', $this->getPageTableQuery()->where('status', 'підтверджено')->count()),
            Stat::make('Відхилені', $this->getPageTableQuery()->where('status', 'відхилено')->count()),
        ];
    }
}
