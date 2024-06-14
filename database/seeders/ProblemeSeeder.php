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
        Probleme::create([
            'description' => 'Problème de connexion',
        ]);//
    }
}
