<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that user and associated cities are returned successfully
     *
     * @return void
     */
    public function testGetUserDetails(): void
    {
        $user = User::with('cities')->first();

        $cities = $user->cities->toArray();

        $cityResponse = array_map(function($city) {
            return [
                'id' => $city['id'],
                'name' => $city['name'],
                'country' => $city['country'],
                'lat' => $city['lat'],
                'long' => $city['long'],
                'state' =>  $city['state']
            ];
        }, $cities);

        $response = $this->actingAs($user)->get("{$this->apiPath}/my-details");

        $response->assertStatus(200)
            ->assertJsonFragment(['id' => $user->id])
            ->assertJsonFragment(['name' => $user->name])
            ->assertJsonFragment(['email' => $user->email])
            ->assertJsonFragment(['cities' => $cityResponse]);

    }
}
