<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VehicleModel>
 */
class VehicleModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'brand_id' => Brand::factory(),
            'name' => $this->faker->bothify('Model ##'),
            'type' => $this->faker->randomElement([
                'sedan', 'suv', 'coupe', 'hatchback', 'minivan'
            ]),
            'production_year_start' => $this->faker->year(2010),
            'production_year_end' => $this->faker->optional(0.3)->year(2023),
        ];
    }
}
