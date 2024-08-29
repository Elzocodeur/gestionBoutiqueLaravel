<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;

// class ClientSeeder extends Seeder
// {
//     /**
//      * Run the database seeds.
//      */
//     public function run(): void
//     {
//         Client::factory()->count(5)->create();

//     }
// }





class ClientSeeder extends Seeder
{
    public function run()
    {
        Client::create([
            'surnom' => 'elzo',
            'telephone' => '+221771234567',
            'adresse' => 'Mbour',
        ]);

        Client::create([
            'surnom' => 'yane',
            'telephone' => '+221761234567',
            'adresse' => 'Adresse 2',
        ]);

        Client::create([
            'surnom' => 'Omzo',
            'telephone' => '+221781234567',
            'adresse' => 'Adresse 3',
        ]);
    }
}
