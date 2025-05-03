<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rental>
 */
class RentalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start = $this->faker->dateTimeBetween('-1 month');

        return [
            'user_id' => User::factory(),
            'vehicle_id' => Vehicle::factory(),
            'started_at' => $start,
            'ended_at' => $this->faker->optional(0.7)->dateTimeBetween(
                $start, '+2 hours'
            ),
            'cost' => $this->faker->randomFloat(2, 10, 500),
            'status' => $this->faker->randomElement([
                'active', 'completed', 'canceled'
            ]),
        ];
    }
}
