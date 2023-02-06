## Weather App Api

API for grabbing geolocations and weather data using open weather service

### Setup
1. You will need to have [Laravel Sail](https://laravel.com/docs/9.x/sail) installed on your machine
2. run `composer install` to grab packages
3. run `cp .env.example .env`
4. run `./vendor/bin/sail up` to bring up machine
5. run `./vendor/bin/sail artisan migrate --seed` to run database migrations and seed some data
6. The app should be available at `http://localhost`


### Notes
1. API connection handled by [Laravel Sanctum](https://laravel.com/docs/9.x/sanctum)
2. Login/Logout hand by [Laravel Fortify](https://laravel.com/docs/9.x/fortify)


### Testing

`sail artisan test`

### Remaining work
1. Add more tests
2. Investigate caching weather data
3. Add to form request validation
4. Abstract the logic further so the geolocation and weather services can be swapped on the fly
