<?php

namespace App\Filament\Resources\Users\Pages;

use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use App\Filament\Widgets\TestWidget;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Widgets\TestChartWidget;
use App\Filament\Resources\Users\UserResource;
use App\Filament\Resources\Users\Widgets\UserStatsWidget;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            TestWidget::class,
            UserStatsWidget::class,

        ];
    }
    protected function getFooterWidgets(): array
    {
        return [
            TestChartWidget::class
        ];
    }
}
