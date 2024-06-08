<?php

namespace App\Filament\Resources\ProblemeResource\Pages;

use App\Filament\Resources\ProblemeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProblemes extends ListRecords
{
    protected static string $resource = ProblemeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
