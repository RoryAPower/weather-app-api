<?php

namespace App\Providers;

use App\Http\Controllers\WeatherController;
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
        $this->app->bind(WeatherController::class, function ($app) {
            return new WeatherController($app->make(OpenWeatherService::class));
        });
    }
}
