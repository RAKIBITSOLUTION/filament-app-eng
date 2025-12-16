<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\Concerns\InteractsWithPageFilters;

class TestWidget extends StatsOverviewWidget
{

    use InteractsWithPageFilters;

    protected function getStats(): array
    {
        return [
            Stat::make(
                'New User',
                User::when($this->filters['startDate'] ?? null, fn ($query, $startDate) => $query->whereDate('created_at', '>=', $startDate))
                    ->when($this->filters['endDate'] ?? null, fn ($query, $endDate) => $query->whereDate('created_at', '<=', $endDate))
                    ->
                count()
            )
                ->description('Total Registered User')
                ->descriptionIcon('heroicon-o-user-group', 'before')
                ->chart([1, 5, 2, 8, 4, 3, 6])
                ->color('success'),

        ];
    }
}
