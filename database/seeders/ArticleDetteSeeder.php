<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ArticleDette;

class ArticleDetteSeeder extends Seeder
{
    public function run()
    {
        ArticleDette::factory()->count(100)->create();
    }
}



