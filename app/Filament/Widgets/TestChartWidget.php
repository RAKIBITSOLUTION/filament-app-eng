<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Carbon\Carbon;
use Flowframe\Trend\Trend;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;

class TestChartWidget extends ChartWidget
{
    use InteractsWithPageFilters;

    protected ?string $heading = 'Test Chart Widget';

    protected int | string | array $columnSpan = 1;

    protected string $color = 'success';




    protected function getData(): array
    {

        $start  = $this->filters['startDate'] ?? null;
        $end = $this->filters['endDate'] ?? null;

        $data = Trend::model(User::class)
            ->between(
                start: $start ? Carbon::parse($start) : now()->subMonths(6),
                end: $end ? Carbon::parse($end) : now(),
            )
            ->perMonth()
            ->count();


        return [

            'datasets' => [
                [
                    'label' => 'Users Registered',
                    'data' => $data->pluck('aggregate')->toArray(),
                    'backgroundColor' => '#36A2EB',
                    'borderColor' => '#9BD0F5',
                ],
            ],
            'labels' => $data->pluck('date')->toArray(), 
        ];
    }



    protected function getType(): string
    {
        return 'line';
    }
}
