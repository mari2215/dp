<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use App\Models\Event;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsAdminOverview extends BaseWidget
{
    protected static ?int $sort = 0;
    protected function getStats(): array
    {
        return [
            Stat::make('Користувачі', User::query()->count())
                ->chart($this->getUserStats())
                ->color('primary'),

            Stat::make('Заходи', Event::query()->count())
                ->chart($this->getEventStats())
                ->color('primary'),

            Stat::make('Бронювання', Booking::query()->count())
                ->chart($this->getBookingStats())
                ->color('primary'),
        ];
    }

    protected static bool $isLazy = false;

    protected function getType(): string
    {
        return 'line';
    }

    protected function getUserStats(): array
    {
        return User::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();
    }

    protected function getEventStats(): array
    {
        return Event::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();
    }

    protected function getBookingStats(): array
    {
        return Booking::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();
    }
}
