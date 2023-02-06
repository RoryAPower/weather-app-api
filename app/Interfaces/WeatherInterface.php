<?php

namespace App\Interfaces;

use Illuminate\Http\Client\Response;

interface WeatherInterface
{
    public function getWeather(float $lat, float $long);

    public function buildResponse(Response $response);
}
