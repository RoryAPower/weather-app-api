<?php

namespace App\Interfaces;

use App\Http\Requests\CityRequest;
use App\Models\City;

interface CityRepositoryInterface
{
    public function create(CityRequest $request): City;
}
