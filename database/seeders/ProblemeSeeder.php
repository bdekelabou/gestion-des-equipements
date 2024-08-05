<?php

namespace Database\Seeders;

use App\Models\Probleme;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProblemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $problemes = [
            "Ecran bleu",
            "Lenteur",
            'probleme de ram'
        ];

        foreach($problemes as $probleme)
        {
             Probleme::create([
            'description' => $probleme,
            
        ]);
        }
       
    }
}
