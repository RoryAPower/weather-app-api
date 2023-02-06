<?php

namespace App\Http\Controllers;

use App\Services\GeoLocationService;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GeoLocationController extends Controller
{
    protected GeoLocationService $geoLocationService;

    public function __construct(GeoLocationService $geoLocationService)
    {
        $this->geoLocationService = $geoLocationService;
    }
    public function search(Request $request): JsonResponse
    {
        $city = $request->query('city');

        try {
            $response = $this->geoLocationService->getCity($city);

            return response()->json(['data' => $response->json()]);
        } catch (RequestException $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }
}
