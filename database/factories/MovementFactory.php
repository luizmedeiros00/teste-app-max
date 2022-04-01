<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MovementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'amount'                => $this->faker->numberBetween(1, 200),
            'type_movement_id'      => 1,
            'origin_movement_id'    => 1
        ];
    }
}
