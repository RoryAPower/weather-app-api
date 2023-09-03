<?php

namespace App\Http\Controllers;

use App\Http\Requests\WeatherRequest;
use App\Interfaces\WeatherInterface;
use Illuminate\Http\JsonResponse;

class WeatherController extends Controller
{
    protected WeatherInterface $weatherService;

    public function __construct(WeatherInterface $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    public function view(WeatherRequest $request): JsonResponse
    {
        $lat = $request->query('lat');
        $long = $request->query('long');

        return response()->json([
            'data' => $this->weatherService->getWeather(floatval($lat), floatval($long))
        ]);
    }
}
