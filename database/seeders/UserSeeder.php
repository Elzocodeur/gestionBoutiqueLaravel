<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'nom' => 'gning',
            'prenom' => 'Elimane',
            'login' => 'admin@example.com',
            'role' => 'admin',
            'password' => Hash::make('adminpassword'),
        ]);

        User::create([
            'nom' => 'Dieng',
            'prenom' => 'Omar',
            'login' => 'omaboutiquierr@example.com',
            'role' => 'boutiquier',
            'password' => Hash::make('boutiquierpassword'),
        ]);
    }
}



