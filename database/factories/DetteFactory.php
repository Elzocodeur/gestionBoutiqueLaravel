<?php

namespace Database\Factories;

use App\Models\Dette;
use Illuminate\Database\Eloquent\Factories\Factory;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dette>
 */
class DetteFactory extends Factory
{
    protected $model = Dette::class;

    public function definition()
    {
        $montant = $this->faker->randomFloat(2, 50, 1000);
        $montantDu = $this->faker->randomFloat(2, 10, $montant);
        return [
            'date' => $this->faker->date,
            'montant' => $montant,
            'montantDu' => $montantDu,
            'montantRestant' => $montant - $montantDu,
            'client_id' => \App\Models\Client::factory(),
            // 'createdAt' => now(),
            // 'updatedAt' => now(),
        ];
    }
}
