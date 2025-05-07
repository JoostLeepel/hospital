<?php

// database/seeders/RoleSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Maak rollen aan
        $adminRole = Role::create(['name' => 'admin']);
        $dokterRole = Role::create(['name' => 'dokter']);
        $patiëntRole = Role::create(['name' => 'patiënt']);
        $familieRole = Role::create(['name' => 'familie']);

        // Koppel rollen aan gebruikers
        $admin = User::create([
            'name' => 'Admin Gebruiker',
            'email' => 'admin@ziekenhuis.test',
            'password' => bcrypt('password'),
        ]);
        $admin->roles()->attach($adminRole);

        $dokter = User::create([
            'name' => 'Dr. Jan',
            'email' => 'dokter@ziekenhuis.test',
            'password' => bcrypt('password'),
        ]);
        $dokter->roles()->attach($dokterRole);

        $patient = User::create([
            'name' => 'Piet Patiënt',
            'email' => 'patient@ziekenhuis.test',
            'password' => bcrypt('password'),
        ]);
        $patient->roles()->attach($patiëntRole);

        $familie = User::create([
            'name' => 'Fam. Janssen',
            'email' => 'familie@ziekenhuis.test',
            'password' => bcrypt('password'),
        ]);
        $familie->roles()->attach($familieRole);
    }
}

