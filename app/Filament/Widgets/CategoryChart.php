<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\Category;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Filament\Widgets\ChartWidget;

class CategoryChart extends ChartWidget
{
    protected static ?string $heading = 'Найбільш популярні категорії по бронюванням';
    protected static ?int $sort = 1;
    protected function getData(): array
    {
        $categories = Category::withCount('bookings')
            ->orderBy('bookings_count', 'asc')
            ->take(10)
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Кількість записів',
                    'data' => $categories->pluck('bookings_count'),
                ],
            ],
            'labels' => $categories->pluck('title'),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
    protected static bool $isLazy = false;
}
