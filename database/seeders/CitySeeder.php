<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\User;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $user = User::first();

        $london = City::factory()
            ->state([
                'name' => 'London',
                'country' => 'GB',
                'state' => 'England',
                'lat' => 51.5074,
                'long' => -0.1278,
            ])
            ->create();

        $paris = City::factory()
            ->state([
                'name' => 'Paris',
                'country' => 'FR',
                'lat' => 48.8534,
                'long' => 2.3488,
            ])
            ->create();

        $user->cities()->attach($london);
        $user->cities()->attach($paris);
    }
}
