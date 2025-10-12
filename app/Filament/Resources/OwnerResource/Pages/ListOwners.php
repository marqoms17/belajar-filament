<?php

namespace App\Filament\Resources\OwnerResource\Pages;

use App\Models\Owner;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Support\Enums\IconPosition;
use App\Filament\Resources\OwnerResource;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListOwners extends ListRecords
{
    protected static string $resource = OwnerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All Owners')
                ->icon('heroicon-o-user-group')
                ->iconPosition(IconPosition::After)
                ->badge(Owner::query()->withTrashed()->count())
                ->badgeColor('info')
                ->modifyQueryUsing(fn(Builder $query) => $query->withTrashed()),

            'active' => Tab::make('Active Owners')
                ->icon('heroicon-o-check-circle')
                ->iconPosition(IconPosition::After)
                ->badge(Owner::query()->withoutTrashed()->count())
                ->badgeColor('success')
                ->modifyQueryUsing(fn(Builder $query) => $query->withoutTrashed()),

            'inactive' => Tab::make('Inactive Owners')
                ->icon('heroicon-o-x-circle')
                ->iconPosition(IconPosition::After)
                ->badge(Owner::query()->onlyTrashed()->count())
                ->badgeColor('danger')
                ->modifyQueryUsing(fn(Builder $query) => $query->onlyTrashed()),
        ];
    }

    public function getDefaultActiveTab(): string | int | null
    {
        return 'active';
    }
}
