<?php

namespace Database\Factories;

use App\Models\ArticleDette;
use Illuminate\Database\Eloquent\Factories\Factory;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ArticleDette>
 */
class ArticleDetteFactory extends Factory
{
    protected $model = ArticleDette::class;

    public function definition()
    {
        return [
            'article_id' => \App\Models\Article::factory(),
            'dette_id' => \App\Models\Dette::factory(),
            'qteVente' => $this->faker->numberBetween(1, 10),
            'prixVente' => $this->faker->randomFloat(2, 10, 500),
        ];
    }
}
