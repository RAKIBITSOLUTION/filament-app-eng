<?php

namespace App\Filament\Resources\Users\Pages;

use PHPUnit\Metadata\Test;
use Filament\Actions\CreateAction;
use App\Filament\Widgets\TestChartWidget;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\Users\UserResource;
use App\Filament\Widgets\TestWidget;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
    protected function getHeaderWidgets(): array
    {
        return [
            TestWidget::class

        ];
    }
    protected function getFooterWidgets(): array
    {
        return [
            TestChartWidget::class
        ];
    }
}