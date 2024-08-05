<?php

namespace Database\Seeders;

use App\Models\Equipement;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EquipementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $ucs = [
            "UC0",
            "UC0",
            "UC0",
            "UC0",
            "UC0",
        ];

        $imprs = [
            "IMPRIMANTE0",
            "IMPRIMANTE0",
            "IMPRIMANTE0",
            "IMPRIMANTE0",
            "IMPRIMANTE0",
        ];

      
            foreach($ucs as $key => $uc)
            {
                Equipement::create([
                    'type_equipement_id' => 1,
                    'bureau_poste_id' => 1,
                    'libelle' => $uc.$key 
                ]);
            }

            foreach($imprs as $key =>  $impr)
            {
                Equipement::create([
                    'type_equipement_id' => 2,
                    'bureau_poste_id' => 8,
                    'libelle' => $impr.$key 
                ]);
            }
    }
}
