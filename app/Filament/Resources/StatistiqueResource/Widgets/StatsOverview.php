<?php

namespace App\Filament\Resources\StatistiqueResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Support\Enums\IconPosition;
use Carbon\Carbon;
use App\Models\BureauPoste;

use function Symfony\Component\String\b;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Bounce rate', '21%')
                ->description('7% decrease')
                ->descriptionIcon('heroicon-m-arrow-trending-down'),
            Stat::make('Heure: ' , Carbon::now()->format('H:i:s'))
                ->description('Date: ' . Carbon::now()->format('Y-m-d')),
            Stat::make('Nombre de bureaux de poste', BureauPoste::count())
                ->description('84 bureaux')
                ->descriptionIcon('heroicon-o-building-office', IconPosition::Before),
                    ];
}



}
