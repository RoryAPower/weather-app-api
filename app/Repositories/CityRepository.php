<?php

namespace App\Repositories;

use App\Http\Requests\CityRequest;
use App\Interfaces\CityRepositoryInterface;
use App\Models\City;
use Illuminate\Support\Facades\Auth;

class CityRepository implements CityRepositoryInterface
{
    public function create(CityRequest $request): City
    {
        $city = City::firstOrCreate(
            ['lat' => $request->get('lat'), 'long' => $request->get('long')],
            [
                'name' => $request->get('name'),
                'country' => $request->get('country'),
                'state' => $request->get('state')
            ]
        );

        Auth::user()->cities()->syncWithoutDetaching($city->id);

        return $city;
    }
}
