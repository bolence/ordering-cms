<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'order_id' => Order::all()->random()->id,
            'type' => $this->faker->randomElement(['majica', 'bedž']),
            'tshirt_color' => $this->faker->randomElement(['Crna', 'Bela']),
            'tshirt_type' => $this->faker->randomElement(['muška', 'ženska']),
            'tshirt_size' => $this->faker->randomElement(['XS', 'S', 'M', 'L', 'XL', 'XXL']),
            'quantity' => $this->faker->numberBetween(1, 10)
        ];
    }
}
