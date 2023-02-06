<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
                'external_weather_id' => 2643743,
                'lat' => 51.5074,
                'long' => -0.1278,
                'timezone' => 0,
            ])
            ->create();

        $paris = City::factory()
            ->state([
                'name' => 'Paris',
                'country' => 'FR',
                'external_weather_id' => 2988507,
                'lat' => 48.8534,
                'long' => 2.3488,
                'timezone' => 3600,
            ])
            ->create();

        $user->cities()->attach($london);
        $user->cities()->attach($paris);
    }
}
