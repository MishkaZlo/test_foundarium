<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'model' => $this->faker->randomElement(['audi', 'opel', 'ford', 'lada']),
            'number' => $this->faker->postcode(),
            'driver_id' => '',
        ];
    }
}
