<?php

namespace App\Filament\Resources\CommentResource\Pages;

use Filament\Actions;
use App\Models\Comment;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\CommentResource;
use Filament\Resources\Pages\ListRecords\Tab;


class ListComments extends ListRecords
{
    protected static string $resource = CommentResource::class;
    public static function getNavigationLabel(): string
    {
        return 'Переглянути усі записи';
    }
    public function getTabs(): array
    {
        return [
            'all' => Tab::make('Всі')
                ->badge(Comment::count())
                ->query(fn (Builder $query) => $query),

            'authorized' => Tab::make('Авторизовані')
                ->badge(Comment::auth()->count())
                ->query(fn (Builder $query) => $query->auth()),

            'unauthorized' => Tab::make('Не авторизовані')
                ->badge(Comment::nonauth()->count())
                ->query(fn (Builder $query) => $query->nonauth()),
        ];
    }
}
