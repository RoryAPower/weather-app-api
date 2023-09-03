<?php

namespace App\Interfaces;

interface WeatherInterface
{
    public function getWeather(float $lat, float $long): array;
}
