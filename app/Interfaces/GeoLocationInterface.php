<?php

namespace App\Interfaces;
interface GeoLocationInterface
{
    public function getCityList(string $city): array;
}
