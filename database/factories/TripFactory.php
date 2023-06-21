<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trip>
 */
class TripFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $endDate = $this->faker->dateTimeBetween('now', '+1 year');
        $startDate = $this->faker->dateTimeBetween('-1 year', $endDate);

        return [
            'name' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'price' => $this->faker->randomFloat(2, 100, 1000),
            'start_date' => $startDate,
            'end_date' => $endDate,
        ];
    }

}
