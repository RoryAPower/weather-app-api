<?php

namespace App\Providers;

use App\Interfaces\CityRepositoryInterface;
use App\Interfaces\GeoLocationInterface;
use App\Interfaces\WeatherInterface;
use App\Repositories\CityRepository;
use App\Services\GeoLocationService;
use App\Services\OpenWeatherService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->app->bind(CityRepositoryInterface::class, CityRepository::class);
        $this->app->bind(WeatherInterface::class, OpenWeatherService::class);
        $this->app->bind(GeoLocationInterface::class, GeoLocationService::class);

    }
}
