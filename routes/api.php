<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\GeoLocationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WeatherController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('my-details', [UserController::class, 'viewOwnUser'])
        ->name('user.view-own');

    Route::get('/weather', [WeatherController::class, 'view'])
        ->name('weather.view');

    Route::get('geo-location', [GeoLocationController::class, 'search'])
        ->name('get-location.search');

    Route::post('city', [CityController::class, 'create'])
        ->name('city.create');

});
