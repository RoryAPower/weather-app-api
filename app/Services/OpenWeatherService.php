<?php

namespace App\Services;

use App\Interfaces\WeatherInterface;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class OpenWeatherService implements WeatherInterface
{
    protected string $openWeatherApiUrl;

    protected string $openWeatherApiKey;

    public function __construct()
    {
        $this->openWeatherApiKey = config('services.open_weather_api_key');
        $this->openWeatherApiUrl = config('services.open_weather_api_url');
    }

    /**
     * @throws RequestException
     */
    public function getWeather(float $lat, float $long): PromiseInterface|Response
    {
        return Http::acceptJson()->get($this->openWeatherApiUrl, [
            'lat' => $lat,
            'lon' => $long,
            'cnt' => 5,
            'appid' => $this->openWeatherApiKey,
            'units' => 'metric'
        ])->throw();
    }

    public function buildResponse(Response $response): array
    {
        return ['data' => $response->json()];
    }
}
