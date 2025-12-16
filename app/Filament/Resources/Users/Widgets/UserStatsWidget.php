<?php

namespace App\Filament\Resources\Users\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UserStatsWidget extends StatsOverviewWidget
{
    public ?User $record;


    protected function getStats(): array
    {
        return [
            Stat::make('Name', $this->record->name)
        ];
    }
}
