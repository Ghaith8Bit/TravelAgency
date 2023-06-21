<?php

namespace Database\Factories;

use App\Models\Trip;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Package>
 */
class PackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'people_count' => $this->faker->numberBetween(1, 5),
            'price' => $this->faker->randomFloat(2, 100, 1000),
            'trip_id' => function () {
                return Trip::inRandomOrder()->first()->id;
            },
        ];
    }
}
