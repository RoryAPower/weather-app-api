<?php

namespace App\Http\Controllers;

use App\Http\Requests\GeoLocationRequest;
use App\Interfaces\GeoLocationInterface;
use Illuminate\Http\JsonResponse;

class GeoLocationController extends Controller
{
    protected GeoLocationInterface $geoLocationService;

    public function __construct(GeoLocationInterface $geoLocationService)
    {
        $this->geoLocationService = $geoLocationService;
    }

    public function search(GeoLocationRequest $request): JsonResponse
    {
        $city = $request->query('city');

        return response()->json([
            'data' => $this->geoLocationService->getCityList($city)
        ]);
    }
}
