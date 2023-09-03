<?php

namespace App\Services;

use App\Interfaces\WeatherInterface;
use GuzzleHttp\Promise\PromiseInterface;
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

    public function getWeather(float $lat, float $long): array
    {
         $response = Http::acceptJson()->get($this->openWeatherApiUrl, [
            'lat' => $lat,
            'lon' => $long,
            'cnt' => 5,
            'appid' => $this->openWeatherApiKey,
            'units' => 'metric'
        ]);

         return $this->formatWeather($response);
    }

    private function formatWeather(PromiseInterface|Response $weatherResponse): array
    {
        $weather = [];
        $weatherCollection = $weatherResponse->collect();

        $weather['city'] = data_get($weatherCollection, 'city.name');
        $weather['weather'] = collect($weatherCollection->get('list'))->map(function($weatherItem) {
            return [
                'temp' => data_get($weatherItem, 'main.temp'),
                'feelsLike' => data_get($weatherItem, 'main.feels_like'),
                'tempMin' => data_get($weatherItem, 'main.temp_min'),
                'tempMax' => data_get($weatherItem, 'main.temp_max'),
                'humidity' => data_get($weatherItem, 'main.humidity'),
                'icon' => data_get(head(data_get($weatherItem, 'weather')), 'icon'),
            ];
        })->toArray();

        return $weather;
    }
}
