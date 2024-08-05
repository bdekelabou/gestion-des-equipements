<?php

namespace App\Filament\Pages;

use Filament\Widgets\AccountWidget;
use Filament\Pages\Dashboard as BaseDashboard;
use App\Filament\Resources\StatistiqueResource\Widgets\StatsOverview;

class Dashboard extends BaseDashboard
{
    public static function title(): string
    {
        return 'Dashboard';
    }

    // Assurez-vous que cette méthode est publique
    public function getWidgets(): array
    {
        return [
            AccountWidget::class,
            StatsOverview::class,
        ];
    }
}
