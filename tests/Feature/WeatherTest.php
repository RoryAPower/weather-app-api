<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class WeatherTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->openWeatherUrl = 'api.openweathermap.org/data/2.5/*';
    }

    /**
     * Test that user and associated cities are returned successfully
     *
     * @return void
     */
    public function testGetWeather(): void
    {
        Http::fake([
            $this->openWeatherUrl => Http::response(
                [
                    'city' => ['name' => 'London'],
                ],
            200, ['Headers']),
        ]);

        $user = User::with('cities')->first();
        $city = $user->cities->first();

        $response = $this->actingAs($user)->get("{$this->apiPath}/weather?lat={$city->lat}&long={$city->long}");

        $response->assertStatus(200)
            ->assertJsonFragment(['city' => 'London']);
    }
}
