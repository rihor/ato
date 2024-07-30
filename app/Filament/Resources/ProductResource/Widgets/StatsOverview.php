<?php

namespace App\Filament\Resources\ProductResource\Widgets;

use App\Enums\ProductStatus;
use App\Models\Product;
use Carbon\CarbonInterval;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $countActivatedLastWeek = Product::whereStatus(ProductStatus::ACTIVE)
            ->whereUpdatedAt(CarbonInterval::week(1))
            ->count();

        return [
            Stat::make('Active products', Product::where('status', ProductStatus::ACTIVE)->count())
                ->description("$countActivatedLastWeek increase")
                ->color('success'),
        ];
    }
}
