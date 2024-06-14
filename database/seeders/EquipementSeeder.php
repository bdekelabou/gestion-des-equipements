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
      
            Equipement::create([
                'type_equipement_id' => 1,
                'bureau_poste_id' => 1,
                'libelle' => 'Ordinateur de bureau'
            ]);
    }
}
