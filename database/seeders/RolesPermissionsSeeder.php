<?php

namespace Database\Seeders;

use App\Models\User;
use App\Enums\RolesEnums;
use App\Enums\PermissionsEnums;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = PermissionsEnums::toValues();

        foreach ($permissions as $key => $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
            ]);
        }

        $roles = RolesEnums::toValues();

        foreach ($roles as $key => $role) {
            Role::firstOrCreate([
                'name' => $role,
            ]);
        }

      
       $admin =  User::create([
            'name' => 'informaticien',
            'email' => 'informaticien@laposte.tg',
            'password' => Hash::make('1234'),
            'bureau_poste_id'=> 1
        ]);

        $admin->syncRoles(RolesEnums::Inormaticien()->value);

// --------------------------------

        $agent =  User::create([
            'name' => 'agent',
            'email' => 'agent@laposte.tg',
            'password' => Hash::make('password'),
            'bureau_poste_id'=> 6
        ]);

        $agent->syncRoles(RolesEnums::agent()->value);

    // --------------------------------

    $agentB =  User::create([
        'name' => 'agentB',
        'email' => 'agentB@laposte.tg',
        'password' => Hash::make('password'),
        'bureau_poste_id'=> 5
    ]);

    $agentB->syncRoles(RolesEnums::agent()->value);

       
    }
}