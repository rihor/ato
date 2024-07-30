<?php

namespace App\Filament\Resources\ProductResource\Widgets;

use App\Enums\ProductStatus;
use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $endDate = now()->format('Y-m-d');
        $startDate = now()->subWeek()->format('Y-m-d');

        $countActivatedLastWeek = Product::whereStatus(ProductStatus::ACTIVE)
            ->whereBetween('updated_at', [$startDate, $endDate])
            ->count();

        return [
            Stat::make('Active products', Product::where('status', ProductStatus::ACTIVE)->count())
                ->description("$countActivatedLastWeek increase")
                ->color('success'),
            Stat::make('Products waiting for approval', Product::where('status', ProductStatus::WAITING_APPROVAL)->count()),
        ];
    }
}
