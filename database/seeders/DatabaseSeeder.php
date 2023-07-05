<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        User::factory()->count(25)->create();
        $this->call(TripSeeder::class);
        $this->call(PackageSeeder::class);
        $this->call(RatingSeeder::class);
        $this->call(ContactSeeder::class);
        $this->call(ReservationSeeder::class);



        User::create([
            'name' => 'Super User',
            'email' => 'admin@trips.com',
            'password' => bcrypt('password'),
            'role_id' => 2
        ]);
    }
}
