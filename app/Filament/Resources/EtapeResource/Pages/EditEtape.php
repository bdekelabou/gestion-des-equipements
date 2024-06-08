<?php

namespace App\Filament\Resources\EtapeResource\Pages;

use App\Filament\Resources\EtapeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEtape extends EditRecord
{
    protected static string $resource = EtapeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
