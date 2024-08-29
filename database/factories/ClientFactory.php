<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    protected $model = Client::class;

    public function definition()
    {
        return [
            'surnom' => $this->faker->name,
            'telephone' => $this->faker->phoneNumber,
            'adresse' => $this->faker->address,
            'user_id' => \App\Models\User::factory()->create()->id,
            // 'createdAt' => now(),
            // 'updatedAt' => now(),
        ];
    }
}
