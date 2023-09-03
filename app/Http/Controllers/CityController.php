<?php

namespace App\Http\Controllers;

use App\Http\Requests\CityRequest;
use App\Http\Resources\CityResource;
use App\Interfaces\CityRepositoryInterface;
use App\Repositories\CityRepository;

class CityController extends Controller
{
    protected CityRepositoryInterface $cityRepository;

    public function __construct(CityRepositoryInterface $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }

    public function create(CityRequest $request)
    {
        $city = $this->cityRepository->create($request);

        return (new CityResource($city))->response()->setStatusCode(201);
    }
}
