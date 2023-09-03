<?php

namespace App\Services;

use App\Interfaces\GeoLocationInterface;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class GeoLocationService implements GeoLocationInterface
{
    protected string $geoLocationApiUrl;

    protected string $openWeatherApiKey;

    public function __construct()
    {
        $this->openWeatherApiKey = config('services.open_weather_api_key');
        $this->geoLocationApiUrl = config('services.geo_location_api_url');
    }

    public function getCityList(string $city): array
    {
        $response = Http::acceptJson()->get($this->geoLocationApiUrl, [
            'q' => $city,
            'limit' => 10,
            'appid' => $this->openWeatherApiKey,
        ]);

       return $this->formatCityList($response);
    }

    private function formatCityList(PromiseInterface|Response $citiesResponse)
    {
        return $citiesResponse->collect()->map(function($city) {
            return [
                'name' => data_get($city, 'name'),
                'lat' => data_get($city, 'lat'),
                'long' => data_get($city, 'lon'),
                'country' => data_get($city, 'country'),
                'state' => data_get($city, 'state')
            ];
        })->toArray();
    }
}
