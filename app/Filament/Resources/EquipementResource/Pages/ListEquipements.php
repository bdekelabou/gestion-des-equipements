<?php

namespace App\Filament\Resources\EquipementResource\Pages;

use App\Enums\RolesEnums;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\EquipementResource;

class ListEquipements extends ListRecords
{
    protected static string $resource = EquipementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }


    protected function getTableQuery(): ?Builder
    {
        $user = auth()->user();

        if($user->hasRole(RolesEnums::agent()->value))
        {
            return $this->baseQuery()->where("bureau_poste_id", $user->bureau_poste_id);
        }

        else return $this->seeAllQuery();
    }


    public function specificQuery($user)
    {
         
            return $this->baseQuery()->where("bureau_poste_id", $user->bureau_poste_id);
        
    }

    public function seeAllQuery()
    {
 
            return $this->baseQuery();
        
    }


    public function baseQuery()
    {
        return static::getResource()::getEloquentQuery()
        ->join("bureau_postes", "bureau_postes.id", "equipements.bureau_poste_id")
        ->join("type_equipements", "type_equipements.id", "equipements.type_equipement_id")
        ->select("nom as nom_bureau", "equipements.id", "equipements.libelle", "type_equipements.libelle as type_equipement");
    }
}
