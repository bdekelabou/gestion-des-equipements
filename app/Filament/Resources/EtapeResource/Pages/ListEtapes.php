<?php

namespace App\Filament\Resources\EtapeResource\Pages;

use App\Filament\Resources\EtapeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEtapes extends ListRecords
{
    protected static string $resource = EtapeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
