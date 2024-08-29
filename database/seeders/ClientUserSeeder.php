<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ClientUserSeeder extends Seeder
{
    public function run()
    {
        $user = User::create([
            'nom' => 'Ngom',
            'prenom' => 'Ibrahima',
            'login' => 'moussar@example.com',
            'password' => Hash::make('clientuserpassword'),
        ]);

        Client::create([
            'surnom' => 'Mouscou',
            'telephone' => '+221701234567',
            'adresse' => 'Adresse5 ',
            'user_id' => $user->id,
        ]);
    }
}

