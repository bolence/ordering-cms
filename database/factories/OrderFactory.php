<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Status;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'order_number' => $this->faker->numberBetween(10000, 99999),
            'delivery_type' => $this->faker->randomElement(['lično', 'dostava']),
            'order_date' => now()->format('Y-m-d'),
            'napomena' => $this->faker->sentence(),
            'order_from' => $this->faker->randomElement(['facebook', 'instagram', 'viber']),
            'price' => $this->faker->randomFloat(),
            'user_id' => User::all()->random()->id,
            'customer_id' => Customer::all()->random()->id,
            'status_id' => Status::all()->random()->id,
        ];
    }
}
