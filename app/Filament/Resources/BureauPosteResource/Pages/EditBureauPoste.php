<?php

namespace App\Filament\Resources\BureauPosteResource\Pages;

use App\Filament\Resources\BureauPosteResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBureauPoste extends EditRecord
{
    protected static string $resource = BureauPosteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
