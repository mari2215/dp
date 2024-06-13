<?php

namespace App\Filament\Widgets;

use App\Models\Event;
use App\Models\Category;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Builder;

class EventViewsChart extends ChartWidget
{
    protected static ?string $heading = 'Найбільш популярні заходи по переглядам';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $categories = Category::withCount('views')
            ->orderBy('views_count', 'asc')
            ->take(10)
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Кількість переглядів',
                    'data' => $categories->pluck('views_count'),
                ],
            ],
            'labels' => $categories->pluck('title'),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected static bool $isLazy = false;
}
