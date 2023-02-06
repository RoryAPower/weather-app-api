<?php

namespace App\Http\Controllers;

use App\Http\Requests\CityRequest;
use App\Http\Resources\CityResource;
use App\Models\City;
use Illuminate\Support\Facades\Auth;

class CityController extends Controller
{

    public function create(CityRequest $request)
    {
        $city = City::firstOrCreate(
            ['lat' => $request->lat, 'long' => $request->long],
            ['name' => $request->name, 'country' => $request->country]
        );

        Auth::user()->cities()->syncWithoutDetaching($city->id);

        return new CityResource($city);
    }
}
