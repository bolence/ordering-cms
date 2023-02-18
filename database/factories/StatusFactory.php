<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StatusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'status' => $this->faker->randomElement(['Završena', 'Poslato', 'U slanju', 'U izradi', 'Primljena']),
            'enabled' => 1,
            'created_at' => now(),
        ];
    }
}
