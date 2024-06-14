<?php

namespace App\Filament\Resources\DemandeResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\DemandeResource;

class ListDemandes extends ListRecords
{
    protected static string $resource = DemandeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getTableQuery(): ?Builder
    {
        return static::getResource()::getEloquentQuery()
        ->join("equipements", "equipements.id", "=", "demandes.equipement_id")
        ->join("bureau_postes", "bureau_postes.id", "=", "equipements.bureau_poste_id")
        ->where("bureau_poste_id", auth()->user()->bureau_poste_id)
        ->select("demandes.*", "equipements.libelle as libelle", "bureau_postes.nom as bureau_poste");
    }


}
