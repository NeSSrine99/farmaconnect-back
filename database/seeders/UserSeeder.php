<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@farmaconnect.com',
            'password' => Hash::make('password'),
            'role_id' => 1
        ]);

        // Pharmacists
        User::create([
            'name' => 'Pharmacien One',
            'email' => 'pharm1@farmaconnect.com',
            'password' => Hash::make('password'),
            'role_id' => 2
        ]);
        User::create([
            'name' => 'Pharmacien Two',
            'email' => 'pharm2@farmaconnect.com',
            'password' => Hash::make('password'),
            'role_id' => 2
        ]);

        // Clients
        for($i=1; $i<=6; $i++){
            User::create([
                'name' => "Client $i",
                'email' => "client$i@farmaconnect.com",
                'password' => Hash::make('password'),
                'role_id' => 3
            ]);
        }
    }
}