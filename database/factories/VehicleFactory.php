<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'model_id' => VehicleModel::factory(),
            'vin' => $this->faker->unique()->vin(),
            'year' => $this->faker->year(2020),
            'color' => $this->faker->colorName(),
            'mileage' => $this->faker->randomFloat(1, 0, 100000),
            'status' => $this->faker->randomElement([
                'available', 'in_use', 'maintenance'
            ]),
            'location' => DB::raw(
                "ST_MakePoint({$this->faker->longitude()}, {$this->faker->latitude()})"
            ),
        ];
    }

    public function available(): static
    {
        return $this->state([
            'status' => 'available',
        ]);
    }
}
