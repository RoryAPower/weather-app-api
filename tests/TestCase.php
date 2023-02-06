<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Http;
use Spatie\LaravelRay\RayServiceProvider;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected string $apiPath;

    protected function setUp(): void
    {
        parent::setUp();

        $this->apiPath = 'api';
        $this->seed();

//        Http::preventStrayRequests();
    }

    protected function getPackageProviders($app): array
    {
        return [
            RayServiceProvider::class,
        ];
    }
}
