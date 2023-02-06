<?php

namespace App\Services;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class GeoLocationService
{
    protected string $geoLocationApiUrl;

    protected string $openWeatherApiKey;

    public function __construct()
    {
        $this->openWeatherApiKey = config('services.open_weather_api_key');
        $this->geoLocationApiUrl = config('services.geo_location_api_url');
    }

    /**
     * @throws RequestException
     */
    public function getCity(string $city): PromiseInterface|Response
    {
        return Http::acceptJson()->get($this->geoLocationApiUrl, [
            'q' => $city,
            'limit' => 10,
            'appid' => $this->openWeatherApiKey,
        ])->throw();
    }
}
