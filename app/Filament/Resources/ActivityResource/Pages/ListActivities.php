<?php

namespace App\Filament\Resources\ActivityResource\Pages;

use App\Filament\Resources\ActivityResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Models\Category;
use Filament\Resources\Components\Tab;

class ListActivities extends ListRecords
{
    protected static string $resource = ActivityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        $tabs = ['all' => Tab::make('All')->badge($this->getModel()::count())];

        $tiers = Category::orderBy('position', 'asc')
            ->withCount('activities')
            ->get();

        foreach ($tiers as $tier) {
            $name = $tier->title;
            $slug = str($name)->slug()->toString();

            $tabs[$slug] = Tab::make($name)
                ->badge($tier->customers_count)
                ->modifyQueryUsing(function ($query) use ($tier) {
                    return $query->where('category_id', $tier->id);
                });
        }

        return $tabs;
    }
}
