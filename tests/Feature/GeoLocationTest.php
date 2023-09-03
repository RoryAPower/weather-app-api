<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class GeoLocationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->openWeatherUrl = 'api.openweathermap.org/geo/1.0/*';
    }

    /**
     * Test that a city is returned successfully
     *
     * @return void
     */
    public function testGetCity(): void
    {
        Http::fake([
            $this->openWeatherUrl => Http::response([
                ['name' => 'London', 'lat' => 53.4071991, 'lon' => -2.99168, 'country' => 'GB'],
                ['name' => 'Liverpool', 'lat' => 53.4071991, 'lon' => -2.99168, 'country' => 'GB']
            ], 200, ['Headers']),
        ]);

        $user = User::first();

        $response = $this->actingAs($user)->get("{$this->apiPath}/geo-location?city=London");

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => 'London']);
    }
}
