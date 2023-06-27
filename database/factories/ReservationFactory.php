<?php

namespace Database\Factories;

use App\Models\Package;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $random = random_int(1, 10) % 2;

        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'reservationable_id' => function () use ($random) {
                // Randomly choose between Trip and Package IDs
                return $random === 0
                    ? Trip::inRandomOrder()->first()->id
                    : Package::inRandomOrder()->first()->id;
            },
            'reservationable_type' => function (array $attributes) use ($random) {
                // Determine the model type based on the reservationable_id
                return $random === 0
                    ? 'App\Models\Trip'
                    : 'App\Models\Package';
            },
        ];
    }
}
