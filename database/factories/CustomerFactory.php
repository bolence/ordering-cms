<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->firstName(),
            'email' => $this->faker->email(),
            'street' => $this->faker->streetAddress(),
            'city' => $this->faker->city(),
            'phone' => $this->faker->phoneNumber(),
            'phone2' => $this->faker->phoneNumber(),
        ];
    }
}
