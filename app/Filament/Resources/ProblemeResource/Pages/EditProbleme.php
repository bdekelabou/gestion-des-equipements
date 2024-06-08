<?php

namespace App\Filament\Resources\ProblemeResource\Pages;

use App\Filament\Resources\ProblemeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProbleme extends EditRecord
{
    protected static string $resource = ProblemeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
