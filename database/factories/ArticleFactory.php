<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    protected $model = Article::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'libelle' => $this->faker->word,
            'prix' => $this->faker->randomFloat(2, 10, 500),
            'qteStock' => $this->faker->numberBetween(1, 100),
            'slug' => $this->faker->unique()->slug,
            // 'createdAt' => now(),
            // 'updatedAt' => now(),
        ];
    }
}





