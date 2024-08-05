<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Probleme;
use App\Models\Equipement;
use App\Models\TypeEquipement;
use Illuminate\Database\Seeder;
use Database\Seeders\RolesPermissionsSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            
            BureauPosteSeeder::class,

            UserSeeder::class,

            TypeEquipementSeeder::class,

            EquipementSeeder::class,

            ProblemeSeeder::class,

             RolesPermissionsSeeder::class,

          
        ]);
    }
}
