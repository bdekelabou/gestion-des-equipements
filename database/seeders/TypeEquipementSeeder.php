<?php

namespace Database\Seeders;

use App\Models\TypeEquipement;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TypeEquipementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TypeEquipement::create([
            'libelle' => 'Ordinateur'
        ]);

        TypeEquipement::create([
            'libelle' => 'Imprimante'
        ]);
    }
}
