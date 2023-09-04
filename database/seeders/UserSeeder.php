<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        User::factory()
            ->state([
                'name' => 'test user',
                'email' => 'test@gmail.com',
                'password' => bcrypt('test'),
            ])
            ->create();
    }
}
