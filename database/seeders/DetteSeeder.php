<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dette;
class DetteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Dette::factory()->count(5)->create();

    }
}




